<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FitCarver extends Model
{
    public $image;

    const FITHEX = '2e464954';
    const DATATYPE = '.FIT';


    public function __construct($image)
    {
        $this->image = $image;
    }


    public function carve()
    {
        $headerData = $this->getHeaderData();

        $i = 0;

        foreach ($headerData as $header) {
            $i++;
            $file = file_get_contents($this->image, false, null, $header['physical_offset'], $header['file_size']);
            file_put_contents('/Users/Steve/Desktop/fit-examples/usb/example-fit-' . $i . '.fit', $file);
        }
    }


    private function swapEndianness($hex)
    {
        return implode('', array_reverse(str_split($hex, 2)));
    }


    private function hex2str($hex)
    {
        $string = '';

        for ($i = 0; $i < strlen($hex); $i += 2) {
            $string .= chr(hexdec(substr($hex, $i, 2)));
        }

        return $string;
    }


    private function getHeaderData()
    {
        $headerData = [];
        $offsets = $this->getHeaderOffsets();

        foreach ($offsets as $offset) {
            // file_get_contents length is in bytes
            // assume 14 bytes for now
            $hex = bin2hex(file_get_contents($this->image, false, null, $offset, 14));
            $dataType = $this->hex2str(substr($hex, 16, 8));

            if ($dataType === self::DATATYPE) {
                $data = [
                    'physical_offset' => $offset,
                    'header_size' => hexdec(substr($hex, 0, 2)), // 12 or 14
                    'protocol_version' => hexdec(substr($hex, 2, 2)),
                    'profile_version' => hexdec($this->swapEndianness(substr($hex, 4, 4))),
                    'data_size' => hexdec($this->swapEndianness(substr($hex, 8, 8))), // in bytes
                    'data_type' => $this->hex2str(substr($hex, 16, 8)), // .FIT
                ];

                $data['file_size'] = $data['header_size'] + $data['data_size'] + 2;

                if ($data['header_size'] > 12) {
                    $data['crc'] = hexdec($this->swapEndianness(substr($hex, 24, 4))); // optional CRC of bytes 0 through 11, or 0x0000
                }

                $headerData[] = $data;

                // from PHP Fit File Analysis
                // $bin = file_get_contents($this->image, false, null, $offset, 14);

                // $header_fields = 'C1header_size/' .
                //     'C1protocol_version/' .
                //     'v1profile_version/' .
                //     'V1data_size/' .
                //     'C4data_type';
                // if ($data['header_size'] > 12) {
                //     $header_fields .= '/v1crc';
                // }
                // $file_header = unpack($header_fields, $bin);
                // $data_type = sprintf('%c%c%c%c', $this->file_header['data_type1'], $this->file_header['data_type2'], $this->file_header['data_type3'], $this->file_header['data_type4']);
                // echo 'Unpack';
                // var_dump($file_header);
                // echo $data_type;
                //
            }
        }

        return $headerData;
    }


    private function getHeaderOffsets()
    {
        set_time_limit(0);

        $filename = $this->image;
        $handle = fopen($filename, 'rb');

        if ($handle) {

            $chunk = 0;
            $offsets = [];
            $bufferPointer = 0;
            $chunkSize = 104857600; // 100mb

            while (!feof($handle)) {
                $buffer = bin2hex(fread($handle, $chunkSize));

                while (($bufferPointer = strpos($buffer, self::FITHEX, $bufferPointer)) !== false) {
                    $offsets[] = $this->findHeader($bufferPointer) + ($chunk * $chunkSize);
                    $bufferPointer = $bufferPointer + strlen(self::FITHEX);
                }

                $chunk++;
            }

            fclose($handle);

            return $offsets;
        }
    }


    private function findHeader($dataTypeLocation)
    {
        return ($dataTypeLocation / 2) - 8; // chars to bytes, count back 8 bytes
    }
}

<?php

namespace App;

use App\Investigation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FitCarver extends Model
{
    public $image;

    const FITHEX = '2e464954';
    const DATATYPE = '.FIT';


    /**
     * From Fit File Types
     * type_id lookup table
     *
     * @var string[]
     */
    protected $type = [
        1 => 'Device',
        2 => 'Settings',
        3 => 'Sport Settings',
        4 => 'Activity',
        5 => 'Workout',
        6 => 'Course',
        7 => 'Schedule',
        9 => 'Weight',
        10 => 'Totals',
        11 => 'Goals',
        14 => 'Blood Pressure',
        15 => 'MonitoringA',
        20 => 'Activity Summary',
        28 => 'Daily Monitoring',
        32 => 'MonitoringB',
        34 => 'Segment',
        35 => 'Segment List',
    ];


    public function __construct(string $image)
    {
        $this->image = $image;
    }


    public function carve()
    {
        $data = $this->getHeaderData();

        if (!empty($data)) {

            foreach ($data as $offset => $fileHeader) {

                $investigation = Investigation::find(1);

                $file = $investigation->files()->create([
                    'hash' => null,
                    'original_offset' => $offset,
                    'header_data' => json_encode($fileHeader),
                ]);

                $file->name = $file->id . '.fit';
                $file->save();

                $fileContents = file_get_contents($this->image, false, null, $offset, $this->calculateFileSize($fileHeader));

                $file->hash = hash('sha256', $fileContents);
                $file->save();

                if (!Storage::exists($investigation->id)) {
                    Storage::makeDirectory($investigation->id);
                }

                Storage::put($investigation->id . '/' . $file->name, $fileContents);
            }
        }
    }


    private function calculateFileSize($fileHeader)
    {
        return $fileHeader['header_size'] + $fileHeader['data_size'] + 2;
    }


    private function getHeaderData(): array
    {
        $data = [];
        $offsets = $this->getHeaderOffsets();

        foreach ($offsets as $offset) {

            $binary = file_get_contents($this->image, false, null, $offset, 14); // saving a disk read by assuming it's 14-bytes

            $headerSize = unpack('C1', $binary);

            $headerFields = 'C1header_size/' .
                'C1protocol_version/' .
                'v1profile_version/' .
                'V1data_size/' .
                'C4data_type';

            if ($headerSize > 12) {
                $headerFields .= '/v1crc';
            }

            $fileHeader = unpack($headerFields, $binary);
            $dataType = sprintf('%c%c%c%c', $fileHeader['data_type1'], $fileHeader['data_type2'], $fileHeader['data_type3'], $fileHeader['data_type4']);

            if ($dataType === self::DATATYPE) {
                $data[$offset] = $fileHeader;
            }
        }

        return $data;
    }


    private function getHeaderOffsets(): array
    {
        set_time_limit(0);

        $offsets = [];
        $filename = $this->image;
        $handle = fopen($filename, 'rb');

        if ($handle) {

            $chunk = 0;
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
        }

        return $offsets;
    }


    private function findHeader($dataTypeLocation): int
    {
        return ($dataTypeLocation / 2) - 8; // chars to bytes, count back 8 bytes
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Carve extends Model
{
    const FITHEX = '2e464954';
    const DATATYPE = '.FIT';


    public static function searchForFiles(Request $request, string $imageName, Investigation $investigation)
    {
        $errors = 0;
        $success = 0;
        $data = self::getHeaderData($imageName);

        foreach ($data as $fileData) {

            if ( ! $investigation->searchResults()->where('offset', '=', $fileData['offset'])->first()) { // Don't duplicate carves

                try {
                    $investigation->searchResults()->create([
                        'image_name'       => $imageName,
                        'offset'           => $fileData['offset'],
                        'header_size'      => $fileData['header_size'],
                        'data_size'        => $fileData['data_size'],
                        'protocol_version' => $fileData['protocol_version'],
                        'profile_version'  => $fileData['profile_version'],
                        'data_type'        => $fileData['data_type'],
                        'crc'              => $fileData['crc'],
                        'file_size'        => $fileData['file_size'],
                        'initial_bytes'    => base64_encode($fileData['initial_bytes']),
                    ]);
                    $success++;
                } catch (Throwable $e) {
                    $errors++;
                    report($e);

                    continue;
                }
            }
        }

        if ($success > 0) {
            $request->session()->flash('status', $success . ' files found!');
        }

        if ($errors > 0) {
            $request->session()->flash('error', 'There were ' . $errors . ' errors!');
        }
    }
    

    /**
     * @param $imageName
     * @return array
     *              
     * @see https://github.com/steveperrycreative/fit-forensics/blob/fea06528e272922de90d00d8162bcf4aede8809c/app/Models/PhpFitFileAnalysis.php#L1317
     */
    private static function getHeaderData($imageName): array
    {
        $data = [];
        $offsets = self::getHeaderOffsets($imageName);
        $filename = 'disk_images/' . $imageName;

        foreach ($offsets as $offset) {

            $binary = file_get_contents($filename, false, null, $offset, 16); // so that we can save the initial 16-bytes

            $headerSize = unpack('C1', $binary);

            if ($headerSize <= 14) { // Ignore headers over 14-bytes for now
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
                    $data[] = [
                        'offset'           => $offset,
                        'header_size'      => $fileHeader['header_size'],
                        'data_size'        => $fileHeader['data_size'],
                        'protocol_version' => $fileHeader['protocol_version'],
                        'profile_version'  => $fileHeader['profile_version'],
                        'data_type'        => $dataType,
                        'crc'              => key_exists('crc', $fileHeader) ? $fileHeader['crc'] : null,
                        'file_size'        => self::calculateFileSize($fileHeader),
                        'initial_bytes'    => $binary,
                    ];
                }
            }
        }

        return $data;
    }

    private static function getHeaderOffsets($imageName): array
    {
        set_time_limit(0);

        $offsets = [];
        $filename = 'disk_images/' . $imageName;

        for ($i = 0; $i < 2; $i++) {
            $handle = fopen($filename, 'rb');

            if ($handle) {

                $chunk = 0;
                $previousChunks = 0;
                $bufferPointer = 0;
//                $chunkSize = ($i === 0) ? 104857600 : 99614720; // 100mb : 95mb
                $chunkSize = ($i === 0) ? 104857600 : 104857596; // 100mb : -4 bytes

                while ( ! feof($handle)) {
                    $buffer = bin2hex(fread($handle, $chunkSize));

                    while (($bufferPointer = strpos($buffer, self::FITHEX, $bufferPointer)) !== false) {
                        $offsets[] = self::findHeader($bufferPointer) + $previousChunks;
                        $bufferPointer = $bufferPointer + strlen(self::FITHEX);
                    }

                    $chunk++;
                    $previousChunks = $previousChunks + $chunkSize;

                    if ($i === 1 && $chunk === 1) {
                        $chunkSize = 104857600; // Reset the chunk back to 100mb
                    }
                }

                fclose($handle);
            }
        }

        $offsets = array_unique($offsets);

        return $offsets;
    }

    private static function findHeader($dataTypeLocation): int
    {
        return ($dataTypeLocation / 2) - 8; // chars to bytes, count back 8 bytes
    }

    private static function calculateFileSize($fileHeader)
    {
        return $fileHeader['header_size'] + $fileHeader['data_size'] + 2;
    }

    public static function extractFiles(Request $request, $investigation)
    {
        DB::table('search_results')
          ->where([
              ['investigation_id', '=', $investigation->id],
              ['data_size', '<', 1048576], // file data less than 100mb
          ])
          ->chunkById(100, function ($searchResults) use ($investigation) {
              foreach ($searchResults as $result) {
                  $filename = 'disk_images/' . $result->image_name;

                  $fileContents = file_get_contents($filename, false, null, $result->offset, $result->header_size + $result->data_size + 2);
                  $hash = hash('sha256', $fileContents);

                  if ($investigation->files->where('hash', '=', $hash)->first()) { // Check we haven't already carved the file
                      continue;
                  }

                  $file = $investigation->files()->create([
                      'hash'            => $hash,
                      'original_offset' => $result->offset,
                      'header_data'     => json_encode([
                          'header_size'      => $result->header_size,
                          'data_size'        => $result->data_size,
                          'protocol_version' => $result->protocol_version,
                          'profile_version'  => $result->profile_version,
                          'data_type'        => $result->data_type,
                          'crc'              => $result->crc,
                      ]),
                  ]);

                  $file->name = 'inv-' . $investigation->id . '-file-' . $file->id . '.fit';
                  $file->save();

                  if ( ! Storage::exists($investigation->id)) {
                      Storage::makeDirectory($investigation->id);
                  }

                  Storage::put($investigation->id . '/' . $file->name, $fileContents);

                  unset($fileContents);

              }
          });
    }

    public static function parseFiles(Request $request, Investigation $investigation)
    {
        $files = $investigation->files->where('parsed', '=', false);
        $success = 0;
        $errors = 0;

        foreach ($files as $file) {

            try {
                $path = storage_path('app/' . $file->investigation->id . '/' . $file->name);
                $fitData = new FitAnalyser($path);
                $file->type = $fitData->getType();
                $file->parsed = true;
                $file->save();
                $success++;
            } catch (Throwable $e) {
                $errors++;
                report($e);

                continue;
            }
        }

        if ($success > 0) {
            $request->session()->flash('status', $success . ' files parsed!');
        }

        if ($errors > 0) {
            $request->session()->flash('error', 'There were ' . $errors . ' errors!');
        }
    }
}

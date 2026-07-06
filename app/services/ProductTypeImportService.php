<?php

namespace App\Services;

use App\Models\ProductType;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductTypeImportService
{
    /**
     * Header yang diperbolehkan
     */
    private array $header = [
        'po',
        'kp',
        'season',
        'style',
        'destination'
    ];

    /**
     * Import CSV / Excel
     */
    public function import($file)
    {
        $insert = 0;
        $update = 0;

        DB::beginTransaction();

        try {
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, ['csv', 'xlsx', 'xls'])) {
                throw new \Exception('Ekstensi file tidak didukung. Gunakan CSV, XLSX, atau XLS.');
            }

            $path = $file->getRealPath();
            if (!$path) {
                throw new \Exception('File tidak dapat dibuka.');
            }

            $reader = IOFactory::createReaderForFile($path);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            if (count($rows) < 1) {
                throw new \Exception('File kosong.');
            }

            $headerRow = array_values(array_slice($rows[1], 0, count($this->header)));
            $headerRow = array_map(function ($item) {
                $value = preg_replace('/^\x{FEFF}/u', '', (string)$item);
                return strtolower(trim($value));
            }, $headerRow);

            if ($headerRow !== $this->header) {
                throw new \Exception('Format header tidak sesuai. Harus: po,kp,season,style,destination');
            }

            foreach ($rows as $rowNumber => $row) {
                if ($rowNumber === 1) {
                    continue;
                }

                $values = array_map(function ($item) {
                    return trim((string)$item);
                }, array_values(array_slice($row, 0, count($this->header))));

                if ($this->isEmptyRow($values)) {
                    continue;
                }

                $po = $values[0] ?? '';
                $kp = $values[1] ?? '';
                $season = $values[2] ?? '';
                $style = $values[3] ?? '';
                $destination = $values[4] ?? '';

                if ($po === '') {
                    continue;
                }

                if ($destination === '') {
                    throw new \Exception("Destination kosong di baris {$rowNumber}.");
                }

                $product = ProductType::where('po', $po)->first();

                if ($product) {
                    $product->update([
                        'kp' => $kp,
                        'season' => $season,
                        'style' => $style,
                        'destination' => $destination,
                    ]);
                    $update++;
                } else {
                    ProductType::create([
                        'po' => $po,
                        'kp' => $kp,
                        'season' => $season,
                        'style' => $style,
                        'destination' => $destination,
                    ]);
                    $insert++;
                }
            }

            DB::commit();

            return [
                'insert' => $insert,
                'update' => $update,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Cek baris kosong
     */
    private function isEmptyRow(array $row): bool
    {
        foreach ($row as $item) {

            if (trim($item) != '') {

                return false;

            }

        }

        return true;
    }

}
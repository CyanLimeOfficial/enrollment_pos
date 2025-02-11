<?php

namespace App\Exports;

use Illuminate\Support\Collection; // Import this at the top
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransmittalExport implements FromCollection
{
    protected $data;
    protected $transmittalId;
    protected $datePrepared;
    protected $preparedBy;
    protected $numberOfClaims;
    protected $issuedBy;

    public function __construct($data, $transmittalId, $datePrepared, $preparedBy, $numberOfClaims, $issuedBy)
    {
        $this->data = $data;
        $this->transmittalId = $transmittalId;
        $this->datePrepared = $datePrepared;
        $this->preparedBy = $preparedBy;
        $this->numberOfClaims = $numberOfClaims;
        $this->issuedBy = $issuedBy;

        Log::info('TransmittalExport initialized', [
            'transmittalId' => $this->transmittalId,
            'datePrepared' => $this->datePrepared,
            'preparedBy' => $this->preparedBy,
            'numberOfClaims' => $this->numberOfClaims,
            'issuedBy' => $this->issuedBy,
            'data_count' => count($this->data),
        ]);
    }

    public function collection()
    {
        // Load the Excel template
        $templatePath = storage_path('app/templates/transmittal_template.xlsx');
        Log::info("Checking template file existence at: $templatePath");

        if (!file_exists($templatePath)) {
            Log::error("Template file missing: $templatePath");
            throw new \Exception("Template file not found: $templatePath");
        }

        try {
            $spreadsheet = IOFactory::load($templatePath);
            Log::info("Excel template successfully loaded.");
        } catch (\Exception $e) {
            Log::error("Failed to load template: " . $e->getMessage());
            throw $e;
        }

        $sheet = $spreadsheet->getActiveSheet();

        // Insert transmittal details
        try {
            $sheet->setCellValue('C2', $this->transmittalId);
            Log::info("Inserted transmittal details successfully.");
        } catch (\Exception $e) {
            Log::error("Error inserting transmittal details: " . $e->getMessage());
            throw $e;
        }

        // Start writing data from A5 to P5 and downward
        $startRow = 5;
        $startColumn = 'A';
        $endColumn = 'M';

        Log::info("Starting to insert data into spreadsheet. Rows to process: " . count($this->data));

        foreach ($this->data as $index => $rowData) {
            $colIndex = 1;
            Log::info("Processing row #$index", ['rowData' => $rowData]);

            foreach ($rowData as $value) {
                $columnLetter = Coordinate::stringFromColumnIndex($colIndex);
                if ($columnLetter > $endColumn) break;

                try {
                    $sheet->setCellValue($columnLetter . $startRow, $value);
                    Log::info("Inserted [$value] at $columnLetter$startRow");
                } catch (\Exception $e) {
                    Log::error("Error inserting value at $columnLetter$startRow: " . $e->getMessage());
                }

                $colIndex++;
            }

            $startRow++;
        }

        // Ensure the directory exists before saving
        $directoryPath = storage_path('app/public/transmittal/');
        if (!Storage::disk('public')->exists('transmittal')) {
            Log::warning("Directory 'transmittal' not found, creating it now.");
            Storage::disk('public')->makeDirectory('transmittal');
        }

        // Save the file
        $fileName = 'transmittal_' . now()->timestamp . '.xlsx';
        $exportPath = 'transmittal/' . $fileName;
        $fullPath = storage_path('app/public/' . $exportPath);

        Log::info("Saving transmittal file as: $fullPath");

        try {
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($fullPath);
            Log::info("Excel file saved successfully at: $fullPath");

            if (!file_exists($fullPath)) {
                Log::error("File save operation failed. File not found: $fullPath");
                throw new \Exception("Failed to save file.");
            }
        } catch (\Exception $e) {
            Log::error("Error writing file: " . $e->getMessage());
            throw $e;
        }

        // Throw the fucking shitty binary
        $fileContents = Storage::disk('public')->get($exportPath);


        Log::info("File converted to base64 blob.");

        // Store the transmittal record in the database
        DB::table('transmittals')->insert([
            'transmittal_id' => $this->transmittalId,
            'attachment_transmittal' => $fileContents,
            'date_prepared' => $this->datePrepared,
            'prepared_by' => $this->preparedBy,
            'number_of_claims' => $this->numberOfClaims,
            'issued_by' => $this->issuedBy,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Log::info("Transmittal record inserted into database.");
        
    }
}

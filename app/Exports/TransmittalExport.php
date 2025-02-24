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

    public function __construct($data, $transmittalId, $datePrepared, $preparedBy, $position, $numberOfClaims, $issuedBy)
    {
        $this->data = $data;
        $this->transmittalId = $transmittalId;
        $this->datePrepared = $datePrepared;
        $this->position = $position;
        $this->preparedBy = $preparedBy;
        $this->numberOfClaims = $numberOfClaims;
        $this->issuedBy = $issuedBy;

        Log::info('TransmittalExport initialized', [
            'transmittalId'  => $this->transmittalId,
            'datePrepared'   => $this->datePrepared,
            'preparedBy'     => $this->preparedBy,
            'position'       => $this->position,
            'numberOfClaims' => $this->numberOfClaims,
            'issuedBy'       => $this->issuedBy,
            'data_count'     => count($this->data),
        ]);
    }
    

    public function collection()
    {
        // ------------------------------------------------------------------
        // 1. Load the Excel template and insert basic transmittal details
        // ------------------------------------------------------------------
        $templatePath = storage_path('app/templates/transmittal_template_semi_final.xlsx');
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

        // Insert title in cell A1 with formatting
        try {
            $title = "POS ENROLLMENT AND UPDATE " . date('Y');
            $sheet->setCellValue('A1', $title);
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            Log::info("Inserted title", [
                'cell'  => 'A1',
                'title' => $title
            ]);
        } catch (\Exception $e) {
            Log::error("Error inserting title", ['error' => $e->getMessage()]);
            throw $e;
        }


        // Insert transmittal details (e.g. writing transmittal ID in cell C2)
        try {
            $sheet->setCellValue('C2', $this->transmittalId);
            Log::info("Inserted transmittal details successfully.");
        } catch (\Exception $e) {
            Log::error("Error inserting transmittal details: " . $e->getMessage());
            throw $e;
        }

        // Define a border style array for all generated cells.
        $borderStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color'       => ['argb' => 'FF000000'], // black
                ],
            ],
        ];

        // Set the starting row for data insertion and define the boundary.
        // We work within columns A to P (16 columns) as our header spans A–P.
        $startRow = 5;
        $endColumn = 'M';

        // ------------------------------------------------------------------
        // 2. Group Data by Category (first column)
        // ------------------------------------------------------------------
        $groupedData = [];
        foreach ($this->data as $row) {
            $category = $row[0];
            if (!isset($groupedData[$category])) {
                $groupedData[$category] = [];
            }
            $groupedData[$category][] = $row;
        }

        // Define the desired order of categories.
        $categoriesOrder = [
            "POS",
            "SENIOR",
            "NTHS " . date('Y'),
            "LISTAHAN " . date('Y'),
            "4P'S " . date('Y')
        ];

        // ------------------------------------------------------------------
        // 3. Process Each Category Group and Write to the Spreadsheet
        // ------------------------------------------------------------------
        // Global counter for continuous numbering.
        $globalCounter = 1;
        foreach ($categoriesOrder as $catName) {
            if (!isset($groupedData[$catName])) {
                continue;
            }

            // --- 3a. Insert a Category Header Row ---
            $currentHeaderRow = $startRow;
            $headerCell = "A{$currentHeaderRow}";
            $sheet->mergeCells("A{$currentHeaderRow}:M{$currentHeaderRow}");
            $sheet->setCellValue($headerCell, $catName);
            $sheet->getRowDimension($currentHeaderRow)->setRowHeight(25);

            // Style header row (Century Gothic, 19pt, bold, italic, centered).
            $style = $sheet->getStyle($headerCell);
            $style->getFont()->setName('Century Gothic')->setSize(19)->setBold(true)->setItalic(true);
            $style->getAlignment()
                  ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                  ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle("A{$currentHeaderRow}:M{$currentHeaderRow}")->applyFromArray($borderStyleArray);

            $startRow++; // Next row for data.

            // --- 3b. Write the Group's Data Rows with Continuous Numbering ---
            foreach ($groupedData[$catName] as $rowData) {
                array_shift($rowData); // Remove category value.
                $rowData[0] = $globalCounter;
                $globalCounter++;

                $colIndex = 1;
                foreach ($rowData as $value) {
                    $columnLetter = Coordinate::stringFromColumnIndex($colIndex);
                    if ($columnLetter > $endColumn) break;
                    $cellAddress = $columnLetter . $startRow;
                    try {
                        $sheet->setCellValue($cellAddress, $value);
                        Log::info("Inserted [$value] at $cellAddress");
                    } catch (\Exception $e) {
                        Log::error("Error inserting value at $cellAddress: " . $e->getMessage());
                    }
                    // Apply border and font styling.
                    $sheet->getStyle($cellAddress)->applyFromArray($borderStyleArray);
                    $sheet->getStyle($cellAddress)->getFont()->setName('Century Gothic')->setSize(12);

                    // Set alignment based on column number.
                    switch ($colIndex) {
                        case 1:
                            $alignment = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT;
                            break;
                        case 5:
                        case 7:
                            $alignment = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT;
                            break;
                        case 2:
                        case 3:
                        case 4:
                        case 6:
                        case 8:
                        case 9:
                        case 10:
                        case 11:
                        case 12:
                        case 13:
                        default:
                            $alignment = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
                            break;
                    }
                    $sheet->getStyle($cellAddress)->getAlignment()->setHorizontal($alignment);

                    $colIndex++;
                }
                $startRow++;
            }
        }

        // ------------------------------------------------------------------
        // 3c. Insert Merged Cell for Number of Claims
        // ------------------------------------------------------------------
        $mergedRow = $startRow; // Next available row.
        $sheet->mergeCells("A{$mergedRow}:B{$mergedRow}");
        $claimsText = strtoupper($this->numberOfClaims . " CLAIMS");
        $sheet->setCellValue("A{$mergedRow}", $claimsText);
        $mergedStyle = $sheet->getStyle("A{$mergedRow}");
        $mergedStyle->getFont()->setName('Century Gothic')->setSize(12)->setBold(true);
        $mergedStyle->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle("A{$mergedRow}:B{$mergedRow}")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE);

        // -------------------------------
        // Additional Rows after Claims (Calibri 11)
        // -------------------------------
        // Row after claims: Vacant Row.
        $rowVacant1 = $mergedRow + 1;
        // (Left blank.)
        
        // Next row: Row for "Prepared By:" and "Recieved By:"
        $rowPreparedRecieved = $mergedRow + 2;
        $sheet->mergeCells("B{$rowPreparedRecieved}:C{$rowPreparedRecieved}");
        $sheet->setCellValue("B{$rowPreparedRecieved}", "Prepared By:");
        $sheet->setCellValue("I{$rowPreparedRecieved}", "Recieved By:");
        $sheet->getStyle("B{$rowPreparedRecieved}:C{$rowPreparedRecieved}")
              ->getFont()->setName('Calibri')->setSize(11);
        $sheet->getStyle("I{$rowPreparedRecieved}")
              ->getFont()->setName('Calibri')->setSize(11);

        // Next row: Another Vacant Row.
        $rowVacant2 = $mergedRow + 3;
        // (Left blank.)

        // Next row: Row for Prepared By value and blank container with bottom border.
        $rowPreparedValue = $mergedRow + 4;
        $sheet->mergeCells("B{$rowPreparedValue}:D{$rowPreparedValue}");
        $sheet->setCellValue("B{$rowPreparedValue}", $this->preparedBy);
        $sheet->getStyle("B{$rowPreparedValue}:D{$rowPreparedValue}")
              ->getFont()->setName('Calibri')->setSize(11)->setBold(true);
        $sheet->getStyle("B{$rowPreparedValue}:D{$rowPreparedValue}")
              ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                               ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells("I{$rowPreparedValue}:J{$rowPreparedValue}");
        $sheet->getStyle("I{$rowPreparedValue}:J{$rowPreparedValue}")
              ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle("I{$rowPreparedValue}:J{$rowPreparedValue}")
              ->getFont()->setName('Calibri')->setSize(11);

        // Next row: Row for Administrative Assistant I.
        $rowAdminAssistant = $mergedRow + 5;
        $sheet->mergeCells("B{$rowAdminAssistant}:D{$rowAdminAssistant}");
        $sheet->setCellValue("B{$rowAdminAssistant}", $this->position);
        $style = $sheet->getStyle("B{$rowAdminAssistant}:D{$rowAdminAssistant}");
        $style->getFont()->setName('Calibri')->setSize(11)->getColor()->setRGB('000000');
        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Next row: Row for present day date in column C.
        $rowDate = $mergedRow + 6;
        $sheet->setCellValue("C{$rowDate}", date('F j, Y'));
        $sheet->getStyle("C{$rowDate}")
              ->getFont()->setName('Calibri')->setSize(11);
        // (Alignment as default.)

        // -------------------------------
        // Set entire "I" column number format to number with 0 decimals.
        // -------------------------------
        $sheet->getStyle('I:I')->getNumberFormat()->setFormatCode('0');

        // ------------------------------------------------------------------
        // Protect the Worksheet to Prevent Editing (Password: "cookie")
        // ------------------------------------------------------------------
        // This will allow users to view the file, but prevent any modifications unless they know the password.
        $sheet->getProtection()->setSheet(true);
        $sheet->getProtection()->setPassword('You are my nigga');
        // Optionally, you can disable inserting rows, columns, and formatting.
        $sheet->getProtection()->setInsertRows(false);
        $sheet->getProtection()->setInsertColumns(false);
        $sheet->getProtection()->setFormatCells(false);

        // ------------------------------------------------------------------
        // 4. Save the File and Insert a Record into the Database
        // ------------------------------------------------------------------
        $directoryPath = storage_path('app/public/transmittal/');
        if (!Storage::disk('public')->exists('transmittal')) {
            Log::warning("Directory 'transmittal' not found, creating it now.");
            Storage::disk('public')->makeDirectory('transmittal');
        }

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

        $fileContents = Storage::disk('public')->get($exportPath);
        Log::info("File converted to base64 blob.");

        DB::table('transmittals')->insert([
            'transmittal_id'         => $this->transmittalId,
            'attachment_transmittal' => $fileContents,
            'date_prepared'          => $this->datePrepared,
            'prepared_by'            => $this->preparedBy,
            'position'               => $this->position,
            'number_of_claims'       => $this->numberOfClaims,
            'issued_by'              => $this->issuedBy,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);
        Log::info("Transmittal record inserted into database.");

        return new Collection([]);
    }
}

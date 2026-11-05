<?php

namespace App\Exports;

use App\Models\Backend\Merchantpanel\Invoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class InvoiceExport implements FromCollection, WithHeadings, WithEvents, WithStyles, WithDrawings, WithColumnWidths
{
    protected Collection $invoiceParcels;
    protected Invoice $invoice;

    public function __construct(Collection $invoiceParcels, Invoice $invoice)
    {
        $this->invoiceParcels = $invoiceParcels;
        $this->invoice = $invoice;
    }

    public function headings(): array
    {
        return [
            'Tracking Id',
            'Invoice',
            'Customer Name',
            'Zone',
            'Status',
            'Date',
            'Amount/$',
            'Fees/$',
        ];
    }

    public function collection()
    {
        // Return plain arrays, not JsonResource
        return $this->invoiceParcels->map(function($parcel) {
            return [
                'tracking_id' => $parcel->tracking_id,
                'invoice'     => $parcel->invoice_no,
                'customer'    => $parcel->customer_name,
                'zone'        => $parcel->zone_name,
                'status'      => $parcel->status,
                'date'        => $parcel->invoice_date,
                'amount'      => $parcel->amount,
                'fees'        => $parcel->fees,
            ];
        });
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Header info
                $event->sheet->setCellValue('D1', 'Merchant Name:');
                $event->sheet->setCellValue('D2', 'Location:');
                $event->sheet->setCellValue('D3', 'Date:');

                $event->sheet->setCellValue('E1', $this->invoice->merchant->business_name ?? '');
                $event->sheet->setCellValue('E2', $this->invoice->merchant->address ?? '');
                $event->sheet->setCellValue('E3', $this->invoice->invoice_date ?? '');

                $event->sheet->mergeCells('E1:F1');
                $event->sheet->mergeCells('E2:F2');
                $event->sheet->mergeCells('E3:F3');
            },

            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                $totalRows = $sheet->getHighestRow();
                $lastRow = $totalRows + 1;

                // Totals
                $sheet->setCellValue('A' . $lastRow, 'Total=');
                $sheet->setCellValue('G' . $lastRow, "=SUM(G2:G{$totalRows})"); // Amount
                $sheet->setCellValue('H' . $lastRow, "=SUM(H2:H{$totalRows})"); // Fees
                $sheet->getStyle("A{$lastRow}:H{$lastRow}")->getFont()->setBold(true);

                // Net amount & fees row
                $netRow = $lastRow + 1;
                $sheet->setCellValue('A' . $netRow, 'Net Amount');
                $sheet->setCellValue('B' . $netRow, 'Total Fees');
                $sheet->getStyle("A{$netRow}:B{$netRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => Color::COLOR_WHITE]
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '7e0095'],
                    ],
                ]);

                $valuesRow = $netRow + 1;
                $sheet->setCellValue('A' . $valuesRow, "=G{$lastRow}-H{$lastRow}");
                $sheet->setCellValue('B' . $valuesRow, "=H{$lastRow}");
                $sheet->getStyle("A{$valuesRow}:B{$valuesRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'dae3f3']],
                    'borders' => [
                        'bottom' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => '7e0095']],
                    ],
                ]);

                // AutoFilter
                $sheet->setAutoFilter("A5:H{$totalRows}");

                // Alignment
                $sheet->getStyle("A1:H{$valuesRow}")->getAlignment()->applyFromArray([
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styles = [
            5 => [
                'font' => ['bold' => true, 'color' => ['rgb' => Color::COLOR_WHITE]],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => '7e0095']],
            ],
        ];

        $totalRows = $sheet->getHighestRow();
        for ($i = 6; $i <= $totalRows; $i++) {
            $styles[$i] = ($i % 2 == 1)
                ? ['fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'dae3f3']]]
                : [];
        }

        return $styles;
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png'); // update to your logo path
        if (!file_exists($logoPath)) return null;

        $drawing = new MemoryDrawing();
        $imageResource = imagecreatefromstring(file_get_contents($logoPath));
        $drawing->setImageResource($imageResource);
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');
        return $drawing;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
        ];
    }
}

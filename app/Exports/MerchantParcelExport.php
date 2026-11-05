<?php

namespace App\Exports;

use App\Http\Resources\MerchantParcelExportResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MerchantParcelExport implements FromCollection, WithHeadings, WithEvents, WithStyles
{
    protected $merchantParcel;

    public function __construct($merchantParcel)
    {
        $this->merchantParcel = $merchantParcel;
    }

    public function headings(): array
    {
        return [
            'Invoice ID',
            'Tracking ID',
            'Customer Name',
            'Customer Phone',
            'Customer Address',
            'Status',
            'Cash Collection',
            'Delivery Charge',
            'Vat',
            'COD',
            'Total Charge',
            'Payable'
        ];
    }

    public function collection()
    {
        return MerchantParcelExportResource::collection($this->merchantParcel);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $totalRows = $event->sheet->getHighestRow();
                $lastRow = $totalRows + 1;

                $event->sheet->setCellValue('F' . $lastRow, 'Total=');
                $event->sheet->setCellValue('G' . $lastRow, '=SUM(G2:G' . $totalRows . ')');
                $event->sheet->setCellValue('H' . $lastRow, '=SUM(H2:H' . $totalRows . ')');
                $event->sheet->setCellValue('I' . $lastRow, '=SUM(I2:I' . $totalRows . ')');
                $event->sheet->setCellValue('J' . $lastRow, '=SUM(J2:J' . $totalRows . ')');
                $event->sheet->setCellValue('K' . $lastRow, '=SUM(K2:K' . $totalRows . ')');
                $event->sheet->setCellValue('L' . $lastRow, '=SUM(L2:L' . $totalRows . ')');

                $event->sheet->getStyle('F' . $lastRow . ':L' . $lastRow)->applyFromArray([
                    'font' => ['bold' => true]
                ]);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

<?php

namespace App\Exports;

use App\Starter\Users\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection,WithHeadings,WithStyles,WithEvents,ShouldAutoSize,WithMapping
{
    use Exportable;

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    // set the collection of members to export
    public function collection()
    {
        return  User::where('id', '!=', Auth::id())->get();
    }

    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($user): array
    {
        return [
            $user->name,
            $user->city,
        ];
    }
    public function headings(): array
    {
        return [
            'الاسم',
            'المدينه',
        ];
    }
}

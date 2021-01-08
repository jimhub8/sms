<?php

namespace App\Exports;

use App\Models\Callcenter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class CallcentreExpo implements FromCollection, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Callcenter::all();
    }

    /**
    * @var Invoice $invoice
    */
    // public function map($report): array
    // {
    //     // This example will return 3 rows.
    //     // First row will have 2 column, the next 2 will have 1 column
    //     return [
    //         [
    //             'tetet',
    //             'dekdkek',
    //         ],
    //         [
    //             'dddddd'
    //         ]
    //     ];
    // }

    public function drawings()
    {
        // $drawing = new Drawing();
        // $drawing->setName('Logo');
        // $drawing->setDescription('This is my logo');
        // $drawing->setPath(public_path('/storage/img/logo.png'));
        // $drawing->setHeight(90);
        // $drawing->setCoordinates('B3');

        // return $drawing;


        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/storage/img/logo.png'));
        // $drawing->setPath(public_path('/img/logo.jpg'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B3');

        // $drawing2 = new Drawing();
        // $drawing2->setName('Other image');
        // $drawing2->setDescription('This is a second image');
        // // $drawing2->setPath(public_path('/img/other.jpg'));
        // $drawing->setPath(public_path('/storage/img/logo.png'));
        // $drawing2->setHeight(120);
        // $drawing2->setCoordinates('G2');

        return $drawing;
    }
}

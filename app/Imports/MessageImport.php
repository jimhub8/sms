<?php

namespace App\Imports;

use App\Models\Messages;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MessageImport implements ToModel, WithHeadingRow
// , WithHeadings
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Messages([
            'name'     => $row['name'],
            'phone'    =>  '0' . $row['phone'],
            'address' => $row['address'],
        ]);
    }
}

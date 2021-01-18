<?php

namespace App\Imports;

use App\Models\Messages;
use Maatwebsite\Excel\Concerns\ToModel;

class MessageImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Messages([
            'name'     => $row[0],
            'phone'    =>  '0' . $row[1],
            'address' => $row[2],
        ]);
    }
}

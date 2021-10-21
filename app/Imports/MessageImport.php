<?php

namespace App\Imports;

use App\Models\Messages;
use App\Models\Sms;
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
        $name = $row['name'];
        $phone = $row['phone'];
        $address = $row['address'];

        $clean = new Sms();
        $phone = $clean->clean($phone);
        return new Messages([
            'name'     => $name,
            'phone'    => $phone,
            'address' => $address,
        ]);
    }
}

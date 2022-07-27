<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow 
{
     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'title' => $row['title'],
            'firstName' => $row['first_name'],
            'lastName' => $row['last_name'],
            'age' => $row['age'],
            'address' => $row['address'],
            'sex' => $row['sex'],
            'phonenumber' => $row['phone_number'],
            'img_path' => 'default.jpeg',
        ]);
    }
}

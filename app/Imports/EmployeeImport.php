<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name' => $row['employee_name'],
            'position' => $row['position'],
            'address' => $row['address'],
            'phonenumber' => $row['phone_number'],
            'img_path' => 'default.jpeg',
        ]);
    }
}


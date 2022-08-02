<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Employee;
use DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeImport implements ToCollection, WithHeadingRow 
{
  /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            
            $user = new User();

            $user->userName = $row['user'];
            $user->email = $row['email'];
            $user->password =  Hash::make($row['password']);
            $user->role = 'employee';

            $employee = new Employee();
            $user->save();

            $employee->user_id = DB::getPdo()->lastInsertId();
            $employee->name = $row['employee_name'];
            $employee->position = $row['position'];
            $employee->address = $row['address'];
            $employee->phonenumber = $row['phone_number'];
            $employee->img_path = 'images/employees/default.jpg';

            $employee->save();
            $employee->user()->associate($user->id);

        }
    }
}


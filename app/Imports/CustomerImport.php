<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Customer;
use DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerImport implements ToCollection, WithHeadingRow 
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
            $user->role = 'customer';

            $customer = new Customer();
            $user->save();

            $customer->user_id = DB::getPdo()->lastInsertId();
            $customer->title = $row['title'];
            $customer->firstName = $row['firstname'];
            $customer->lastName = $row['lastname'];
            $customer->age = $row['age'];
            $customer->address = $row['address'];
            $customer->sex = $row['sex'];
            $customer->phonenumber = $row['phonenumber'];
            $customer->img_path = '/images/customers/default.jpg';

            $customer->save();
            $customer->user()->associate($user->id);

        }
    }
}

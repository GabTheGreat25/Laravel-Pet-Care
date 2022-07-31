<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Animal;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnimalImport implements ToCollection, WithHeadingRow
{
  /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            try {
                $customer = Customer::where('firstName',$row['customer'])->firstOrFail();
               }
            catch(ModelNotFoundException $ex) {
                $customer = new customer();
                $customer->firstName = $row['customer'];
                $customer->save();
            }
           
            $animal = new Animal();
            $animal->petName = $row['animal'];
            $animal->Age = $row['age'];
            $animal->Type = $row['type'];
            $animal->Breed = $row['breed'];
            $animal->Sex = $row['sex'];
            $animal->Color = $row['color'];
            $animal->img_path = 'images/animals/default.jpg';
            $animal->customer()->associate($customer);
            $animal->save();
        }
    }
}

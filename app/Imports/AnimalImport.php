<?php

namespace App\Imports;

use App\Models\Animal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnimalImport implements ToModel, WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Animal([
            'petName' => $row['animal_Name'],
            'Age' => $row['Age'],
            'Type' => $row['Type'],
            'Breed' => $row['Breed'],
            'Sex' => $row['Sex'],
            'Color' => $row['Color'],
            'img_path' => 'default.jpeg',
        ]);
    }
}

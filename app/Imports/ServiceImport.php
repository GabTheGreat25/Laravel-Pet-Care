<?php

namespace App\Imports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServiceImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Service([
            'servname' => $row['service_name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'img_path' => ' images/services/default.jpg|images/services/Bam.png|images/services/bg.png|images/services/bichon-teddy-bear.jpg',
           
        ]);
    }
}


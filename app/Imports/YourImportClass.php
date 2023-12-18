<?php

namespace App\Imports;

use App\Models\EmployeeModel;
use App\Models\YourModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class YourImportClass implements ToModel
{
   
    public function model(array $row)
    {
        // Define how to create a model from the Excel row data
        return new EmployeeModel([
            'name' => $row[0],   
            'dob' => $row[1],
            'gender' => $row[2],   
            'address' => $row[3],
            
        ]);
    }
}

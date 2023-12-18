<?php

namespace App\Exports;

use App\Models\EmployeeModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EmployeeModel::all();
    }
}

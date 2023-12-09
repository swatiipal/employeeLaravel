<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\EmployeeModel;
use App\Models\SkillModel;
use App\Models\StateModel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create()
    {
        $skills = SkillModel::all();
        $states = StateModel::all();
        $cities = CityModel::all();
        $data = compact('skills', 'states', 'cities');
        return view('employee.employee')->with($data);
    }
    public function store(Request $request)
    {
        $employee = new EmployeeModel;
        $employee->name = $request['name'];
        $employee->dob = $request['dob'];
        $employee->gender = $request['gender'];
        $employee->address = $request['address'];
        $employee->state = $request['state'];
        $employee->city = $request['city'];

        // echo $employee->image = $request['image']->store('images');
        $imageName = time() . "-credility-image." . $request->file('image')->getClientOriginalExtension();
        echo $request->file('image')->storeAs('public/images', $imageName);
        $employee->image = $request['image'];

        $employee->skills = implode(',', $request['skills']);


        if ($request->hasFile('certificate')) {
            $files = $request->file('certificate');
            // dd($files);
            foreach ($files as $file) {
                // $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . "-credility-files." . $extension;
                $destinationPath = 'public/uploads/';
                echo $file->storeAs($destinationPath, $fileName);
                $employee->certificate = implode(',', $request['certificate']);
            }
        }
        // dd($employee);
        $employee->save();
        return redirect()->back();
    }

    public function view(Request $request)
    {
        $employees = EmployeeModel::all();
        $skills = SkillModel::all();
        $states = StateModel::all();
        $cities = CityModel::all();
        $data = compact('employees', 'skills', 'states', 'cities');
        return view('index')->with($data);
    }

    public function edit(string $id)
    {   
        $employees = EmployeeModel::find($id);
        
        if (!is_null($employees)) {
            $skills = SkillModel::all();
            $states = StateModel::all();
            $cities = CityModel::all();
            $data = compact('employees','skills','states','cities');
            return view('employee.edit')->with($data);
        }else{
            return view('index');
        }
    }
}

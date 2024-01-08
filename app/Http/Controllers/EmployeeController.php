<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\EmployeeModel;
use App\Models\SkillModel;
use App\Models\StateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\YourImportClass;
use Illuminate\Support\Facades\Hash;

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
        $employee->email = $request['email'];
        $employee->password = md5($request['password']);
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
            foreach ($files as $file) {
                // $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . "-credility-files." . $extension;
                $destinationPath = 'public/uploads/';
                echo $file->storeAs($destinationPath, $fileName);
                $employee->certificate = implode(',', $request['certificate']);
            }
        }
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

            $data = compact('employees', 'skills', 'states', 'cities');
            return view('employee.edit')->with($data);
        } else {
            return view('index');
        }
    }
    public function update(Request $request, string $id)
    {
        $employee = EmployeeModel::find($id);
        $employee->name = $request['name'];
        $employee->dob = $request['dob'];
        $employee->email = $request['email'];
        $employee->password = md5($request['password']);
        $employee->gender = $request['gender'];
        $employee->address = $request['address'];
        $employee->state = $request['state'];
        $employee->city = $request['city'];
        $imageName = time() . "-credility-image." . $request->file('image')->getClientOriginalExtension();
        echo $request->file('image')->storeAs('public/images', $imageName);
        $employee->image = $request['image'];

        $employee->skills = implode(',', $request['skills']);

        if ($request->hasFile('certificate')) {
            $files = $request->file('certificate');
            foreach ($files as $file) {
                // $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . "-credility-files." . $extension;
                $destinationPath = 'public/uploads/';
                echo $file->storeAs($destinationPath, $fileName);
                $employee->certificate = implode(',', $request['certificate']);
            }
        }
        $employee->save();
        if ($employee->save()) {
            return redirect()->back();
        }
    }

    public function destroy(string $id)
    {
        $employee = EmployeeModel::find($id);
        if (!is_null($employee)) {
            $employee->delete();
        }
        return redirect()->back();
    }
    
    public function forceDelete(string $id){
        $employee = EmployeeModel::withTrashed()->find($id);
        if (!is_null($employee)) {
            $employee->forceDelete();
        }
        return redirect()->back();
    }
    public function trash(){
        $employees = EmployeeModel::onlyTrashed()->get();
        $skills = SkillModel::all();
        $states = StateModel::all();
        $cities = CityModel::all();
        $data = compact('employees','skills','states','cities');
        return view('employee.utility')->with($data);
    }
    public function restore(string $id){
        $employee = EmployeeModel::withTrashed()->find($id);
        if (!is_null($employee)) {
            $employee->restore();
        }
        return redirect()->back();
    }

    public function city(Request $request)
    {
        $data['state'] = DB::table('state')->orderBy('state_name', 'asc')->get();
        return view('employee.get_cities', $data);
    }

    public function getCity(Request $request)
    {
        $sid = $request->post('sid');
        // echo $sid;
        $city = DB::table('city')->where('state_id', $sid)->orderBy('city_name', 'asc')->get();
        // print_r($city);
        $html = '<option value="">Select City</option>';
        foreach ($city as $list) {
            $id = $list->city_id;
            $html .= "<option value='" . $id . "'>" . $list->city_name . "</option>";
        }
        echo $html;
    }

    public function export() 
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function index(){
        return view('excel-import');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        
        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new YourImportClass, $file);
        
        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }

    public function login(){
        
        return view('login.login');
    }
    public function storedata(Request $request)
    {
        $users = EmployeeModel::where('email',$request->email)->first();
        if ($users) {
            if(Hash::check($request->password, $users->password)){
                session()->put('login',$request->email);
            }else {
                return "Login Failed";
            }
        }else {
            return "Invalid Login!";
        }
        
    }
    
}

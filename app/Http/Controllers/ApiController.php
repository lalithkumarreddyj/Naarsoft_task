<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\EmployeeDetail;
class ApiController extends Controller
{

    public function create(Request $request){
        $employee = new Employee();
        $department = new Department();
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->save();
        
        $department->department_name = $request->input('department_name');
        $dep_id = Department::create([
            'department_name'=>$department->department_name
        ])->id;
       
        $employee_details = new EmployeeDetail();
        $emp_id = Employee::where('firstname',$employee->firstname)->get();

        $employee_details->emp_id = $emp_id[0]->id;
        $employee_details->dep_id = $dep_id;
        $employee_details->save();

        return response()->json($employee_details);
        
    }
}

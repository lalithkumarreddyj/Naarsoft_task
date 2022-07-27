<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\EmployeeDetail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp_details = Employee::select('firstname','lastname','department_name','employees.id')
        ->join('employee_details','employee_details.emp_id','employees.id')
        ->join('departments','departments.id','employee_details.dep_id')
        ->get();
        return view('employees.index',compact('emp_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all());
        $emp_details = Employee::select('firstname','lastname','department_name','employees.id')
        ->join('employee_details','employee_details.emp_id','employees.id')
        ->join('departments','departments.id','employee_details.dep_id')
        ->get();
        if(!empty($request->all())){
            $emp_id = Employee::create([
                'firstname'=>$request->first_name,
                'lastname'=>$request->last_name,
            ])->id;
            
            $dep_id = Department::create([
                'department_name'=>$request->department_name
            ])->id;
            EmployeeDetail::create([
                'emp_id'=> $emp_id,
                'dep_id'=> $dep_id,
            ]);
        }
        
       return redirect('/employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $employee = Employee::find($id);
        $employee  = Employee::select('firstname','lastname','department_name','employees.id')
        ->join('employee_details','employee_details.emp_id','employees.id')
        ->join('departments','departments.id','employee_details.dep_id')
        ->where('employees.id',$id)
        ->get();
        // print_r($employee);exit;
        return view('employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       Employee::where('id',$id)
       ->update([
            'firstname'=>$request->first_name,
            'lastname'=>$request->last_name,
        ]);
        $emdet_id = EmployeeDetail::select('dep_id')->where('emp_id',$id)->get();
        Department::where('id',$emdet_id[0]->dep_id)
        ->update([
            'department_name'=>$request->department_name,
        ]);
        return redirect('/employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete(); // Easy right?
 
        return redirect('/employee');
    }
}

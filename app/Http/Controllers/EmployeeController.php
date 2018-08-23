<?php

namespace App\Http\Controllers;

use App\User;
use App\Access;
use App\Agencies;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home      = 1;
        $agency    = User::TypeUser(Auth()->user()->email);
        $employeeAcces = Access::all();
        $employees = Employees::Agency($agency->id);
        return view('employee.index',compact('home','employees','employeeAcces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home      = 1;
        return view('employee.create',compact('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v= $this->validate($request, [
            'agency' => '',
            'name'   => 'required',
            'email'  => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/|unique:employees,email',
            'phone'  => 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $agency = User::TypeUser(Auth()->user()->email);
        $employee = new Employees();
        $employee->agency = $agency->id;
        $employee->name   = $request->name;
        $employee->email  = $request->email;
        $employee->phone  = $request->phone;
        $employee->save();

        $employeeUser = new User();
        $employeeUser->name     = $request->name;
        $employeeUser->email    = $request->email;
        $employeeUser->rol      = 3;
        $employeeUser->password = Hash::make($request->email);
        $employeeUser->save();

        $employees = Employees::all();
        $employee2 = $employees->last();

        $access = new Access();
        $access->employee = $employee2->id;
        $access->records  = @$request->access[0];
        $access->moves    = @$request->access[1];
        $access->email    = @$request->access[2];
        $access->informes = @$request->access[3];
        $access->save();

        return redirect()->to('empleados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $home = 1;
        $employee = Employees::FindOrFail($id);
        return view('employee.edit',compact('home','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Employees::FindOrFail($id)->update($request->all());
        return redirect()->to('empleados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employees::FindOrFail($id)->delete();
        return redirect()->to('empleados');
    }
}

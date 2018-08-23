<?php

namespace App\Http\Controllers;

use App\User;
use App\Agencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AgencyController extends Controller
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
        $v= $this->validate($request, [
          'name'          => 'required',
          'personContact' => 'required',
          'rif'           => 'required',
          'address'       => 'required',
          'phone'         => 'required',
          'email'         => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/|unique:agencies,email'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $agency = Agencies::create($request->all());

        if ($request->file('logo')) {
            $path = Storage::disk('public')->put('storage',  $request->file('logo'));
            $agency->fill(['logo' => asset($path)])->save();
        }

        $agencyUser = new User();
        $agencyUser->name     = $request->name;
        $agencyUser->email    = $request->email;
        $agencyUser->rol      = 2;
        $agencyUser->password = Hash::make($request->rif);
        $agencyUser->save();

        return redirect()->to('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agencies::findOrFail($id);
        return view('agency.edit',compact('agency'));
    }

    public function agencyEdit()
    {
        $agency = User::TypeUser(Auth()->user()->email);
        $agency = Agencies::findOrFail($agency->id);
        return view('agency.edit',compact('agency'));
    }

    public function newPassword()
    {   
        $home = 1;
        $agency = User::TypeUser(Auth()->user()->email);
        $agency = Agencies::findOrFail($agency->id);
        return view('agency.newPassword',compact('home','agency'));
    }

    public function postPassword(Request $request)
    {
        request()->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $agency = User::findOrFail(Auth()->user()->id);
        $agency->password = Hash::make($request->password);
        $agency->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {   
        $agency = Agencies::findOrFail($id);
        $agency->name          = $request->name;
        $agency->personContact = $request->personContact;
        $agency->email         = $request->email;
        $agency->rif           = $request->document;
        $agency->address       = $request->address;
        $agency->phone         = $request->phone;
        $agency->logo          = $request->log;
        $agency->save();

        if ($request->file('logo')) {
            $path = Storage::disk('public')->put('storage',  $request->file('logo'));
            $agency->fill(['logo' => asset($path)])->save();
        }
        return redirect()->to('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agency = Agencies::findOrFail($id)->delete();
        return response()->json('status',200);
    }
}

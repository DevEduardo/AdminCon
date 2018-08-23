<?php

namespace App\Http\Controllers;

use App\User;
use App\Condominiums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CondominiumController extends Controller
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
        $condominiums = Condominiums::all();
        $home = 1;
        return view('condominium.index',compact('condominiums','home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $home = 0;
        return view('condominium.create',compact('home'));
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
          'document'      => 'required',
          'address'       => 'required',
          'phone'         => 'required',
          'message'       => 'required',
          'calculation'   => 'required',
          'email'         => 'required',
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $condominium = new Condominiums();
        $condominium->name          = $request->name;
        $condominium->personContact = $request->personContact;
        $condominium->document      = $request->document;
        $condominium->address       = $request->address;
        $condominium->phone         = $request->phone;
        $condominium->message       = $request->message;
        $condominium->calculation   = $request->calculation;
        $condominium->amount        = $request->amount;
        $condominium->email         = $request->email;
        $condominium->save();

        if ($request->file('logo')) {
            $path = Storage::disk('public')->put('storage',  $request->file('logo'));
            $condominium->fill(['logo' => asset($path)])->save();
        }

        return redirect()->to('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Condominiums  $condominiums
     * @return \Illuminate\Http\Response
     */
    public function show(Condominiums $condominiums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Condominiums  $condominiums
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $condominium = Condominiums::findOrFail($id);
        $home = 1;
        return view('condominium.edit',compact('condominium','home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Condominiums  $condominiums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $v= $this->validate($request, [
          'name'          => 'required',
          'personContact' => 'required',
          'document'      => 'required',
          'address'       => 'required',
          'phone'         => 'required',
          'message'       => 'required',
          'calculation'   => 'required',
          'email'         => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
          'logo'          =>'',
          'agency'        =>''
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $condominium = Condominiums::findOrFail($id);
        $condominium->name          = $request->name;
        $condominium->personContact = $request->personContact;
        $condominium->document      = $request->document;
        $condominium->address       = $request->address;
        $condominium->phone         = $request->phone;
        $condominium->message       = $request->message;
        $condominium->calculation   = $request->calculation;
        $condominium->email         = $request->email;
        $condominium->save();

        if ($request->file('logo')) {
            $path = Storage::disk('public')->put('storage',  $request->file('logo'));
            $condominium->fill(['logo' => asset($path)])->save();
        }

        return redirect()->to('condominios');
    }

    public function lockOrUnlock($id)
    {
        $condominium = Condominiums::findOrFail($id);
        if ($condominium->status == 1) {
            $condominium->status = 0;

        }else{
            $condominium->status = 1;
        }
        $condominium->save();
        return redirect()->to('condominios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Condominiums  $condominiums
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condominium = Condominiums::findOrFail($id)->delete();
        return redirect()->to('condominios');
    }
}

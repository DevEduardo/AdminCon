<?php

namespace App\Http\Controllers;

use App\Bills;
use Illuminate\Http\Request;

class BillController extends Controller
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
        $bills = Bills::all();
        return view('bill.index',compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$v= $this->validate($request, [
          'name' => 'required'
        ]);
        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }*/

        if ($request->finance == 1 || $request->finance == 2) {
            $estimate = $request->estimate;
        }else{
            $estimate = $request->estimate2;
        }

        $bill = new Bills();
        $bill->name     = $request->name;
        $bill->finance  = $request->finance;
        $bill->estimate = $estimate;
        $bill->value    = $request->value;
        $bill->save();
        return redirect()->to('cuentas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bills::findOrFail($id);
        return view('bill.edit',compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v= $this->validate($request, [
          'name' => 'required',
          'code' => 'required'
        ]);
        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $bill = Bills::findOrFail($id);
        $bill->name     = $request->name;
        $bill->code     = $request->code;
        $bill->finance  = $request->finance;
        $bill->estimate = $request->estimate;
        $bill->value    = $request->value;
        $bill->save();
        return redirect()->to('cuentas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bills  $bills
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bills::findOrFail($id)->delete();
        return redirect()->to('cuentas');
    }
}

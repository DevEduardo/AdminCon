<?php

namespace App\Http\Controllers;

use App\User;
use App\Salons;
use Carbon\Carbon;
use App\Reservation;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salons = Salons::all();
        return view('salon.index', compact('salons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $home = 1;
        return view('salon.create', compact('home'));
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
            'agency'       => '',
            'name'         => 'required',
            'capacity'     => 'required',
            'available'    => '',
            'nextDateRent' => '',
            'preci'        => 'required'
        ]);
        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $salon = new Salons();
        $salon->name         = $request->name;
        $salon->capacity     = $request->capacity;
        $salon->available    = 1;
        $salon->nextDateRent = NULL;
        $salon->preci        = $request->preci;
        $salon->save();
        return redirect()->to('salones');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salons  $salons
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salon = Salons::findOrFail($id);
        return view('salon.edit', compact('salon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salons  $salons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $v= $this->validate($request, [
            'agency'       => '',
            'name'         => 'required',
            'capacity'     => 'required',
            'available'    => '',
            'nextDateRent' => '',
            'preci'        => 'required'
        ]);
        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        if ($request->available == '') {
            $available = 0;
        }elseif($request->available == 1){
            $available = $request->available;
        }
        $salon = Salons::findOrFail($id);
        $salon->name         = $request->name;
        $salon->capacity     = $request->capacity;
        $salon->available    = $available;
        $salon->nextDateRent = $request->nextDateRent;
        $salon->preci        = $request->preci;
        $salon->save();
        return redirect()->to('salones');
    }

    public function reservation()
    {
        $salons = Salons::SalonsReservado();
        return view('salon.reservado', compact('salons'));
        
    }

    public function reserved(Request $request)
    {
        $salon = Salons::findOrFail($request->salonId);
        $resident = User::Resident(Auth()->user()->email);
        $date = date_create($request->date);
        $dateSQl = date_format($date, 'Y-m-d');

        if ($salon->nextDateRent == $dateSQl) {
            echo 'el salon ya esta reservado para esa fecha';
        }elseif ( Carbon::now()->format('Y-m-d') >= $dateSQl) {
            echo 'debe seleccionar una fecha mayor a la actual';
        }else{
            $salon = new Reservation();
            $salon->property = $resident->id;
            $salon->salon    = $request->salonId;
            $salon->date     = $dateSQl;
            $salon->save();
            return redirect()->back();
        }
    }

    public function reservedAgency(Request $request)
    {
        $salon = Salons::findOrFail($request->salonId);
        $resident = User::TypeUser(Auth()->user()->email);
        $date = date_create($request->date);
        $dateSQl = date_format($date, 'Y-m-d');

        if ($salon->nextDateRent == $dateSQl) {
            echo 'el salon ya esta reservado para esa fecha';
        }elseif ( Carbon::now()->format('Y-m-d') >= $dateSQl) {
            echo 'debe seleccionar una fecha mayor a la actual';
        }else{
            $salon = new Reservation();
            $salon->property = $resident->id;
            $salon->salon    = $request->salonId;
            $salon->date     = $dateSQl;
            $salon->save();
            return redirect()->back();
        }
    }

    public function reservedProperty()
    {
        $resident = User::Resident(Auth()->user()->email);
        $salons   = Reservation::Property($resident->id);
        $home     = 1;
        return view('resident.reservation',compact('home','salons'));
    }

    public function approved($id)
    {
        Salons::findOrFail($id)->update(['status'=>1]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salons  $salons
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salons::findOrFail($id)->delete();
        return redirect()->to('salones');
    }
}

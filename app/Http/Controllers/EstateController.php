<?php

namespace App\Http\Controllers;

use App\User;
use App\Dues;
use App\Salons;
use App\Estate;
use App\Payments;
use App\Expenses;
use Illuminate\Http\Request;

class EstateController extends Controller
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
        $estate = Estate::GetEstateCondominium(session('idCondominium'));
        return view('property.index',compact('estate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('property.create');
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
            'condominium'     => '', 
            'numebreProperty' => 'required', 
            'owner'           => 'required', 
            'document'        => 'required', 
            'phone'           => 'required', 
            'email'           => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', 
            'aliquot'         => 'required', 
            'assistant'       => 'required', 
            'gas'             => 'required', 
            'water'           => 'required', 
            'light'           => 'required', 
            'area'            => 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $property = new Estate();
        $property->condominium     = session('idCondominium');
        $property->numebreProperty = $request->numebreProperty;
        $property->owner           = $request->owner;
        $property->document        = $request->document;
        $property->phone           = $request->phone;
        $property->email           = $request->email;
        $property->aliquot         = $request->aliquot;
        $property->assistant       = $request->assistant;
        $property->gas             = $request->gas;
        $property->water           = $request->water;
        $property->light           = $request->light;
        $property->area            = $request->area;
        $property->save();

        return redirect()->to('inmuebles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Estate::findOrFail($id);
        return view('property.edit',compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v= $this->validate($request, [
            'condominium'     => '', 
            'numebreProperty' => 'required', 
            'owner'           => 'required', 
            'document'        => 'required', 
            'phone'           => 'required', 
            'email'           => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', 
            'aliquot'         => 'required', 
            'assistant'       => 'required', 
            'gas'             => 'required', 
            'water'           => 'required', 
            'light'           => 'required', 
            'area'            => 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $property = Estate::findOrFail($id);
        $property->condominium     = session('idCondominium');
        $property->numebreProperty = $request->numebreProperty;
        $property->owner           = $request->owner;
        $property->document        = $request->document;
        $property->phone           = $request->phone;
        $property->email           = $request->email;
        $property->aliquot         = $request->aliquot;
        $property->assistant       = $request->assistant;
        $property->gas             = $request->gas;
        $property->water           = $request->water;
        $property->light           = $request->light;
        $property->area            = $request->area;
        $property->save();

        return redirect()->to('inmuebles');
    }

    public function getPayment($id)
    {
        $property = Estate::findOrFail($id);
        $dues     = Dues::Property($id);
        $payments = Payments::Property($id);
        return view('property.getPayment',compact('property','dues','payments'));
    }

    public function payment()
    {
        $estate = Estate::GetEstateCondominiumActive(session('idCondominium'));
        return view('property.pago',compact('estate'));
    }

    public function postPayment(Request $request)
    {   
        if ($request->property == '') {
           return redirect()->to('pago');
        }else{
            $property = Estate::findOrFail($request->property);
            $dues     = Dues::Property($request->property);
            $payments = Payments::Property($request->property);
            return view('property.getPayment',compact('property','dues','payments'));
        }
    }

    public function debts($id)
    {
        $property = Estate::findOrFail($id);
        return view('property.deudas',compact('property'));
    }

    public function postDebts(Request $request ,$id)
    {
        $v= $this->validate($request, [
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $due = new Dues();
        $due->property = $id;
        $due->month    = $request->month.'/'.$request->year;
        $due->type     = 'DE';
        $due->number   = number();
        $due->amount   = $request->amount;
        $due->status   = 0;
        $due->save();

        $property = Estate::findOrFail($id);
        $debitNew = $property->debit + $request->amount;
        $property->debit = $debitNew;
        $property->save();
        return redirect()->to('inmuebles');        
    }

    public function lockOrUnlock($id)
    {
        $property = Estate::findOrFail($id);
        if ($property->status == 1) {
            $property->status = 0;

        }else{
            $property->status = 1;
        }
        $property->save();
        return redirect()->to('inmuebles');
    }

    public function salon()
    {   
        $salons   = Salons::all();
        return view('resident.salon',compact('salons'));
    }

    public function email()
    {
        return view('resident.email');
    }

    public function payments()
    {
        $resident = User::ResidentId(Auth()->user()->email);
        return view('resident.payment',compact('resident'));
    }

    public function notificacion(Request $request)
    {
        $v= $this->validate($request, [
            'estate'          => '',
            'date'            => 'required',
            'reference'       => '',
            'concept'         => 'required',
            'wayToPay'        => 'required',
            'operationNumber' => '',
            'checkNumber'     => '',
            'cardNumber'      => '',
            'issuingBank'     => '',
            'amount'          => 'required',
            'status'          => ''
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $date = date_create($request->date);
        $dateSQl = date_format($date, 'Y-m-d');
        
        $payment = new Payments();
        $payment->estate          = $request->estate;
        $payment->date            = $dateSQl;
        $payment->concept         = $request->concept;
        $payment->reference       = generarCodigo(5);
        $payment->wayToPay        = $request->wayToPay;
        $payment->operationNumber = $request->operationNumber;
        $payment->checkNumber     = $request->checkNumber;
        $payment->cardNumber      = $request->cardNumber;
        $payment->issuingBank     = $request->issuingBank;
        $payment->amount          = $request->amount;
        $payment->status          = 0;
        $payment->save();

        return redirect()->back();
    }

    public function approved($id)
    {
        $expense = Payments::findOrFail($id)->update(['status' => 1]);
        return redirect()->to('home');
    }

    public function deny($id)
    {
        $expense = Payments::findOrFail($id)->update(['status' => 2]);
        return redirect()->to('home');
    }

    public function mora()
    {
        $estate = Dues::PropertyMora(session('idCondominium'));
        return view('property.mora',compact('estate'));
    }

    public function postMora(Request $request)
    {
        $home = 1;
        $dues = Dues::PropertyMora(session('idCondominium'));
        $estate = Estate::PropertyBetween($request->desde, $request->hasta);
        foreach ($estate as $key => $property) {
            $mora = 0;
            foreach ($dues as $key => $due) {
                if ($property->id == $due->id) {
                    $dueAmount = Dues::Property($property->id);
                    $mora = $dueAmount[0]->amount + (($dueAmount[0]->amount * $request->percentage) / 100);
                    $dueAmount[0]->amount = $mora;
                    $dueAmount[0]->save();
                }
            }
            $property2 = Estate::findOrFail($property->id)->update(['debit'=>$mora]);
        }
       return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Estate::findOrFail($id)->delete();
        return redirect()->to('inmuebles');
    }

    public function getData($id)
    {
        $property = Estate::findOrFail($id);
        return response()->json($property);
    }
}

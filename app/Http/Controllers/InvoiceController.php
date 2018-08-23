<?php

namespace App\Http\Controllers;

use App\Estate;
use App\Detalle;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function invoice()
    {   
        $home = 1;
        $estate = Estate::GetEstateCondominium(session('idCondominium'));
        return view('invoice.create', compact('home','estate'));
    }

    public function storeInvoice(Request $request)
    {
        return response()->json($request->all());
        /*$v= $this->validate($request, [
            'number'       => 'required|unique:invoice,number',
            'property'     => 'required',
            'businessName' => 'required',
            'document'     => 'required',
            'phone'        => 'required'
        ]);
        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }*/

        /*$invoice = new Invoice();
        $invoice->number          = $request->number;
        $invoice->businessName    = $request->businessName;
        $invoice->document        = $request->document;
        $invoice->phone           = $request->phone;
        $invoice->iva             = $request->iva;
        $invoice->total           = $request->total;
        $invoice->wayToPay        = $request->wayToPay;
        $invoice->operationNumber = $request->operationNumber;
        $invoice->issuingBank     = $request->issuingBank;
        $invoice->save();

        for ($i=0; $i < $request->numberInput; $i++) { 
            $total = str_replace('.','',$request->total[$i]);
            $total2 = str_replace(',','.',$total);
            $detalle = new Detalle();
            $detalle->invoice  = $request->number;
            $detalle->quantity = $request->quantity[$i];
            $detalle->concept  = $request->concept[$i];
            $detalle->total    = $total2;
            $detalle->save();
        }  
        return redirect()->back();*/
    }

    public function getInvoice($value)
    {   $res =0;
        $number = Invoice::InvoiceNumber($value);
        if ($number->count() >0) {
            $res = 201;
        }else{
            $res = 200;
        }
        return response()->json($res);
    }

    
}

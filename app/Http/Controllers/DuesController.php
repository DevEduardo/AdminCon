<?php

namespace App\Http\Controllers;

use App\Dues;
use App\Estate;
use App\Payments;
use Illuminate\Http\Request;

class DuesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pago(Request $request)
    {
        $v= $this->validate($request, [
            'date'            => 'required',
            'reference'       => 'required',
            'concept'         => 'required',
            'wayToPay'        => 'required',
            'amount'          => 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $payment  = new Payments();
        $payment->estate          = $request->estate;
        $payment->date            = $request->date;
        $payment->reference       = $request->reference;
        $payment->concept         = $request->concept;
        $payment->wayToPay        = $request->wayToPay;
        $payment->operationNumber = $request->operationNumber;
        $payment->checkNumber     = $request->checkNumber;
        $payment->cardNumber      = $request->cardNumber;
        $payment->issuingBank     = $request->issuingBank;
        $payment->amount          = $request->amount;   
        $payment->save();    

        $due      = Dues::findOrFail($request->id)->update(['status'=>1]);
        $property = Estate::findOrFail($request->estate);
        $debitNew = $property->debit - $request->amount;
        $property->debit = $debitNew;
        $property->save();
        
        return redirect()->to('inmuebles/pago/'.$request->estate);
    }
}

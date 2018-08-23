<?php

namespace App\Http\Controllers;

use App\Dues;
use App\Bills;
use App\Extra;
use App\Estate;
use App\Expenses;
use App\OwnerFees;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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
    public function index(Request $request)
    {   
        if ($request->month) {
            $totals           = $this->getTotals();
            $month            = $request->month;
            $year             = date('Y');
            $bills            = Bills::NotFund();
            $billss           = Bills::all();
            $estate           = Estate::GetEstateCondominium(session('idCondominium'));
            $expenses         = Expenses::MonthCondominium($month, session('idCondominium'));
            $totalGeneral     = Expenses::MonthCondominium($month, session('idCondominium'))->sum('amount');
            $withCalculations = Expenses::WithCalculations($month, session('idCondominium'));
            $calculatedFee    = Dues::CalculatedFee($month);
            if (count($calculatedFee) > 0) {
                $calculatedFee = true;
            }else{
                $calculatedFee = false;
            }
            if (count($withCalculations) > 0) {
                $calculation = true;
            }else{
                $calculation = false;
            }
            return view('expense.index',compact('totalGeneral','calculation','totals','month','year','bills','billss','expenses','estate'));
        }else{
            $totals           = $this->getTotals();
            $month            = date('m');
            $year             = date('Y');
            $bills            = Bills::NotFund();
            $billss           = Bills::all();
            $estate           = Estate::GetEstateCondominium(session('idCondominium'));
            $expenses         = Expenses::MonthCondominium($month, session('idCondominium'));
            $withCalculations = Expenses::WithCalculations($month, session('idCondominium'));
            $totalGeneral     = Expenses::MonthCondominium($month, session('idCondominium'))->sum('amount');
            $calculatedFee    = Dues::CalculatedFee($month);
            if (count($calculatedFee) > 0) {
                $calculatedFee = true;
            }else{
                $calculatedFee = false;
            }
            if (count($withCalculations) > 0) {
                $calculation = true;
            }else{
                $calculation = false;
            }
            return view('expense.index',compact('totalGeneral','calculatedFee','calculation','totals','month','year','bills','billss','expenses','estate'));
        }
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
          'condominium' => '',
          'account'     => 'required',
          'reference'   => 'required',
          'description' => 'required',
          'amount'      => 'required'
        ]);
        if($request->account == 0){
            return redirect()->to('gastos');
        }

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }
        if ($request->share == 'NULL') {
            $share = 0;
        }else{
            $share = $request->share;
        }

        if ($request->calculation != 1 && $request->calculation != 2) {
            $calculation = 0;
        }else{
            $calculation = $request->calculation;
        }
        $expense = new Expenses();
        $expense->condominium = session('idCondominium');
        $expense->account     = $request->account;
        $expense->reference   = $request->reference;
        $expense->description = $request->description;
        $expense->amount      = $request->amount;
        $expense->share       = $share;
        $expense->calculation = $calculation;//1 Numero de inmuebles || 2 cuota auxiliar
        $expense->save();

        if ($request->calculation == 1 && $request->share == 1) {
            $expense   = Expenses::all();
            $idExpense = $expense->last();
            for ($i=0; $i < count($request->apply) ; $i++) { 
                $extra = new Extra();
                $extra->property = $request->apply[$i];
                $extra->expense  = $idExpense->id; 
                $extra->save();
            }
        }

        return redirect()->to('gastos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v= $this->validate($request, [
          'condominium'=> '',
          'account'=> 'required',
          'reference'=> 'required',
          'description'=> 'required',
          'amount'=> 'required',
          'share'=> 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $expense = Expenses::findOrFail($id);
        $expense->account     = $request->account;
        $expense->reference   = $request->reference;
        $expense->description = $request->description;
        $expense->amount      = $request->amount;
        $expense->share       = $request->share;
        $expense->save();
        return redirect()->to('gastos');
    }

    public function copy()
   {  
      $month           = date('m');
      $expensesCurrent = Expenses::MonthCondominium($month, session('idCondominium'));

      foreach ($expensesCurrent as $key => $value) {
        $expenseNew              = new Expenses();
        $expenseNew->condominium  = $value->condominium;
        $expenseNew->account      = $value->account;
        $expenseNew->reference    = $value->reference;
        $expenseNew->description  = $value->description;
        $expenseNew->amount       = $value->amount;
        $expenseNew->share        = $value->share;
        $expenseNew->created_at   = new Carbon('next month');
        $expenseNew->save();
      }
      return redirect()->to('gastos');
    }

    /***
    *
    *
    *
    ***/

    public function calculateFunds()
    {
        $expenses     = Expenses::MonthCondominium(date('m'), session('idCondominium'));
        $funds        = Bills::fund();
        $totals = $this->getTotals();
        foreach ($funds as $fund) {
            if ($fund->finance == 1) {
                switch ($fund->estimate) {
                    case '1':
                        $amount = ($totals['sumGastos'] * $fund->value ) / 100;
                        $expense = new Expenses();
                        $expense->condominium = session('idCondominium');
                        $expense->account     = $fund->id;
                        $expense->reference   = generarCodigo(5);
                        $expense->description = $fund->name;
                        $expense->amount      = $amount;
                        $expense->share       = 3;
                        $expense->save();
                        break;
                    case '2':
                        $amount = ($fund->value * $totals['sumGastos'] + $totals['reserveFund']) / 100;
                        $expense = new Expenses();
                        $expense->condominium = session('idCondominium');
                        $expense->account     = $fund->id;
                        $expense->reference   = generarCodigo(5);
                        $expense->description = $fund->name;
                        $expense->amount      = $amount;
                        $expense->share       = 3;
                        $expense->save();
                        break;
                    
                    default:
                        
                        break;
                }
            }elseif($fund->finance == 2){
                switch ($fund->estimate) {
                    case '1':
                        $amount = ($totals['sumGastos'] * $fund->value ) / 100;
                        $expense = new Expenses();
                        $expense->condominium = session('idCondominium');
                        $expense->account     = $fund->id;
                        $expense->reference   = generarCodigo(5);
                        $expense->description = $fund->name;
                        $expense->amount      = $amount;
                        $expense->share       = 3;
                        $expense->save();

                        $this->iva($amount);

                        break;
                    case '2':
                        $amount = (($totals['sumGastos'] + $totals['reserveFund']) * $fund->value ) / 100;
                        $expense = new Expenses();
                        $expense->condominium = session('idCondominium');
                        $expense->account     = $fund->id;
                        $expense->reference   = generarCodigo(5);
                        $expense->description = $fund->name;
                        $expense->amount      = $amount;
                        $expense->share       = 3;
                        $expense->save();

                        $this->iva($amount);

                        break;
                    
                    default:
                        
                        break;
                }
            }  
        }

        $expense = Expenses::MonthCondominium(date('m'), session('idCondominium'));
        foreach ($expense as $key => $value) {
            Expenses::find($value->id)->update(['status'=>1]);
        }   
    }

    /***
    * 
    * 
    * 
    ***/
    public function calculate()
    {   
        $estate       = Estate::GetEstateCondominiumActive(session('idCondominium'));
        $expenses     = Expenses::MonthCondominium(date('m'), session('idCondominium'));
        $bills        = Bills::all();
        $numberEstate = count($estate);
        foreach ($estate as $property) {
            if (session('calculationCondominium') == 0) {
                $amount = 0;
                foreach ($expenses as $expense) {
                    if ($expense->share == 1 && $expense->calculation ==1) {
                        $share = $expense->amount / $numberEstate;
                        $ownerFees = new OwnerFees();
                        $ownerFees->property      = $property->id;
                        $ownerFees->share         = $expense->id;
                        $ownerFees->participation = $share;
                        $ownerFees->save();
                        $amount += $share;
                    }elseif($expense->share == 1 && $expense->calculation ==2){
                        $share = $expense->amount / $property->assistant;
                        $ownerFees = new OwnerFees();
                        $ownerFees->property      = $property->id;
                        $ownerFees->share         = $expense->id;
                        $ownerFees->participation = $share;
                        $ownerFees->save();
                        $amount += $share;
                    }else{
                        foreach ($bills as $key => $bil) {
                            if ($bil->id == $expense->account ) {
                                switch ($bil->estimate) {
                                    case '1':
                                        $share = $expense->amount * $property->aliquot;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '2':
                                        $share = $expense->amount * $property->aliquot;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '3':
                                        $share = $expense->amount * $property->aliquot;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '4':
                                        $share = $expense->amount * $property->assistant;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '5':
                                        $share = $expense->amount * $property->gas;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '6':
                                        $share = $expense->amount * $property->light;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '7':
                                        $share = $expense->amount * $property->water;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '9':
                                        $share = $expense->amount * $property->aliquot;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            }
                        }
                    }
                }
                $dues = new Dues();
                $dues->property = $property->id;
                $dues->month    = date('m/Y');
                $dues->type     = 'FC';
                $dues->number   = number();
                $dues->amount   = round($amount,4);
                $dues->status   = 0;
                $dues->save();

                $propertyDebit = Estate::findOrFail($property->id);
                $debit = $propertyDebit->debit + round($amount,4);
                $propertyDebit->debit = $debit;
                $propertyDebit->save();
            }elseif (session('calculationCondominium') == 1){
                $amount = 0;
                foreach ($expenses as $expense) {
                    if ($expense->share == 1 && $expense->calculation ==1) {
                        $share = $expense->amount / $numberEstate;
                        $ownerFees = new OwnerFees();
                        $ownerFees->property      = $property->id;
                        $ownerFees->share         = $expense->id;
                        $ownerFees->participation = $share;
                        $ownerFees->save();
                        $amount += $share;
                    }elseif($expense->share == 1 && $expense->calculation ==2){
                        $share = $expense->amount / $property->assistant;
                        $ownerFees = new OwnerFees();
                        $ownerFees->property      = $property->id;
                        $ownerFees->share         = $expense->id;
                        $ownerFees->participation = $share;
                        $ownerFees->save();
                        $amount += $share;
                    }else{
                        foreach ($bills as $key => $bil) {
                            if ($bil->id == $expense->account ) {
                                switch ($bil->estimate) {
                                    case '1':
                                        $share = $expense->amount * session('amountCondominium');
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '2':
                                        $share = $expense->amount * session('amountCondominium');
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '3':
                                        $share = $expense->amount * session('amountCondominium');
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '4':
                                        $share = $expense->amount * $property->assistant;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '5':
                                        $share = $expense->amount * $property->gas;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '6':
                                        $share = $expense->amount * $property->light;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '7':
                                        $share = $expense->amount * $property->water;
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '9':
                                        $share = $expense->amount * session('amountCondominium');
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    case '10':
                                        $share = $expense->amount * session('amountCondominium');
                                        $ownerFees = new OwnerFees();
                                        $ownerFees->property      = $property->id;
                                        $ownerFees->share         = $expense->id;
                                        $ownerFees->participation = $share;
                                        $ownerFees->save();
                                        $amount += $share;
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            }
                        }
                    }
                }
                $dues = new Dues();
                $dues->property = $property->id;
                $dues->month    = date('m/Y');
                $dues->type     = 'FC';
                $dues->number   = number();
                $dues->amount   = round($amount,4);
                $dues->status   = 0;
                $dues->save();

                $propertyDebit = Estate::findOrFail($property->id);
                $debit = $propertyDebit->debit + round($amount,4);
                $propertyDebit->debit = $debit;
                $propertyDebit->save(); 
            }
        }
        $cuotas = dues::ShareMonthProperty(date('m'));
        return response()->json($cuotas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense             = Expenses::findOrFail($id)->delete();
        $estate              = Estate::all();
        $expenses            = Expenses::MonthCondominium(date('m'), session('idCondominium'));
        $dues                = Dues::CalculatedFee(date('m'));
        $calculatedOwnerFees = OwnerFees::CalculatedOwnerFees(date('m'));
        foreach ($calculatedOwnerFees as $key => $value) {
            OwnerFees::find($value->id)->delete();
        }
        foreach ($dues as $key => $value) {
            $due = Dues::find($value->id);
            foreach ($estate as $property) {
                if ($value->property == $property->id) {
                    $debit = $property->debit - $value->amount;
                    Estate::findOrFail($property->id)->update(['debit'=>$debit]);
                }
            }
            Dues::find($value->id)->delete();
        }
        foreach ($expenses as $key => $value) {
            Expenses::find($value->id)->update(['status'=>0]);
        }

        $fund = Expenses::where('share',3)->delete();
        return response()->json(['status'=>200]);
    }

    public function getTotals($value='')
    {
        $month = date('m');
        $common    = Expenses::Share(0, session('idCondominium'), $month);
        $extra     = Expenses::Share(2, session('idCondominium'), $month);
        $notCommon = Expenses::Share(1, session('idCondominium'), $month);

        $totalCommon    = Expenses::Share(0, session('idCondominium'), $month)->sum('amount');
        $totalExtra     = Expenses::Share(2, session('idCondominium'), $month)->sum('amount');
        $totalNotCommon = Expenses::Share(1, session('idCondominium'), $month)->sum('amount');
        $sumGastos      = $totalCommon + $totalExtra + $totalNotCommon;
        $reserveFund    = ($sumGastos * 10) / 100;

        $totals = [
            'totalCommon' => $totalCommon,
            'totalExtra' => $totalExtra,
            'totalNotCommon' => $totalNotCommon,
            'sumGastos' => $sumGastos,
            'reserveFund' => $reserveFund
        ];

        return $totals;
    }

    public function iva($hp)
    {   
        $iva = Bills::where('name','like','%IVA%')->first();
        // dd($iva);
        if ($iva != null) {

            $amount = ($hp * 12) / 100;
            $expense = new Expenses();
            $expense->condominium = session('idCondominium');
            $expense->account     = $iva->id;
            $expense->reference   = generarCodigo(5);
            $expense->description = $iva->name;
            $expense->amount      = $amount;
            $expense->share       = 3;
            $expense->save();
        }else{
            $bill = new Bills();
            $bill->name     = 'IVA';
            $bill->finance  = 1;
            $bill->estimate = 9;
            $bill->value    = 12;
            $bill->save();  

            $amount = ($hp * 12) / 100;
            $expense = new Expenses();
            $expense->condominium = session('idCondominium');
            $expense->account     = $bill->id;
            $expense->reference   = generarCodigo(5);
            $expense->description = $bill->name;
            $expense->amount      = $amount;
            $expense->share       = 3;
            $expense->save();         
        }
    
        
    }
}

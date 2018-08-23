<?php

namespace App\Http\Controllers;

use App\Dues;
use App\Estate;
use App\Expenses;
use Illuminate\Http\Request;

class InformeController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	
    }

    public function avisoCobro()
    {
    	$estate = Estate::GetEstateCondominiumActive(session('idCondominium'));
    	$expenses = Expenses::MonthCondominium(date('m'), session('idCondominium'));
    	foreach ($estate as $key => $value) {
    		echo $value->owner.'<br>';
    		foreach ($expenses as $key => $expense) {
    			echo ' * '.$expense->description.' = '.$expense->amount.'<<<>>> Participacion = '.mil($expense->amount / $value->aliquot).'<br>';
    		}
    		$found = $this->getTotals();
    		echo ' * Fondos de reserva = '.$found['reserveFund'].'<<<>>> Participacion = '.mil($found['reserveFund'] / $value->aliquot).'<br>';
    		echo ' * Honorarios profecionales = '.$found['fee'].'<<<>>> Participacion = '.mil($found['fee'] / $value->aliquot).'<br>';
    		echo ' * IVA = '.$found['iva'].'<<<>>> Participacion = '.mil($found['iva'] / $value->aliquot).'<br>';
    	}
    }

    public function expenses()
    {
    	$expenses = Expenses::MonthCondominium(date('m'), session('idCondominium'));
    	foreach ($estate as $key => $value) {
    		echo $value->owner.'<br>';
    		foreach ($expenses as $key => $expense) {
    			echo ' * '.$expense->description.' = '.$expense->amount.'<<<>>> Participacion = '.mil($expense->amount / $value->aliquot).'<br>';
    		}
    		$found = $this->getTotals();
    		echo ' * Fondos de reserva = '.$found['reserveFund'].'<<<>>> Participacion = '.mil($found['reserveFund'] / $value->aliquot).'<br>';
    		echo ' * Honorarios profecionales = '.$found['fee'].'<<<>>> Participacion = '.mil($found['fee'] / $value->aliquot).'<br>';
    		echo ' * IVA = '.$found['iva'].'<<<>>> Participacion = '.mil($found['iva'] / $value->aliquot).'<br>';
    	}
    }

    public function relacionCuotas($value='')
    {
    	$estate = Estate::GetEstateCondominiumActive(session('idCondominium'));
    	$dues = Dues::AccountsReceivable(session('idCondominium'));
    }

    public function getTotals($value='')
    {
        $month = date('m');
        $common    = Expenses::Share(1, session('idCondominium'), $month);
        $extra     = Expenses::Share(1, session('idCondominium'), $month);
        $notCommon = Expenses::Share(0, session('idCondominium'), $month);

        $totalCommon    = Expenses::Share(2, session('idCondominium'), $month)->sum('amount');
        $totalExtra     = Expenses::Share(1, session('idCondominium'), $month)->sum('amount');
        $totalNotCommon = Expenses::Share(0, session('idCondominium'), $month)->sum('amount');
        $reserveFund    = $totalCommon * 10 / 100;
        $grandTotal     = $totalCommon + $totalExtra + $totalNotCommon + $reserveFund;
        $fee            = $grandTotal * 10 / 100;
        $iva            = $fee * 12 / 100;

        $totals = [
            'totalCommon' => $totalCommon,
            'totalExtra' => $totalExtra,
            'totalNotCommon' => $totalNotCommon,
            'reserveFund' => $reserveFund,
            'grandTotal' => $grandTotal,
            'fee' => $fee,
            'iva' => $iva
        ];

        return $totals;
    }
}

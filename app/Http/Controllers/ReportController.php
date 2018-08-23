<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dues;
use App\Bills;
use App\Estate;
use App\Expenses;

class ReportController extends Controller
{
    public function index()
    {
    	return view('report.index');
    }

    public function avisoCobro($month)
    {
    	$estate = Estate::GetEstateCondominiumActive(session('idCondominium'));
    	$dues   = Expenses::MonthCondominium($month, session('idCondominium'));
    	$fondos = $this->getTotals();
    	$logo   = session('logoCondominium');
    	$pdf = \PDF::loadView('report.avisoCobro',compact('estate','dues','logo','fondos','month'));
    	return $pdf->stream('AvisoCobro-'.session('nameCondominium').'-'.month($month).'.pdf'); 
    }

    public function informeGatos($month)
    {	
    	$expenses = Expenses::MonthCondominium($month, session('idCondominium'));
    	$bill     = Bills::all();
    	$pdf = \PDF::loadView('report.informeGatos',compact('expenses','bill','month'));
    	return $pdf->stream('Gastos-'.session('nameCondominium').'-'.month($month).'.pdf');
    }

    public function cuotasPendientes($year)
    {	
    	$estate    = Estate::GetEstateCondominium(session('idCondominium'));
    	$dues      = Dues::Year($year);
        $sum       = Dues::SumTotal();
        $yearLasts = Dues::SumYearLast($year);
    	$pdf = \PDF::loadView('report.cuotasPendientes',compact('sum','estate','dues','yearLasts','year'));
    	return $pdf->setPaper('legal', 'landscape')->stream('Cuotas-pendientes-'.session('nameCondominium').'-'.month($year).'.pdf');
    }

    public function facturas($month)
    {   
        $estate    = Estate::GetEstateCondominium(session('idCondominium'));
        $dues      = Dues::Year($year);
        $pdf = \PDF::loadView('report.invoice',compact('estate','dues','yearLasts','year'));
        return $pdf->stream('Cuotas-pendientes-'.session('nameCondominium').'-'.month($year).'.pdf');
    }

    public function getTotals($value='')
    {
        $month     = date('m');
        $common    = Expenses::Share(0, session('idCondominium'), $month);
        $extra     = Expenses::Share(2, session('idCondominium'), $month);
        $notCommon = Expenses::Share(1, session('idCondominium'), $month);

        $totalCommon    = Expenses::Share(0, session('idCondominium'), $month)->sum('amount');
        $totalExtra     = Expenses::Share(2, session('idCondominium'), $month)->sum('amount');
        $totalNotCommon = Expenses::Share(1, session('idCondominium'), $month)->sum('amount');
        $reserveFund    = $totalCommon * 10 / 100;
        $grandTotal     = $totalCommon + $totalExtra + $totalNotCommon + $reserveFund;
        $fee            = $grandTotal * 10 / 100;
        $iva            = $fee * 12 / 100;
        $totalMes       = $totalCommon + $totalExtra + $totalNotCommon + $reserveFund + $fee + $iva;

        $totals = [
            'totalCommon' => $totalCommon,
            'totalExtra' => $totalExtra,
            'totalNotCommon' => $totalNotCommon,
            'reserveFund' => $reserveFund,
            'grandTotal' => $grandTotal,
            'fee' => $fee,
            'iva' => $iva,
            'totalMes' => $totalMes
        ];

        return $totals;
    }
}

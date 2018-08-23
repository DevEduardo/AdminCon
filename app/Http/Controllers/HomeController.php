<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Condominiums;
use App\Employees;
use App\Payments;
use App\Agencies;
use App\Estate;
use App\Salons;
use App\Access;
use App\Dues;
use App\User;

class HomeController extends Controller
{

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        if ($request->condominium > 0) {//guardar en base de datos y luego eliminar???
            $condominium = Condominiums::findOrFail($request->condominium);
            $payments = Payments::Approved($condominium['id']);
            $accountsReceivable = Dues::AccountsReceivable($condominium['id']);
            session([
                'idCondominium'          => $condominium['id'],
                'nameCondominium'        => $condominium['name'],
                'imgCondominium'         => $condominium['photo'],
                'emailCondominium'       => $condominium['email'],
                'messageCondominium'     => $condominium['message'],
                'logoCondominium'        => $condominium['logo'],
                'rifCondominium'         => $condominium['document'],
                'calculationCondominium' => $condominium['calculation'],
                'amountCondominium'      => $condominium['amount']
            ]);
            return view('agency.home', compact('payments','accountsReceivable'));
        }else{
            $userRol = Auth()->user()->rol;
            if ($userRol == 1) {
                $agencies = Agencies::all();
                return view('admin.home',compact('agencies'));
            }elseif ($userRol == 2 || $userRol == 3) {
                if ($userRol == 2) {
                    $home = true;
                    $condominiums = Condominiums::all();
                    return view('agency.welcomen', compact('home','condominiums'));
                }else{
                    
                }
            }elseif ($userRol == 4) {
                
            }
        }
    }
}

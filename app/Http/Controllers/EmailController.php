<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Dues;
use App\Estate;
use App\Agencies;
use Carbon\Carbon;
use App\Mail\EmailsCobro;
use App\Mail\EmailsAdmin;
use App\Mail\EmailsBienvenida;


class EmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getEmail()
    {	
    	$estate = Estate::GetEstateCondominium(session('idCondominium'));
    	return view('emails.index', compact('estate'));
    }
 
    public function email(Request $request)
    {
    	if ($request->type == 0) {
    		$estate = Estate::Emails($request->desde, $request->hasta);
            $users  = User::all();
            foreach ($estate as $key => $property) {
                $isetEmail = User::GetEmail($property->email);
                if ($isetEmail->count() >0) {
                    $userPass       = generatePassword();
                    $user = User::findOrFail($isetEmail->id)->update(['password',$userPass]);
                    Mail::to($property->email)->send(new EmailsBienvenida($property->email, $property->owner, $request->subject, $request->message, $userPass));
                    return redirect()->back();
                }else{
                    $userPass       = generatePassword();
                    $user           = new User();
                    $user->rol      = 4;
                    $user->name     = $property->owner;
                    $user->email    = $property->email;
                    $user->password = bcrypt($userPass);
                    $user->save();
                    Mail::to($property->email)->send(new EmailsBienvenida($property->email, $property->owner, $request->subject, $request->message, $userPass));
                    return redirect()->back();
                }
            }

    	}elseif($request->type == 1){
    		$estate = Estate::Emails($request->desde, $request->hasta);
            foreach ($estate as $key => $property) {
                $dues = Dues::Property($property->id);
                Mail::send(new EmailsCobro($property->email, $property->owner, $request->subject, $request->message, $dues));
            }
            return redirect()->back();  
    	}
    }

    public function emailAdmin(Request $request)
    {
        $v = $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
            'emailUser' => 'required'
        ]);

        if ($v)
        {
          return redirect()->back()->withInput()->withErrors($v->errors());
        }else{
            $resident = User::ResidentId($request->emailUser);
            $property = Estate::findOrFail($resident->id);
            $estateAgencyId   = Estate::EstateAgencyId($resident->id);
            $agency = Agencies::findOrFail($estateAgencyId[0]->agency);
            Mail::send(new EmailsAdmin($agency, $property, $request->subject, $request->message));
            return redirect()->back();
        }
    }

}

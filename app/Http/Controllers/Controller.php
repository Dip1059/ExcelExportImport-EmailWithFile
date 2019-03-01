<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use DB;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\EmailController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
    	$appoints = DB::select('select p.pid pid, u.full_name pname, date(a.appoint_date) apdate, u2.full_name dname from patients p, users u, appointments a, users u2, doctors d where a.patient_id=p.id and p.user_id=u.id and a.doctor_id=d.id and d.user_id=u2.id');
        //dd($appoints[0]);
    	return view('welcome')->with('appoints',$appoints);
    }

    public function importView()
    {
    	return view('import');
    }

    public function uploadView()
    {
        return view('upload');
    }

    public function exportAndSendEmail()
    {
        $done = app(ExcelController::class)->export();
        if($done) {
            $done = app(EmailController::class)->send();
            if($done) {
                return "done";
            }else {
                return false;
            }
        }else {
            return false;
        }
        //return "done";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;
use Mail;

class SendInactivityReportController extends Controller
{
    public function exportAndSendEmail($fromDate, $toDate)
    {

    	$reportDatas = DB::select('select idh.created_at,idh.user_id,u.email,idh.ctype,idh.deduction_amount from inactivity_deduction_histories idh, users u where date(idh.created_at)>='.$fromDate.' and date(idh.created_at)<='.$toDate.' and idh.user_id=u.id and idh.user_id not in (select user_id from excluded_users);');
    	
    	if(!$reportDatas) {
    		return false;
    	}
    		
    	$coinTotals = DB::select('select ctype, sum(deduction_amount) total from inactivity_deduction_histories where date(created_at)>='.$fromDate.' and date(created_at)<='.$toDate.' and user_id not in (select user_id from excluded_users) group by ctype;');
    	
    	Excel::create('Inactivity_Deduction_Report', function($excel) use($reportDatas){
	    $excel->sheet('Excel sheet', function($sheet) use($reportDatas){
		    	$sheet->loadView('inactivity', ['reportDatas' => $reportDatas]);
			});
		})->store('csv');

		if($fromDate == $toDate && $fromDate == 'date(now())') {
    		$toDay = getdate();
    		$subject = $toDay['year'].'-'.$toDay['mon'].'-'.$toDay['mday'];
    	}elseif($fromDate == $toDate && $fromDate != 'date(now())') {
    		$subject = $fromDate;
    	}elseif($fromDate != $toDate && $toDate == 'date(now())') {
    		$toDay = getdate();
    		$toDate = $toDay['year'].'-'.$toDay['mon'].'-'.$toDay['mday'];
    		$subject = 'from '.$fromDate.' to '.$toDate;
    	}else {
    		$subject = 'from '.$fromDate.' to '.$toDate;
    	}

		Mail::send('email.inactivitymail', ['coinTotals' => $coinTotals], function($message) use($subject){
			$message->to('dipankarsaha1059@gmail.com');
			$message->subject('Inactivity Deduction Report '.$subject);
			//$message->from('abc@gmail.com', 'Nobody');
			$message->attach(base_path().'/storage/exports/Inactivity_Deduction_Report.csv');
		});

		return true;
	}

}

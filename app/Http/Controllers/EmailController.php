<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filesystem;
use Mail;

class EmailController extends Controller
{
    public function send()
    {
    	$msg['msg'] = 'YEEEAAAAHHHH!';
    	Mail::send('email',$msg, function($message){
    		$message->to('dipankarsaha1059@gmail.com');
    		$message->subject('File Sending Test');
    		$message->from('abc@email.com', 'HEY');
    		$message->attach(base_path().'\\storage\\app\\users.csv');
    	});
    	return "done";
    }
}

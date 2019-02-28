<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Export;
use Excel;
use App\User;

class ExcelController extends Controller
{
    public function import()
    {
    	
    }

    public function export()
    {
    	/*echo "<pre>";
    	print_r(User::all());
    	exit();*/
    	Excel::store(new Export, 'users.xlsx');
    	return "done";
    }
}

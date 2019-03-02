<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Export;
use Excel;

class ExcelController extends Controller
{
    public function import()
    {
    	
    }

    public function export($apid, $apid2)
    {
    	Excel::store(new Export($apid, $apid2), 'users.csv');
    	return "done";
    }
}

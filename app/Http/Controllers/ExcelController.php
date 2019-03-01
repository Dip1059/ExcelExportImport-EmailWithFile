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

    public function export()
    {
    	Excel::store(new Export, 'users.xlsx');
    	return "done";
    }
}

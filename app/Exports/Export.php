<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;

class Export implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $appoints = DB::select('select p.pid pid, u.full_name pname, date(a.appoint_date) apdate, u2.full_name dname from patients p, users u, appointments a, users u2, doctors d where a.patient_id=p.id and p.user_id=u.id and a.doctor_id=d.id and d.user_id=u2.id');
        return view('excel')->with('appoints', $appoints); 
    }

}

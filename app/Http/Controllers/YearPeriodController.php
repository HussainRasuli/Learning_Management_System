<?php

namespace App\Http\Controllers;
use App\Model\PeriodYear;
use Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class YearPeriodController extends Controller
{
    protected function index(){
        abort_if(Gate::denies('view-year-periods'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['PeriodYear'] = PeriodYear::where('deleted',0)->orderBy('log_id','desc')->paginate(6);

        return view('main/admin/YearPeriod/yearPeriod_list', $data);
    }

    protected function yearPeriod_form(){
        abort_if(Gate::denies('view-year-periods'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('main/admin/YearPeriod/yearPeriod_form');
    }

    protected function add_yearPeriod(Request $request){
        $validations = $request->validate([
            'year'     => 'required',
            'period'      => 'required',
            'start-date'   => 'required'
        ]);
        
        $update_status = PeriodYear::select('status')->update(['status' => 0 ]);

        $insert = new PeriodYear;
        $insert->period                 = $request->period;
        $insert->year                   = $request->year;
        $insert->semester_start_date    = $request->input("start-date");
        $insert->status                 = 1;
        $insert->deleted                = 0;
        $insert->save();

        Session::flash('yearPeroid_added', 'Successfuly added');
        return redirect()->action('YearPeriodController@index');
    }

    protected function edit_YearPeriod(Request $request){
        $log_id = $request->input('id');
        $data['data']  = PeriodYear::find($log_id);
        return view('main/admin/YearPeriod/yearPeriod_modal', $data);
    }

     protected function delete_YearPeriod(Request $request){
         $log_id = $request->input('id');
         $data =  PeriodYear::find($log_id);
         $data->deleted = 1;
         $data->save();

         if($data == true){
             return 'Deleted';
         }
         else{
             return 'Not Deleted';
         }
     }

     protected function update_YearPeriod(Request $request){
        $log_id = $request->input('log_id');
        $update = PeriodYear::find($log_id);
        $update->period = $request->period;
        $update->year   = $request->year;
        $update->semester_start_date = $request->input("start-date");
        $update->semester_end_date = $request->input("end-date");
        $update->save();

        if($update == true){
            return 'Updated';
        }
        else{
            return 'Not Updated';
        }
    }
}

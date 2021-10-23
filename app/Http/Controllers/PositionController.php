<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Position;
use App\Model\PositionType;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PositionController extends Controller
{
    public function index(){
        abort_if(Gate::denies('view-positions'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $all_position = Position::all();
        return view('main/admin/position/position_list', compact('all_position'));
    }

    public function position_form(){
        abort_if(Gate::denies('view-positions'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['position_type'] = PositionType::all();
        return view('main/admin/position/add_position', $data);
    }

    public function store(Request $request){
        $validations = $request->validate([
            'position'      => 'required|string',
            'position_type' => 'required'
        ]);
        
        $insert_position = new Position();
        $position_name = $request->input('position');
        $position_type = $request->input('position_type');
        $description = $request->input('description');

        foreach($position_name as $key => $value)
        {
            $store = new Position;
            $store->position_name = $position_name[$key];
            $store->position_type_id = $position_type[$key];
            $store->description   = $description[$key];
            $store->save();
        }

        Session::flash('position_added', 'Successfuly added');
        return redirect()->action('PositionController@index');
        
    }

    public function edit_position ($position_id){

        $data = Position::find($position_id);
        $allPositionType = PositionType::all();
        return view('main/admin/position/edit_position_modal', compact('data','allPositionType'));
    }

     public function update_position(Request $request){

        $position_id = $request->input('position_id');
        
        $update      = Position::find($position_id);
        $update->position_name = $request->input('position_name');
        $update->position_type_id = $request->input('position_type');
        $update->description   = $request->input('description');
        $update->save();
        
        Session::flash('edit_position','Successfully Edited Position.');
        return redirect()->back();
     }

     public function delete_position(Request $request){

         $position_id = $request->input('id');
         $delete      = Position::find($position_id);
         $delete->delete();

         if($delete == true){
             return 'Deleted';
         }
         else{
             return 'Not Deleted';
         }
     }

}

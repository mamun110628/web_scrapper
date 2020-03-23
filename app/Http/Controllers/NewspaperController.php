<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use \DataTables;
class NewspaperController extends Controller
{
    public function index(){
        $meta = array(
            'title'=>'MOFA || Newspaper List',
            'active_page'=>'newspaper_list'
        );
        return view('setting.list',  compact('meta'));
    }
    
    public function AjaxList(){
        $newspaperlist = \App\Model\Newspaper::all();
        return Datatables::of($newspaperlist)
                        ->addColumn('action', function($value) {
                            $action = '<a href="' . route('newspaper.edit', $value->id) . '" class="btn btn-warning"><i class="fa fa-pencil" title="Edit"></i></a>';

                            return $action;
                        })
                        ->addColumn('status', function($value) {
                            if ($value->status == 1) {
                                

                                $status = '<div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Active
                                         <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" class="approval" data-id = "' . $value->id . '" data-bind="0">Inactive</a></li>
                                        </ul>
                                    </div>';
                            } else {
                                $status = '<div class="dropdown">
                                        <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">Inactive
                                         <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" class="approval" data-id = "' . $value->id . '" data-bind="1">Active</a></li>
                                        </ul>
                                    </div>';
                            }
                            return $status;
                        })
                        
                        ->rawColumns(['status', 'action'])
                        ->make(true);
    }


    public function create(){
        $meta = array(
            'title'=>'MOFA || Create Newspaper',
            'active_page'=>'create_newspaper'
        );
         return view('setting.create',  compact('meta'));  
    }
    
    public function store(Request $request){
        $session_data = Session::get('login_detail');
        $newspaper = new \App\Model\Newspaper();
        $newspaper->name = $request->name;
        $newspaper->url = $request->url;
        $newspaper->dom_element = $request->dom_element;
       
        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
            $filename = time() . $uploadedFile->getClientOriginalName();

            Storage::disk('upload')->putFileAs(
                    date('Y-m-d'), $uploadedFile, $filename
            );
            $filename =  date('Y-m-d').'/'.$filename;
            $logo = $filename;
        }
         $newspaper->logo = $logo;
         $newspaper->status = $request->status;
         $newspaper->created_by = $session_data['login_id'];
         if($newspaper->save()){
              return redirect()->back()
            ->with('success', 'Saved Successfull');
         }
    }
    
    

    

    public function edit($id){
        $newspaper = \App\Model\Newspaper::find($id);
        return view('setting.edit',compact('newspaper'));  
    }
    
    public function update(Request $request, $id){
         $session_data = Session::get('login_detail');
        $newspaper = \App\Model\Newspaper::find($id);
        if($newspaper){
            $newspaper->name= $request->name;
            $newspaper->url= $request->url;
            $newspaper->dom_element= $request->dom_element;
            $newspaper->status = $request->status;
            $newspaper->updated_by = $session_data['login_id'];
            if($newspaper->save()){
              return redirect(route('newspaper.index'))
            ->with('success', 'Saved Successfull');
         }
        }
    }
    
    public function NewspaperStatus(Request $request){
        $session_data = Session::get('login_detail');
        $newspaper = \App\Model\Newspaper::find($request->request_id);
        $newspaper->status = $request->request_response;
        if($newspaper->save()){
            $return_array = array(
                'status'=>200
            );
            return json_encode($return_array);
         }
    }
}

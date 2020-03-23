<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(){
        $session_data = Session::get('login_detail');
        $notify = Session::get('notify');
        $metadata = array(
            'site_title'=>'Invogue Scrapper',
            'user_info' => $session_data,
            'notify'=>$notify
        );
        Session::forget('notify');
//         Session::forget('message');
//        $users = User::all();
        $users = DB::table('users')
                ->select('*') 
                ->join('admin_groups','users.group_id','=','admin_groups.id')
                ->get();
        
        $content = view('admin.admin_user_list')
                ->with('users',$users)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }
    public function ajaxuserlist() {
        $users = DB::table('users as u')
                ->select('u.*','ag.name')
                ->join('admin_groups as ag', 'u.group_id', '=', 'ag.id')
                ->get();
        
        foreach ($users as &$user) {
            $user->user_name = $user->first_name . ' ' . $user->last_name;
            if ($user->status == 1) {
                $user->status = '<div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Active
                                         <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" class="approval" data-id = "' . $user->id . '" data-bind="0">Inactive</a></li>
                                        </ul>
                                    </div>';
            } else {
                $user->status = '<div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Inactive
                                         <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);" class="approval" data-id = "' . $user->id . '" data-bind="1">Active</a></li>
                                        </ul>
                                    </div>';
            }
            $user->action = '<a class="btn btn-primary" href="'.route('admin_user.edit',$user->id).'"><i class="fa fa-edit"></i></a>&nbsp<a class="btn btn-danger del" href="javascript:void(0)"><i class="fa fa-trash-o"></i></a>';
        }
        return Datatables::of($users)
                ->rawColumns(['status','action'])
                        ->make(true);
    }
    public function AdminStatus(Request $request){
        $admin_id = $request->admin_id;
        $response = $request->request_response;
        $admin = User::find($admin_id);
        $admin->status = $response;
        if($admin->save()){
            $return_data = array(
                'status'=>200,
                'message'=>'Successful'
            );
            return json_encode($return_data);
        }
    }
    public function admin_delete(Request $request){
        $admin =  User::find($request->id)->delete();
        if($admin){
             $return_data = array(
                'status'=>200,
                'message'=>'Successfully Delete'
            );
            return json_encode($return_data);
        }
    }

    public function login()
    {
        $session_msg = Session::get('login_message');
        return view('login')
                ->with('login_message',$session_msg);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $session_data = Session::get('login_detail');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data
        ); 
        $groups = \App\Model\AdminGroup::all();
        $content = view('admin.create_user')
                ->with('groups',$groups)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }
    //store user
    public function store(Request $request)
    {
        $session_data = Session::get('login_detail');
        $user = new \App\User;
        if ($request->hasFile('profile_image')) {
            $uploadedFile = $request->file('profile_image');
            $filename = time() . $uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                    date('Y-m'), $uploadedFile, $filename
            );
            $filename =  date('Y-m').'/'.$filename;
            $user->profile_image = $filename;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = \Illuminate\Support\Facades\Hash::make(md5($request->email).md5($request->password));
        
        $user->group_id = $request->group_id;
        $user->status = $request->status;
        $user->created_by = $session_data['login_id'];
        $user->save();
        $success_message = array(
                'status'=>'success',
                'title'=>'Success',
                'message'=>'Sucessfully Added'
            );
            Session::put('notify',$success_message);
       return Redirect::to('user');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login_process(Request $request)
    {
        $login_fail_message = array(
                'status'=>'text-danger',
                'message'=>"Invalid Login try again"
            );
        $login_success_message = array(
            'status'=>'success',
            'title'=>'Success',
                'message'=>"Welcome! Successfully login"
        );
        $email = $request->email;
        $password = $request->password;
        $enc_pass = md5($email).md5($password);
       
        $data = User::where('email',$email)
                        ->where('status',1)
                        ->first();
         
        if (isset($data) or ! empty($data)) {
            if (\Illuminate\Support\Facades\Hash::check($enc_pass, $data->password)) {
                
                $login = array(
                    'login_id'=>$data->id,
                    'login_email'=>$data->email, 
                    'login_name'=>$data->first_name.' '.$data->last_name,
                    'login_group'=>$data->group_id,
                    'profile_pic'=>$data->profile_image
                    
                );
                if ($request->remember_me) {
//                    Cookie::make('login_detail',$login, 10080);
                    Cookie::queue(Cookie::make('login_detail', Session::getId(), 10080));
                    $user = User::find($data->id);
                    $user->remember_token = Session::getId();
                    $user->save();
                }else{
                    Cookie::queue(Cookie::make('login_detail', null, 10080));
                    $user = User::find($data->id);
                    $user->remember_token =null;
                    $user->save();
                }

                Session::put('login_detail', $login);
                Session::put('login_message', $login_success_message);
                 return Redirect::to('/');
            }else{
                Session::put('login_message', $login_fail_message);
                return Redirect::to('login');
            }
        } else {

            Session::put('login_message', $login_fail_message);
            return Redirect::to('login');
        }
    }
    public function AdminGroup(){
         $session_data = Session::get('login_detail');
        $notify = Session::get('notify');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data,
            'notify'=>$notify
        );
        Session::forget('notify');
        $groups = \App\Model\AdminGroup::all();
        $admin_menu = new \App\Model\AdminMenu;
        foreach ($groups as &$group){
            $group_access = explode(',', $group->group_access);
            $menus = array();
            foreach ($group_access as $value){
                $menu_obj = $admin_menu->where('id','=',$value)
                        ->first();
                $menus[] = $menu_obj->name;
                    
            }
            $group->group_access = implode(', ', $menus);
        }
        
        $content = view('admin.group_list')
                ->with('groups',$groups)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }
    public function createGroup(){
        $session_data = Session::get('login_detail');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data
            
        ); 
        $menus = \App\Model\AdminMenu::all();
        $content = view('admin.create_group')
                ->with('menus',$menus)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }
    public function storeGroup(Request $request){
        $group = new \App\Model\AdminGroup;
        $group->name = $request->group_name;
        $group->group_access = implode(',', $request->group_access);
        $group->save();
         $success_message = array(
                'status'=>'success',
                'title'=>'Success',
                'message'=>'Sucessfully Added'
            );
            Session::put('notify',$success_message);
       return Redirect::to('user/group');
    }
    
    public function edit_group($id){
        $session_data = Session::get('login_detail');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data
            
        ); 
        $group = \App\Model\AdminGroup::find($id);
        $menus = \App\Model\AdminMenu::where('parent_id',null)->get();
        $content = view('admin.admin_group_edit')
                ->with('menus',$menus)
                ->with('group',$group)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }
    public function updadeGroup(Request $request, $id){
        $group =  \App\Model\AdminGroup::find($id);
        $group->name = $request->group_name;
        $group->group_access = implode(',', $request->group_access);
        $group->save();
         $success_message = array(
                'status'=>'success',
                'title'=>'Success',
                'message'=>'Sucessfully Updated'
            );
            Session::put('notify',$success_message);
       return Redirect::to('user/group');
    }
    
    public function editProfile($id){
        $session_data = Session::get('login_detail');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data
            
        ); 
       $user_profile = User::find($id);
        $content = view('admin.admin_edit_profile')
                ->with('user_profile',$user_profile)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }
    
    public function updateProfile(Request $request, $id){
        $session_data = Session::get('login_detail');
        $user = User::find($id);
        if ($request->hasFile('profile_image')) {
            $uploadedFile = $request->file('profile_image');
            $filename = time() . $uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                    date('Y-m'), $uploadedFile, $filename
            );
            $filename =  date('Y-m').'/'.$filename;
            $user->profile_image = $filename;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password){
            $user->password = \Illuminate\Support\Facades\Hash::make(md5($request->email).md5($request->password));
        }
        
        if($request->group_id){
            $user->group_id = $request->group_id;
        }
         $user->updated_by = $session_data['login_id'];
        $user->save();
        $success_message = array(
                'status'=>'success',
                'title'=>'Success',
                'message'=>'Sucessfully Updated'
            );
            Session::put('notify',$success_message);
       return Redirect::to('admin');
    }

        public function logout(){
        Session::flush();
        return Redirect::to('login');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session_data = Session::get('login_detail');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data
        ); 
        $user = User::find($id);
        $groups = \App\Model\AdminGroup::all();
        $content = view('admin.admin_user_edit')
                ->with('groups',$groups)
                ->with('user',$user)
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $session_data = Session::get('login_detail');
        $user = User::find($id);
        if ($request->hasFile('profile_image')) {
            $uploadedFile = $request->file('profile_image');
            $filename = time() . $uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                    date('Y-m'), $uploadedFile, $filename
            );
            $filename =  date('Y-m').'/'.$filename;
            $user->profile_image = $filename;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($user->password){
            $user->password = \Illuminate\Support\Facades\Hash::make(md5($request->email).md5($request->password));
        }
        
        if($request->group_id){
            $user->group_id = $request->group_id;
        }
         $user->updated_by = $session_data['login_id'];
        $user->save();
        $success_message = array(
                'status'=>'success',
                'title'=>'Success',
                'message'=>'Sucessfully Updated'
            );
            Session::put('notify',$success_message);
       return Redirect::to('user');
    }
	
	
	
    public function Designation(){
         $session_data = Session::get('login_detail');
        $notification_data = Session::get('login_message');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data,
            'notify'=>$notification_data
            
            
        );  
        
        $content = view('admin.designation')
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
     }
	
    public function OfficeDepartment(){
         $session_data = Session::get('login_detail');
        $notification_data = Session::get('login_message');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data,
            'notify'=>$notification_data
            
            
        );  
        
        $content = view('admin.office_department')
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
     }
	 
    public function OfficeBranch(){
         $session_data = Session::get('login_detail');
        $notification_data = Session::get('login_message');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data,
            'notify'=>$notification_data
            
            
        );  
        
        $content = view('admin.office_branch')
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
     }
	
    public function OfficeLocation(){
         $session_data = Session::get('login_detail');
        $notification_data = Session::get('login_message');
        $metadata = array(
            'site_title'=>'Invogue VMS',
            'user_info' => $session_data,
            'notify'=>$notification_data
            
            
        );  
        
        $content = view('admin.office_location')
                ->with('meta',$metadata);
        return view('master')
                ->with('meta',$metadata)
                ->with('content',$content);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
	public function index(){
		$all_users = UserModel::all();
		return view('index',[
			'all_users'=>$all_users
		]);
	}

    public function add_user_form_submit(Request $req){

    	$uniqueId = time()."_".mt_rand();
    	$filename = $uniqueId.".".$req->profile_img->getClientOriginalExtension();
    	$req->profile_img->move("my_images",$filename);

    	$add_user = new UserModel();
    	$add_user->name = $req->name;
    	$add_user->email = $req->email;
    	$add_user->password = $req->password;
    	$add_user->profile_img = $filename;
    	$result = $add_user->save();

    	return $result;

    }

    public function delete_user($id){
    	//get all users
    	$all_users = UserModel::all();

    	//delete user
    	$delete_user = UserModel::where('id',$id)->delete();
    	if($delete_user == 1)
    	{
    		echo "<script>window.open('../','_self')</script>";
    	}
    }

    public function edit_user($id){
    	$all_users = UserModel::find($id);
    	return view('../edit_user',[
    		'all_users'=>$all_users
    	]);
    }

    public function update_user_form_submit(Request $req){

    	$uniqueId = time()."_".mt_rand();
    	$filename = $uniqueId.".".$req->profile_img->getClientOriginalExtension();
    	$req->profile_img->move("my_images",$filename);

    	return UserModel::where('id',$req->id)->update(
    		array(
    			'name'=>$req->name,
    			'email'=>$req->email,
    			'password'=>$req->password,
    			'profile_img'=>$filename,
    		));
    }
}

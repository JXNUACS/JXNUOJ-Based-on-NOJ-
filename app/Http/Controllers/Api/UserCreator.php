<?php

namespace App\Http\Controllers\Api;

use App\Models\Eloquent\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class UserCreator extends Controller
{
	public function index(Request $request){
		return 'success!';
	}
	
	public function create_jxnu(Request $request){
		$encrypt = $request -> password;
		$key = env('API_KEY');
		$decrypt = openssl_decrypt($encrypt, 'AES-128-ECB', $key, 0);
		$credentials = [
			'email' => $request -> vefemail,
			'password' => $decrypt
		];
		//return $credentials;
		if(!auth()->attempt($credentials)){
			//return $decrypt;
			return response() -> json(['code' => 401, 'message' => 'Verified Error! Please check the key!']);
		}
		else{
            if(User::where('email', '=', $request->email)->exists()){
                Log::warning("[Request Again] $request->username has been resisted!");
                return response() -> json(['code' => 200, 'message' => 'Already Exists!']);
            }
	        $user_info=[
	        	'name' => '22级-'.$request->userclass.'-'.$request->username,
			    'email' => $request->email,
			    'password' => Hash::make('JxnuCie2022'.$request->serial),
			    'avatar' => "/static/img/avatar/default.png",
			    'contest_account' => null,
			    'professional_rate' => 1500
			];
			try{
				User::create($user_info);
			} catch (Exception $err) {
				return response()->json(['code' => 500,'msg' => '发生异常！创建失败. 错误信息：'.err]);
			}
            Log::info("[Register Success] $request->username has been resisted!");
			return response() -> json(['code' => 200, 'message' => 'Created Successfully!']);
		}
	}

	public function CreateCustom(Request $request){
		$encrypt = $request -> password;
		$key = env('API_KEY');
		$decrypt = openssl_decrypt($encrypt, 'AES-128-ECB', $key, 0);
		$credentials = [
			 'email' => $request -> vefemail,
			 'password' => $decrypt
		];
		if(!auth()->attempt($credentials)){
			return response() -> json(['code' => 401, 'message' => 'Verified Error! Please check the key!']);
		}
		else{
			$user_info=[
				'name' => $request->username,
				'email' => $request->email,
				'password' => Hash::make($request->password),
				'avatar' => "/static/img/avatar/default.png",
				'contest_account' => null,
				'professional_rate' => 1500

			];
			try{
				User::create($user_info);
			} catch(Exception $err) {
				return response()->json(['code' => 500, 'msg' => '发生异常！创建失败！'.err]);
			}
            Log::channel('app')->info("User \"$name\" has been created by external API! Email: `$email`");
			return response() -> json(['code' => 200, 'message' => 'Created Successfully!']);
		}
	}
}

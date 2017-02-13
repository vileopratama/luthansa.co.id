<?php
namespace App\Modules\Session\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Modules\Customer\Customer;
use Auth;
use Cookie;
use Input;
use Lang;
use Mail;
use Redirect;
use Response;
use Session;
use Theme;
use Validator;

class SessionController extends Controller {
	public function login() {
		return Theme::view('session::login',array(
			
		));
	}
	
	public function do_login(Input $request) {
		$field = array (
			'email'=> $request->get('email'),
			'password' => $request->get('password')
        );
		
		$rules = array (
			'email' => 'required|email',
			'password' => 'required',
        );
		
		$messages = array(
			'email.required' => Lang::get('email is required'),
			'email.email' => Lang::get('email is not valid'),
			'password.required' => Lang::get('password is not valid'),
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
				'is_login' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			//process logged
			if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')],false)) {
				$params ['success'] =  true;
				$params ['is_login'] = true;
				$params ['redirect'] = Session::has('url.previous') ? url(Session::get('url.previous')) : url('/customer');
				$params ['message'] =  Lang::get('message.login successfully');	
				
				//destroy sesion previous
				Session::forget('url.previous');
			} else {
				$params ['success'] =  true;
				$params ['is_login'] = false;
				$params ['redirect'] = url('/session/login');
				$params ['message'] =  Lang::get('message.login failed');	
			}	
		}
		
		return Response::json($params);		
	}
	
	public function forgot_password() {
		return Theme::view('session::forgot-password',array(
			// do process
		));
	}
	
	public function do_forgot_password(Input $request) {
		$field = array (
			'email'=> $request->get('email'),
        );
		
		$rules = array (
			'email' => 'required|email',
        );
		
		$messages = array(
			'email.required' => Lang::get('email is required'),
			'email.email' => Lang::get('email is not valid'),
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$customer = Customer::where(['email' => $request->get('email')])->first();
			if(!$customer) {
				$params = array(
					'success' => false,
					'message' => array(
						'email' => Lang::get('message.email is not registered'),
					)
				);
			} else {
				$customer->request_forgot_password = 1;	
				$customer->remember_token = substr( md5(rand()), 0, 30);
				$customer->updated_at = date('Y-m-d H:i:s');
				$customer->updated_by = 1;
				$customer->save();
				
				$params = array(
					'success' => true,
					'message' => Lang::get('message.activation link has been sent your email')
				);
			}
		} 
		//response json
		return Response::json($params);			
	}
	
	public function do_register(Input $request) {
		$field = array (
			'email'=> $request->get('email'),
            'name' => $request->get('name'),
			'password' => $request->get('password'),
			'confirm_password' => $request->get('confirm_password'),
        );
		
		$rules = array (
			'email' => 'required|email|unique:customers,email',
            'name' => 'required',
			'password' => 'required',
			'confirm_password' => 'required|same:password',
        );
		
		$messages = array(
			'email.required' => Lang::get('message.email is required'),
			'email.email' => Lang::get('message.email is not valid'),
			'email.unique' => Lang::get('message.email is already registered'),
			'name.required' => Lang::get('message.name is required'),
			'password.required' => Lang::get('message.password is required'),
			'confirm_password.required' => Lang::get('message.confirm password is required'),
			'confirm_password.same' => Lang::get('message.confirm password must be same'),
		);
		
		$validate = Validator::make($field,$rules,$messages);
		
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			//process to registration
			$customer = new Customer();
			$customer->email = 	$request->get('email');
			$customer->name = $request->get('name');
			$customer->password = bcrypt($request->get('password'));
			$customer->is_active = 0; //non active 
			$customer->created_at = date('Y-m-d H:i:s');
			$customer->created_by = 1;
			$customer->save();
			
			//send email 
			//send email
			
			//automatic logged
			if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')],false)) {
				$params ['success'] =  true;
				$params ['redirect'] = url('/customer');
				$params ['message'] =  Lang::get('message.login successfully');
			} else {
				$params ['success'] =  false;
				$params ['redirect'] = url('/');
				$params ['message'] =  Lang::get('message.login failed');
			}	
		}
		
		return Response::json($params);		
	}
	
	public function reset_password($remember_token) {
		$customer = Customer::where(['remember_token' => $remember_token,'request_forgot_password' => 1])->first();
		if(!$customer) {
			Redirect::intended('/',301);
		} 
		
		return Theme::view('session::reset-password',array(
			'customer' => $customer,
		));
	}
	
	public function do_reset_password() {
		$email = Input::get('email');
		
		$field = array (
			'email'=> Input::get('email'),
			'new_password' => Input::get('new_password'),
			'confirm_new_password' => Input::get('confirm_new_password'),
        );
		
		$rules = array (
			'email' => 'required',
			'new_password' => 'required',
			'confirm_new_password' => 'required|same:new_password',
        );
		
		$messages = array(
			'email.required' => Lang::get('message.email is required'),
			'new_password.required' => Lang::get('message.password is required'),
			'confirm_new_password.required' => Lang::get('message.confirm password is required'),
			'confirm_new_password.same' => Lang::get('message.confirm password must be same as password'),
		);
			
		$validate = Validator::make($field,$rules,$messages);
	
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$customer = Customer::where(['email'=> $email])->first();
			
			if($customer) {
				$customer->request_forgot_password = 1;
				$customer->password_decrypt = Input::get('new_password');
				$customer->password = bcrypt(Input::get('new_password'));
				$customer->remember_token = "";
				$customer->updated_at = date('Y-m-d H:i:s');
				$customer->updated_by = 1;
				$customer->save();
				//sent email
				$params ['success'] =  true;
				$params ['redirect'] = url('/session/login');
				$params ['message'] =  Lang::get('message.reset password has successfully');	
			} else {
				$params ['success'] =  false;
				$params ['redirect'] = url('/session/forgot-password');
				$params ['message'] =  Lang::get('message.reset password has failed');	
			}
		}
		//return response
		return Response::json($params);	
	}
	
	public function do_logout() {
		Auth::logout();
		return Redirect::intended('session/login',301);
	}
}

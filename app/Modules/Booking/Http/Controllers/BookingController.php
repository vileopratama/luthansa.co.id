<?php
namespace App\Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Modules\ArmadaCategory\ArmadaCategory;
use App\Modules\Customer\Customer;
use App\Modules\SalesOrder\SalesOrder;
use App\Modules\SalesOrder\SalesOrderDetail;
use Auth;
use Crypt;
use Input;
use Lang;
use Redirect;
use Response;
use Session;
use Theme;
use Validator;

class BookingController extends Controller {
	//prosess book
	public function do_book(Input $request) {
		$field = array (
			'name' => $request->get('name'),
			'total_passenger' => $request->get('total_passenger'),
			'email' => $request->get('email'),
			'total_days' => $request->get('total_days'),
			'mobile_number' => $request->get('mobile_number'),
			'pick_up_point' => $request->get('pick_up_point'),
            'booking_from_date' => $request->get('booking_from_date'),
			'destination' => $request->get('destination'),
        );
		
		$rules = array (
			'name' => 'required',
			'total_passenger' => "required",
			'email' => 'required|email',
			'total_days' => "required",
			'mobile_number' => "required",
			'pick_up_point' => "required",
            'booking_from_date' => 'required',
			'destination' => 'required',
        );
		
		$messages = array(
			'name.required' => Lang::get('message.name is required'),
			'total_passenger.required' => Lang::get('message.total passenger is required'),
			'email.required' => Lang::get('message.email is required'),
			'email.email' => Lang::get('message.email is not valid'),
			'total_days.required' => Lang::get('message.total days is required'),
			'mobile_number.required' => Lang::get('message.handphone is required'),
			'pick_up_point.required' => Lang::get('message.pick_up_point is required'),
			'booking_from_date.required' => Lang::get('message.booking from date is required'),
			'destination.required' => Lang::get('message.destination is required'),
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			Session::put('name', $request->get('name'), 60);	
			Session::put('total_passenger', $request->get('total_passenger'), 60);
			Session::put('email', $request->get('email'), 60);
			Session::put('total_days', $request->get('total_days'), 60);
			Session::put('mobile_number', $request->get('mobile_number'), 60);
			Session::put('company name', $request->get('company_name'), 60);
			Session::put('booking_pick_up_point', $request->get('pick_up_point'), 60);
			Session::put('booking_from_date', $request->get('booking_from_date'), 60);			
			Session::put('booking_destination', $request->get('destination'), 60);
			
			$params ['success'] =  true;
			$params ['redirect'] = url('/booking/rent');
			$params ['message'] =  "";		
		}
		
		return Response::json($params);
	}
	
	public function rent(ArmadaCategory $armada_category) {
		return Theme::view('booking::rent',array(
			'armada_categories' => $armada_category->where(['is_active' =>1])->get(),
		));
	}
	
	public function do_rent(Input $request,ArmadaCategory $armada_category) {
		$field = array (
			'name' => $request->get('name'),
			'total_passenger' => $request->get('total_passenger'),
			'email' => $request->get('email'),
			'total_days' => $request->get('total_days'),
			'mobile_number' => $request->get('mobile_number'),
			'pick_up_point' => $request->get('pick_up_point'),
            'booking_from_date' => $request->get('booking_from_date'),
			'destination' => $request->get('destination'),
        );
		
		$rules = array (
			'name' => 'required',
			'total_passenger' => "required",
			'email' => 'required|email',
			'total_days' => "required",
			'mobile_number' => "required",
			'pick_up_point' => "required",
            'booking_from_date' => 'required',
			'destination' => 'required',
        );
		
		$messages = array(
			'name.required' => Lang::get('message.name is required'),
			'total_passenger.required' => Lang::get('message.total passenger is required'),
			'email.required' => Lang::get('message.email is required'),
			'email.email' => Lang::get('message.email is not valid'),
			'total_days.required' => Lang::get('message.total days is required'),
			'mobile_number.required' => Lang::get('message.handphone is required'),
			'pick_up_point.required' => Lang::get('message.pick_up_point is required'),
			'booking_from_date.required' => Lang::get('message.booking from date is required'),
			'destination.required' => Lang::get('message.destination is required'),
		);
		
		$validate = Validator::make($field,$rules,$messages);
		if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray(),
				'redirect' => url('/'),
				'is_customer_registered' => false,
            );
		} else {
			//check customer if exist
			$customer = Customer::where('email',$request->get('email'))->first();
			if($customer && !Auth::check()) {
				//do process 
				$params ['success'] =  true;
				$params ['is_customer_registered'] = true;
				$params ['message'] = Lang::get('message.you are already registered');
				$params ['email'] = $request->get('email');
				Session::put('url.previous','/booking/rent', 60);//session url for previous function
			} else {
				//do process
				$customer_id = null;
				if(!Auth::check()) {
					$password_decrypt = substr( md5(rand()),0,8);
					$customer = new Customer();
					$customer->name =  !empty($request->get('company_name')) ? $request->get('name') : $request->get('company_name');
                    $customer->contact_person = $request->get('name');
					$customer->email = $request->get('email');
					$customer->mobile_number = $request->get('mobile_number');
					$customer->password = bcrypt($password_decrypt); 
					$customer->password_decrypt = $password_decrypt;
					$customer->type = !empty($request->get('company_name')) ? 'Corporate' : 'Individual';
					$customer->is_active = 0;
					$customer->created_at = date('Y-m-d H:i:s');
					$customer->created_by = 0;
					$customer->save();
					//init id
					$customer_id = $customer->id;
					//Automatic Login
					Auth::attempt(['email' => $request->get('email'), 'password' => $password_decrypt],false);
				} else {
					$customer_id = Auth::user()->id;
				}

				//transaction master
				$sales_order = new SalesOrder();
				$sales_order->source = 1; //source from online booking
				$sales_order->status = 2;
				$sales_order->order_date = date('Y-m-d');
				$sales_order->customer_id = $customer_id;
				$sales_order->customer_phone_number = $request->get('mobile_number');
				$sales_order->customer_email = $request->get('email');
				$sales_order->customer_company_name = $request->get('company_name');
				$sales_order->total_passenger = $request->get('total_passenger');
				$sales_order->booking_total_days =  $request->get('total_days');
				$sales_order->booking_from_date = preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', $request->get('booking_from_date'));	
				$sales_order->booking_to_date = get_addition_date(preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', $request->get('booking_from_date')),$request->get('total_days'));	
				$sales_order->pick_up_point = $request->get('pick_up_point');
				$sales_order->destination = $request->get('destination');
				$sales_order->created_at = date('Y-m-d H:i:s');
				$sales_order->created_by = $customer_id;
				$sales_order->save();
				
				//transaction details
				$qty = $request->get('qty');
				$total_days = $request->get('total_days');
				$armada_categories = $armada_category::where('is_active',1)->get();
				if($armada_categories) {
					foreach($armada_categories as $key => $row) {
						if(isset($qty[$row->id]) && $qty[$row->id] > 0) {
							//find armada name 
							$armada_category = ArmadaCategory::find($row->id);
							$armada_category_name = "";
							$armada_capacity = 0;
							if($armada_category) {
								$armada_category_name = $armada_category->name;
								$armada_capacity = $armada_category->capacity;
							}
							
							$sales_order_details = new SalesOrderDetail();
							$sales_order_details->sales_order_id = $sales_order->id;
							$sales_order_details->armada_category_id = $row->id;
							$sales_order_details->armada_category_name = $armada_category_name; 
							$sales_order_details->armada_capacity = $armada_capacity; 
							$sales_order_details->qty = $qty[$row->id];
							$sales_order_details->days = $total_days;
							$sales_order_details->price = 0;
							$sales_order_details->save();
						}
					}
				}
				
				$params ['success'] =  true;
				$params ['is_customer_registered'] = false;
				$params ['redirect'] = url('/customer/view/'.Crypt::encrypt($sales_order->id));
				$params ['message'] =  Lang::get('message.order has been successfully');
			}	
		}
	
		return Response::json($params);
		
	}
}

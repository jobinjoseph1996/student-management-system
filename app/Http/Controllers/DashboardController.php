<?php

namespace App\Http\Controllers;

// use App\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	function index(){
		//  $user = Employee::all();
		 return view('dashboard');

	}
}

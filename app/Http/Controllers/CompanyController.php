<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;

class CompanyController extends Controller
{
    public function index() {
    	$companies = Doctor::with('states')->where('type','C')->get();
      	return view('admin.company.index')->with('companies',$companies);
    }

    public function add() {
    	$state_list = \App\State::where('status','1')->orderBy('name')->get()->pluck('name','id')->toArray();
    	return view('admin.company.add')->with('state_list',$state_list);
    }
}

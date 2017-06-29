<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
    	$companies = Doctor::with('states')->where('type','C')->get();
      	return view('admin.company.index')->with('companies',$companies);
    }
}

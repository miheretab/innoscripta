<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Bill;

class CompaniesController extends Controller
{
    public function index() {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }
}

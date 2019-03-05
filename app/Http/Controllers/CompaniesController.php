<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Bill;

class CompaniesController extends Controller
{
    public function bills() {
        $bills = Bill::paginate(25);
        return view('companies.bills', compact('bills'));
    }
}

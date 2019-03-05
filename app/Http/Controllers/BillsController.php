<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;

class BillsController extends Controller
{
    public function index(Request $request) {

        if(!empty($request)) {
            $keyword = $request['keyword'];

            $bills = Bill::with('company')->whereHas('company', function ($query) use($keyword) {

                $query->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('id', 'like', '%'.$keyword.'%');

            });

            if(!empty($request['month'])) {
                $bills = $bills->whereMonth('date', $request['month']);
            }

            if(!empty($request['year'])) {
                $bills = $bills->whereYear('date', $request['year']);
            }

            $bills = $bills->orderBy('id', 'asc')->paginate(15);

        } else {
            $bills = Bill::paginate(15);
        }

        return view('bills.index', compact('bills'));
    }
}

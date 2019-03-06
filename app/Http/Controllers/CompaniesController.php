<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Bill;

class CompaniesController extends Controller
{
    public function add(Request $request) {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'referenceNr' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $company = Company::create($request->all());
        //creating bills for the company
        foreach($request->all() as $k => $v) {
            if($k == 'bills') {
                foreach($v as $billArr) {
                    if(empty($billArr['billNumber'])) {
                        unset($billArr['billNumber']);
                    }
                    if(!empty($billArr['billNumber'])) {
                        $billArr['date'] = date('Y-m-d', strtotime($billArr['date']));
                    }
                    $billArr['company_ID'] = $company->id;
                    Bill::create($billArr);
                }
            }
        }

        $request->session()->flash('success', trans('message.createSuccess'));
        return response()->json(['success' => true]);
    }

    public function edit(Request $request, $id) {
        $company = Company::findOrFail($id);
        $company->update($request->all());
        //creating bills for the company
        foreach($request->all() as $k => $v) {
            if($k == 'bills') {
                foreach($v as $billArr) {
                    if(empty($billArr['billNumber'])) {
                        unset($billArr['billNumber']);
                    }
                    if(!empty($billArr['billNumber'])) {
                        $billArr['date'] = date('Y-m-d', strtotime($billArr['date']));
                    }
                    $billArr['company_ID'] = $company->id;
                    if(!empty($billArr['billId'])) {
                        $bill = Bill::findOrFail($billArr['billId']);
                        $bill->update($billArr);
                    } else {
                        Bill::create($billArr);
                    }
                }
            }
        }

        $request->session()->flash('success', trans('message.updateSuccess'));
        return response()->json(['success' => true]);
    }
}

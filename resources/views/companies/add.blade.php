      <div class="modal-header">
        <h4 class="modal-title">{{ isset($company) ? 'Edit' : 'Add' }} Company/Bills</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <form class="form row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="form-label">Company Name</label>
                    <input class="form-control" name="company_name" id="company-name" value="{{isset($company) ? $company->name : ''}}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Company Number</label>
                    <input class="form-control" name="referenceNr" id="company-number" value="{{isset($company) ? $company->referenceNr : ''}}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Street</label>
                    <input class="form-control" name="street" id="street" value="{{isset($company) ? $company->street : ''}}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Code</label>
                    <input class="form-control" name="code" id="code" value="{{isset($company) ? $company->code : ''}}" />
                </div>

                <div class="form-group">
                    <label class="form-label">Country</label>
                    <input class="form-control" name="country" id="country" value="{{isset($company) ? $company->country : ''}}" />
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-label">State</label>
                        <input class="form-control" name="state" id="state" value="{{isset($company) ? $company->state : ''}}" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input class="form-control" name="city" id="city" value="{{isset($company) ? $company->city : ''}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Amount</label>
                    <input class="form-control" name="funding" id="amount" onchange="calcFeeAmount();" value="{{isset($company) ? $company->funding : ''}}" >
                </div>

                <div class="form-group row">
                    <div class="col-md-6 has-percent">
                        <label class="form-label">Fee</label>
                        <span class="form-control-feedback">%</span>
                        <input class="form-control" name="fee" id="fee" onchange="calcFeeAmount();" value="{{isset($company) ? $company->fee : ''}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mt-sm-3"></label>
                        <input class="form-control" id="feeAmount" name="feeAmount" readonly />
                    </div>
                </div>

            </div>
            <div class="col-md-9 bills">
                @if(isset($company))
                @foreach($company->bills as $i => $bill)
                <fieldset id="bill{{$i+1}}">
                    <legend>Bill {{$i+1}}</legend>
                    <div class="row" id="bill">
                        <input type="hidden" value="{{$bill->id}}" class="bill-id" />
                        <div class="form-group col-md-3">
                            <label class="form-label">Bill Date</label>
                            <input type="text" class="form-control bill-date" value="{{$bill->formattedDate}}">
                        </div>

                        <div class="form-group col-md-3">
                            <label class="form-label">Bill Number</label>
                            <input class="form-control bill-number" value="{{$bill->billNumber}}" />
                        </div>

                        <div class="form-group col-md-3">
                            <label class="form-label">Amount</label>
                            <input class="form-control bill-amount" value="{{$bill->amount}}" onchange="checkMaxFee();" />
                        </div>
                        <div class="form-group col-md-3 has-percent">
                            <label class="form-label mt-sm-3"></label>
                            <span class="form-control-feedback">%</span>
                            <input class="form-control bill-percent" readonly />
                        </div>
                    </div>
                </fieldset>
                @endforeach
                @else
                <fieldset id="bill1">
                    <legend>Bill 1</legend>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="form-label">Bill Date</label>
                            <input type="text" class="form-control bill-date" value="">
                        </div>

                        <div class="form-group col-md-3">
                            <label class="form-label">Bill Number</label>
                            <input class="form-control bill-number" />
                        </div>

                        <div class="form-group col-md-3">
                            <label class="form-label">Amount</label>
                            <input class="form-control bill-amount" value="0" onchange="checkMaxFee();" />
                        </div>
                        <div class="form-group col-md-3 has-percent">
                            <label class="form-label mt-sm-3"></label>
                            <span class="form-control-feedback">%</span>
                            <input class="form-control bill-percent" readonly />
                        </div>
                    </div>
                </fieldset>
                @endif
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="addBill();">Add a Bill</button>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="save('{{ isset($company) ? url('companies/edit/' . $company->id) : url('companies/add') }}');">Submit</button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
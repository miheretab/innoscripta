@extends('layouts.app')

@section('title', 'Company Bills')

@section('content')
<div class="row">
    @if (session('success'))
      <div class="alert alert-success alert-dismissable col-md-12">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('success') }}
      </div>
    @endif

    <div class="col-md-12">
        <a href="{{url('companies/add')}}" data-toggle="modal" data-target="#add-modal" onclick="loadUrl($(this).attr('href'));" class="btn btn-primary mb-sm-2">Add Company/Bills</a>
        <form class="form-inline float-right">
            <select class="form-control mr-sm-1" name="month" id="month" onchange="location.href = '/?keyword=' + $('#keyword').val() + '&month=' + $(this).val() + '&year=' + $('#year').val();">
                <option value=''>All Months</option>
                @foreach(range(1, 12) as $m)
                <option {{request()->month == $m ? 'selected' : ''}} value="{{$m}}">{{$m}}</option>
                @endforeach
            </select>
            <select class="form-control mr-sm-1" name="year" id="year" onchange="location.href = '/?keyword=' + $('#keyword').val() + '&month=' + $('#month').val() + '&year=' + $(this).val();">
                <option value=''>All Years</option>
                @foreach(range(date('Y', strtotime('- 10 years')), date('Y')) as $y)
                <option {{request()->year == $y ? 'selected' : ''}} value="{{$y}}">{{$y}}</option>
                @endforeach
            </select>
            <div class="form-group has-search">
              <span class="fa fa-search form-control-feedback"></span>
              <input type="text" class="form-control" name="keyword" id="keyword" value="{{request()->keyword}}" placeholder="Search">
            </div>
        </form>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Action</th>
                <th>Payment Date</th>
                <th>Company<br><small>Company Number</small></th>
                <th>Bill Number</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
            @if($bill->company)
            <tr>
                <td>
                    <a href="{{url('/companies/edit/' . $bill->company->id)}}" data-toggle="modal" data-target="#add-modal" onclick="loadUrl($(this).attr('href'));"><span class="fa fa-edit fa-2x float-left"></span></a>
                    <form method="post" action='{{url("bills/delete/" . $bill->id)}}' id="formDelete{{$bill->id}}" class="form-inline float-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a href="javascript:void(0);" onclick="confirm('Are you sure you want to delete?') ? $('#formDelete{{$bill->id}}').submit() : false;"><span class="fa fa-times-circle fa-2x"></span></a>
                    </form>
                </td>
                <td>{{$bill->formattedDate}}</td>
                <td>{{$bill->company->name}} <br> <small>{{$bill->company->referenceNr}}</small></td>
                <td>{{$bill->billNumber}}</td>
                <td>{{$bill->formattedAmount}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    {{ $bills->appends(['keyword' => request()->keyword, 'month' => request()->month, 'year' => request()->year])->links() }}
</div>

<!-- Modal -->
<div id="add-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

    </div>

  </div>
</div>

<script>

function save(url) {
    if(checkMaxFee()) {
        var data = {
            _token: '{{csrf_token()}}',
            name: $('#company-name').val(),
            referenceNr: $('#company-number').val(),
            street: $('#street').val(),
            code: $('#code').val(),
            state: $('#state').val(),
            city: $('#city').val(),
            country: $('#country').val(),
            funding: $('#amount').val(),
            fee: $('#fee').val(),
            bills: {}
        }
        for(var i = 1; i <= lastBillNumber; i++) {
            data['bills'][i] = {
                date: $('#bill'+i+' .bill-date').val(),
                billNumber: $('#bill'+i+' .bill-number').val(),
                amount: $('#bill'+i+' .bill-amount').val(),
                billId: $('#bill'+i+' .bill-id').length ? $('#bill'+i+' .bill-id').val() : ''
            }
        }

        $.ajax({
            url: url,
            method: url.includes('edit') ? 'PUT' : 'POST',
            data: data,
            success: function(resp) {
                $('.alert-danger').hide();
                $('.alert-danger').html('');
                $.each(resp.errors, function(key, value){
                    $('.alert-danger').show();
                    $('.alert-danger').append('<p>'+value+'</p>');
                });
                if(resp.success) {
                    location.href = '{{url("/")}}';
                }
            }
        });
    }
}
</script>
@endsection
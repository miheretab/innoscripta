@extends('layouts.app')

@section('title', 'Company Bills')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{url('companies/add')}}" class="btn btn-primary mb-sm-2">Add Company/Bills</a>
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
                    <a href="{{url('bills/edit/' . $bill->id)}}" class=""><span class="fa fa-edit fa-2x"></span></a>
                    <a href="{{url('bills/delete/' . $bill->id)}}" class=""><span class="fa fa-times-circle fa-2x"></span></a>
                </td>
                <td>{{$bill->formattedDate}}</td>
                <td>{{$bill->company->name}} <br> <small>{{$bill->company->id}}</small></td>
                <td>{{$bill->billNumber}}</td>
                <td>{{$bill->formattedAmount}}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    {{ $bills->appends(['keyword' => request()->keyword, 'month' => request()->month, 'year' => request()->year])->links() }}
</div>
@endsection
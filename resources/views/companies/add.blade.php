@extends('layouts.app')

@section('title', 'Add Company')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form class="">
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
</div>
@endsection
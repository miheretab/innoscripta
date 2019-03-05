@extends('layouts.app')

@section('title', 'Company Bills')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Action</th>
                <th>Payment Date</th>
                <th>Company<br>Company Number</th>
                <th>Bill Number</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
            <tr>
                <td>Action</td>
                <td>{{$bill->formattedDate}}</td>
                <td>{{$bill->company->name}} <br> {{$bill->company->id}}</td>
                <td>{{$bill->billNumber}}</td>
                <td>{{$bill->formattedAmount}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
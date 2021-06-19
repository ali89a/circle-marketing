@extends('admin.layouts.master')

@section('content')
<h2>Dashboard</h2>
<h5>{{\App\Classes\PriceCalculation::price(600,'2021-06-5')}}</h5>
@endsection

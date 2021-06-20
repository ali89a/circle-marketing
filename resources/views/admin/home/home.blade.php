@extends('admin.layouts.master')

@section('content')
<h2>Dashboard</h2>
<h5>{{\App\Classes\PriceCalculation::price(1007000,'2021-06-5')}}</h5>
{{ \App\Classes\ConvertNumber::convert_number_to_words(\App\Classes\PriceCalculation::price(1007000,'2021-06-5')) }}
@endsection

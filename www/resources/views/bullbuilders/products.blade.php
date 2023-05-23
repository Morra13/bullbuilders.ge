<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getEnum();
?>
@extends('bullbuilders.header', ['title' => __($obEnum::PRODUCTS)])

@section('content')

@endsection

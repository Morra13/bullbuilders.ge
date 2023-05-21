<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getLang();
?>
@extends('bullbuilders.header', ['title' => __($obEnum::PRODUCTS)])

@section('content')

@endsection

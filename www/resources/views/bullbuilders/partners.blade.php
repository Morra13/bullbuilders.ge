<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getEnum();
?>
@extends('bullbuilders.header', ['title' => __($obEnum::PARTNERS)])

@section('content')

@endsection

<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getEnum();
?>
@extends('amado.header', ['title' => __($obEnum::ABOUT)])

@section('content')

@endsection

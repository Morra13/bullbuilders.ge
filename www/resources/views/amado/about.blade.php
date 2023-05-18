<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getLang();
?>
@extends('amado.header', ['title' => __($obEnum::ABOUT)])

@section('content')

@endsection

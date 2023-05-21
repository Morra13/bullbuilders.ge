<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getLang();
?>
@extends('bullbuilders.header', ['title' => __($obEnum::ABOUT)])

@section('content')

@endsection

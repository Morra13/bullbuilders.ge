<?
$obEnum = (new \App\Http\Controllers\Enum\LangController())::getLang();
?>
@extends('bullbuilders.header', ['title' => __($obEnum::PROJECTS)])

@section('content')

@endsection

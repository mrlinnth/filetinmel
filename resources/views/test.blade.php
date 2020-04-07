@extends('filetinmel::layouts.full-w')

@section('heading', 'Test Page')

@section('content')
    <h3>hello world</h3>
    <hr class="my-10">

    <p>FTM Test</p>
    <ftm-test title="Lorem Ipsum"></ftm-test>

    <hr class="my-10">

    <p>Single File</p>
    <single-file title="Silat Dema"></single-file>

    <hr class="my-10">

    <p>Multiple Files</p>
    <multiple-files></multiple-files>

@endsection

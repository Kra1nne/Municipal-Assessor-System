@extends('layouts/commonMaster' )

@section('layoutContent')<!-- Content -->

@include('layouts/sections/navbar/homenavbar')
@yield('content')
<!--/ Content -->

@endsection

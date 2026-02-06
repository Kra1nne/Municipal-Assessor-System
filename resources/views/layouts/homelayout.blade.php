@extends('layouts/commonMaster' )

@section('layoutContent')<!-- Content -->

@include('layouts/sections/navbar/homenavbar')
@yield('content')
<!--/ Content -->
@include('layouts/sections/footer/homefooter')
@endsection

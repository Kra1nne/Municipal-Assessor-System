@extends('layouts/contentNavbarLayout')

@section('title', 'Schedule Market Value')

@section('page-script')
@vite('resources/assets/js/marketvalue.js')
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="card">
  <div class="mb-3 navbar-nav-right d-flex align-items-center px-3 mt-3">
    <div class="navbar-nav align-items-start">
      <div class="nav-item d-flex align-items-center">
        <i class="ri-search-line ri-22px me-1_5"></i>
        <input type="search" id="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 ms-50" placeholder="Search market value..." aria-label="Search...">
      </div>
    </div>
    <div class="navbar-nav flex-row align-items-center ms-auto gap-5">
      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddMarketValue">
        <span class="tf-icons ri-add-circle-line ri-16px me-1_5"></span>Add
      </button>
    </div>
  </div>
  <div class="table-responsive text-nowrap overflow-auto" style="max-height: 500px;">
    <table class="table table-hover">
      <thead class="position-sticky top-0 bg-body">
        <tr>
          <th>Property Type</th>
          <th>Class</th>
          <th>Value</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="marketValueList">
        {{-- Data will be populated by JavaScript --}}
      </tbody>
    </table>
  </div>
</section>
{{-- Add Modal --}}
<div class="modal fade" id="AddMarketValue" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-3">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
            <span class="app-brand-text demo text-heading fw-semibold">{{ config('variables.templateName') }}</span>
          </a>
        </div>

        <div class="card-body mt-5">

          <form id="PropertyData" class="mb-5">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
              <select class="form-select" id="type" name="type" aria-label="Default select example">
                <option value="" selected disabled>Select Property Type</option>
                @foreach ($propertylist as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
              <label for="exampleFormControlSelect1">Property Type</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input type="number" class="form-control" id="class" name="class" placeholder="Enter class..." autofocus>
              <label for="class">Class</label>
            </div>
             <div class="form-floating form-floating-outline mb-5">
              <input type="number" class="form-control" id="value" name="value" placeholder="Enter value..." autofocus>
              <label for="value">Value</label>
            </div>
          </form>
        </div>
        <div>
          <button type="button" class="btn btn-primary d-grid w-100 mb-5" id="AddMarketValueBtn">Submit</button>
      </div>
      </div>
    </div>
  </div>
</div>
{{-- Edit Modal --}}
<div class="modal fade" id="editMarketValueModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-3">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20])</span>
            <span class="app-brand-text demo text-heading fw-semibold">{{ config('variables.templateName') }}</span>
          </a>
        </div>
        <div class="card-body mt-5">
          <form id="PropertyDataEdit" class="mb-5">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
              <input type="text" id="Edit_id" name="id" hidden>
              <select class="form-select" id="Edit_type" name="type" aria-label="Default select example">
                <option value="" selected disabled>Select Property Type</option>
                @foreach ($propertylist as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
              <label for="exampleFormControlSelect1">Property Type</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input type="number" class="form-control" id="Edit_class" name="class" placeholder="Enter class..." autofocus>
              <label for="class">Class</label>
            </div>
             <div class="form-floating form-floating-outline mb-5">
              <input type="number" class="form-control" id="Edit_value" name="value" placeholder="Enter value..." autofocus>
              <label for="value">Value</label>
            </div>
          </form>
        </div>
        <div>
          <button type="button" class="btn btn-primary d-grid w-100 mb-5" id="EditMarketValueBtn">Submit</button>
      </div>
      </div>
    </div>
  </div>
</div>

@php
  $marketValues = collect($marketValues)->map(function($marketValues) {
  return [
      'encrypted_id' => Crypt::encryptString($marketValues->id),
      'property_type' => $marketValues->type_name,
      'property_type_id' => $marketValues->list_id, // Add the property type ID
      'class' => $marketValues->class,
      'value' => $marketValues->value,
      'created_at' => $marketValues->created_at->format('M d, Y'),
  ];
  })->values()->toArray();
@endphp
<script>
  window.marketValues = @json($marketValues);
</script>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Properties - Types')

@section('page-script')
@vite('resources/assets/js/types.js')
@endsection

@section('content')
<section class="card">
  <div class="mb-3 navbar-nav-right d-flex align-items-center px-3 mt-3">
    <div class="navbar-nav align-items-start">
      <div class="nav-item d-flex align-items-center">
        <i class="ri-search-line ri-22px me-1_5"></i>
        <input type="search" id="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 ms-50" placeholder="Search property type..." aria-label="Search...">
      </div>
    </div>
    <div class="navbar-nav flex-row align-items-center ms-auto gap-5">
      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddPropertyType">
        <span class="tf-icons ri-add-circle-line ri-16px me-1_5"></span>Add
      </button>
    </div>
  </div>
  <div class="table-responsive text-nowrap overflow-auto" style="max-height: 500px;">
    <table class="table table-hover">
      <thead class="position-sticky top-0 bg-body">
        <tr>
          <th>Property Type</th>
          <th>Assessment Rate Percentage</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="propertyTypeList">
        {{-- Data will be populated by JavaScript --}}
      </tbody>
    </table>
  </div>
</section>
{{-- Add Modal --}}
<div class="modal fade" id="AddPropertyType" tabindex="-1" aria-hidden="true">
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
              <input type="text" class="form-control" id="type" name="type" placeholder="Enter property type..." autofocus>
              <label for="type">Property Types</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input type="number" class="form-control" id="rate" name="rate" placeholder="Enter assessment rate..." autofocus>
              <label for="rate">Assessment Rate Percentage</label>
            </div>
          </form>
        </div>
        <div>
          <button type="button" class="btn btn-primary d-grid w-100 mb-5" id="AddTypeBtn">Submit</button>
      </div>
      </div>
    </div>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="EditPropertyType" tabindex="-1" aria-hidden="true">
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
              <input type="text" name="type_id" id="Edit_id" hidden>
              <input type="text" name="list_id" id="Edit_list_id" hidden>
              <input type="text" class="form-control" id="Edit_type" name="type" placeholder="Enter property type..." autofocus>
              <label for="Edit_type">Property Types</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input type="number" class="form-control" id="Edit_rate" name="rate" placeholder="Enter assessment rate..." autofocus>
              <label for="Edit_rate">Assessment Rate Percentage</label>
            </div>
          </form>
        </div>
        <div>
          <button type="button" class="btn btn-primary d-grid w-100 mb-5" id="EditTypeBtn">Submit</button>
      </div>
      </div>
    </div>
  </div>
</div>

@php
  $propertyTypes = collect($propertyTypes)->map(function($property) {
  return [
      'encrypted_id' => Crypt::encryptString($property->id),
      'assessment_rate' => $property->assessment_rate,
      'type_name' => $property->type_name,
      'list_id' => Crypt::encryptString($property->list_id)
  ];
  })->values()->toArray();
@endphp
<script>
  window.propertyTypes = @json($propertyTypes);
</script>
@endsection

@extends('layouts/contentNavbarLayout')

@section('title', 'Building Rate - List')

@section('page-script')
@vite('resources/assets/js/building-rate.js')
@endsection

@section('content')
<section class="card">
  <div class="mb-5 navbar-nav-right d-flex align-items-center px-3 mt-3">
    <div class="navbar-nav align-items-start">
      <div class="nav-item d-flex align-items-center">
        <i class="ri-search-line ri-22px me-1_5"></i>
        <input type="search" id="search" class="form-control mt-3 border-0 shadow-none ps-1 ps-sm-2 ms-50" placeholder="Search building classification..." aria-label="Search...">
      </div>
    </div>
    <div class="navbar-nav flex-row align-items-center ms-auto gap-5">
      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddClassfication">
        <span class="tf-icons ri-add-circle-line ri-16px me-1_5"></span>Add
      </button>
    </div>
  </div>
  <div class="table-responsive text-nowrap overflow-auto" style="max-height: 530px;">
    <table class="table table-hover">
      <thead class="position-sticky top-0 bg-body">
        <tr>
          <th>Classification</th>
          <th>Minimum</th>
          <th>Maximum</th>
          <th>Percentage</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="buildingclass">
      </tbody>
    </table>
  </div>
</section>
  {{-- add data modal --}}
<div class="modal fade" id="AddClassfication" tabindex="-1" aria-hidden="true">
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
        <!-- /Logo -->
        <div class="card-body mt-5">

          <form id="BuldingClassificationData" class="mb-3">
            @csrf
            <div class="form-floating form-floating-outline mb-4">
              <select class="form-select" id="class" name="class" aria-label="Default select example">
                <option value="" selected disabled>Classification</option>
                <option value="Residential">Residential</option>
                <option value="Commercial">Commercial</option>
                <option value="Agricultural">Agricultural</option>
              </select>
              <label for="exampleFormControlSelect1">Classification</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="number" class="form-control" id="min" name="min" placeholder="Enter minimum amount">
              <label for="min">Minimum Amount</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="number" class="form-control" id="max" name="max" placeholder="Enter the maximum amount">
              <label for="max">Maximum Amount</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Enter the classification percentage" autofocus>
              <label for="percentage">Percentage</label>
            </div>

          </form>
        </div>
        <div>
          <button type="button" class="btn btn-primary d-grid w-100 mb-3" id="Add">Submit</button>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Update -->
<div class="modal fade" id="EditClassfication" tabindex="-1" aria-hidden="true">
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
        <!-- /Logo -->
        <div class="card-body mt-5">

          <form id="EditClassificationData" class="mb-3">
            @csrf
            <div class="form-floating form-floating-outline mb-4">
              <input type="hidden" id="Edit_id" name="id">
              <select class="form-select" id="Edit_class" name="class" aria-label="Default select example">
                <option value="" selected disabled>Classification</option>
                <option value="Residential">Residential</option>
                <option value="Commercial">Commercial</option>
                <option value="Agricultural">Agricultural</option>
              </select>
              <label for="exampleFormControlSelect1">Classification</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="number" class="form-control" id="Edit_min" name="min" placeholder="Enter minimum amount">
              <label for="min">Minimum Amount</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="number" class="form-control" id="Edit_max" name="max" placeholder="Enter the maximum amount">
              <label for="max">Maximum Amount</label>
            </div>
            <div class="form-floating form-floating-outline mb-3">
              <input type="number" class="form-control" id="Edit_percentage" name="percentage" placeholder="Enter the classification percentage" autofocus>
              <label for="percentage">Percentage</label>
            </div>

          </form>
        </div>
        <div>
          <button type="button" class="btn btn-primary d-grid w-100 mb-3" id="EditBtn">Submit</button>
      </div>
      </div>
    </div>
  </div>
</div>
<script>
  window.classification = @json($class);
</script>
@endsection

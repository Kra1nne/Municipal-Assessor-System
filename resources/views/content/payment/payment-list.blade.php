@extends('layouts/contentNavbarLayout')

@section('title', 'Payment - List')

@section('content')
<header class="row mb-8">
  <div class="col-xl-3 col-md-6 mb-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Total Payments</p>
          <h3 class="fw-bold mb-0" id="totalAssessment">₱174,500</h3>
          <small class="text-primary">For 2024</small>
        </div>
        <div class="text-primary fs-2">
          <i class="ri-money-dollar-box-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Complete</p>
          <h3 class="fw-bold mb-0" id="completeAssessment">₱7,500</h3>
          <small class="text-success">Successfull payment</small>
        </div>
        <div class="text-success fs-2">
          <i class="ri-checkbox-circle-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Processing</p>
          <h3 class="fw-bold mb-0" id="reviewAssessment">₱7,500</h3>
          <small class="text-muted">Pending payments</small>
        </div>
        <div class="text-primary fs-2">
          <i class="ri-time-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3">
    <div class="card h-100 shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="py-5">
          <p class="text-muted mb-2 fw-bolder">Processing Fees</p>
          <h3 class="fw-bold text-success mb-0" id="totalValue">₱230.5k</h3>
          <small class="text-muted">Total fees collected</small>
        </div>
        <div class="text-success fs-2">
          <i class="ri-money-dollar-box-line" style="font-size: 2.8rem;"></i>
        </div>
      </div>
    </div>
  </div>
</header>
<section class="card">
  <div class="mb-3 navbar-nav-right d-flex align-items-center px-3 mt-3">
    <div class="navbar-nav align-items-start">
      <div class="nav-item d-flex align-items-center">
        <i class="ri-search-line ri-22px me-1_5"></i>
        <input type="search" id="search" class="form-control border-0 shadow-none ps-1 ps-sm-2 ms-50" placeholder="Search..." aria-label="Search...">
      </div>
    </div>
    <div class="navbar-nav flex-row align-items-center ms-auto gap-5">
      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AddAccount">
        <span class="tf-icons ri-add-circle-line ri-16px me-1_5"></span>Add
      </button>
    </div>
  </div>
  <div class="table-responsive text-nowrap overflow-auto" style="max-height: 500px;">
    <table class="table table-hover">
      <thead class="position-sticky top-0 bg-body">
        <tr>
          <th>Payment ID</th>
          <th>Taxpayer</th>
          <th>Property</th>
          <th>Amount</th>
          <th>Methods</th>
          <th>Due Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="propertylist">
        <tr>
          <th>LTAX-2024-001</th>
          <th>John Smith</th>
          <th>LOT-001</th>
          <th>₱10,203.44</th>
          <th>Credit Card</th>
          <th>03/10/205</th>
          <th>
            <span class="badge rounded-pill bg-label-success me-1">Paid</span>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</section>
@endsection

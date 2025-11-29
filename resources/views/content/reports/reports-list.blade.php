@extends('layouts/contentNavbarLayout')

@section('title', 'Reports - List')

@section('content')
<main class="container py-4">

    <!-- Reports Card -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="ri-bar-chart-box-line"></i> Reports
        </div>

        <div class="card-body row">

            <!-- LEFT: Report Categories -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="ri-list-unordered"></i> Categories
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="ri-building-2-line"></i> Land Market Value</li>
                        <li class="list-group-item"><i class="ri-file-list-3-line"></i> Land Assessment</li>
                        <li class="list-group-item"><i class="ri-store-2-line"></i> Commercial</li>
                        <li class="list-group-item"><i class="ri-home-4-line"></i> Residential</li>
                        <li class="list-group-item"><i class="ri-seedling-line"></i> Agricultural</li>
                        <li class="list-group-item"><i class="ri-building-line"></i> Building Assessment</li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT: Date Range Report Generator -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="ri-calendar-event-line"></i> Generate Report by Date Range
                    </div>
                    <div class="card-body">

                        <p class="text-muted">
                            This report allows you to generate the total value for any of the categories listed. Reports are generated quarterly by default, but you may also select a custom date range.
                        </p>

                        <form class="row g-3" action="{{ route('reports-pdf-view') }}" method="POST" target="_blank">
                          @csrf
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Report Type</label>
                                <select class="form-select" name="value">
                                    <option selected disabled>-- Select report to generate --</option>
                                    <option value="market_value">Land Market Value</option>
                                    <option value="assess">Land Assessment</option>
                                    <option value="commercial">Commercial</option>
                                    <option value="residential">Residential</option>
                                    <option value="agricultural">Agricultural</option>
                                    <option value="building">Building Assessment</option>
                                </select>
                            </div>

                            <div class="col-12 text-end">
                                <button class="btn btn-primary" type="sumbit">
                                    <i class="ri-search-line"></i> Generate Report
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
@endsection

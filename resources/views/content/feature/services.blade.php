@extends('layouts/homelayout')
@section('title', 'Services Page')

@section('content')
<div class="container-fluid p-0 mb-5"
    style="
        background-image:
            linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
            url('{{ asset('assets/img/backgrounds/cover2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
    <div class="container d-flex align-items-center min-vh-100">
        <div class="row">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">
                    Our Services
                </span>

                <h1 class="display-3 fw-bold text-white mb-3">
                    Smart Property Assessment Services
                </h1>

                <p class="fs-5 text-white">
                    Designed to modernize property assessment workflows, improve transparency,
                    and deliver efficient digital services for municipalities and citizens.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container py-5 ">
    {{-- Property Visualization --}}
    <section class="mb-5 animate-on-scroll" data-animation="animate__fadeInUp">
        <div class="p-4 p-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center animate__animated animate__fadeInLeft">
                    <img src="{{ asset('assets/img/elements/Globe.png') }}" 
                         alt="Property Visualization"
                         class="img-fluid rounded-4">
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <span class="badge bg-success-subtle text-success mb-3">
                        Core Feature
                    </span>
                    <h2 class="fw-bold mb-3">Property Visualization</h2>
                    <p class="text-muted mb-4">
                        Visualize and manage municipal properties with interactive maps and detailed property profiles.
                        Access ownership details, assessment values, zoning info, and property history to support
                        transparent decision-making.
                    </p>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Interactive maps and ownership data</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Advanced property search and filters</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Centralized and accurate property records</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Automated valuation reports</li>
                        <li class="d-flex"><i class="ri-check-line text-success me-2"></i> Secure document history and audit trail</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Automated Documents --}}
    <section class="mb-5 animate-on-scroll" data-animation="animate__fadeInUp">
        <div class="p-4 p-lg-5">
            <div class="row align-items-center g-5 flex-lg-row-reverse">
                <div class="col-lg-6 text-center animate__animated animate__fadeInRight">
                    <img src="{{ asset('assets/img/elements/Documents.png') }}" 
                         alt="Automated Documents"
                         class="img-fluid rounded-4">
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInLeft">
                    <span class="badge bg-warning-subtle text-warning mb-3">
                        Automation
                    </span>
                    <h2 class="fw-bold mb-3">Automated Documents</h2>
                    <p class="text-muted mb-4">
                        Automate the creation and management of official assessment documents,
                        ensuring consistency, compliance, and efficiency across all departments.
                    </p>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Auto-generated notices and reports</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Reduced errors and manual workload</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Standardized templates for compliance</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Secure storage with audit tracking</li>
                        <li class="d-flex"><i class="ri-check-line text-success me-2"></i> Easy sharing and retrieval</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Workflow & Analytics --}}
    <section class="mb-5 animate-on-scroll" data-animation="animate__fadeInUp">
        <div class="p-4 p-lg-5 text-center">
            <span class="badge bg-secondary-subtle text-secondary mb-3">
                Insights & Control
            </span>
            <h2 class="fw-bold mb-3">Workflow & Analytics Dashboard</h2>
            <p class="text-muted mx-auto mb-4" style="max-width: 760px;">
                Gain full visibility into assessment workflows, document status, and public requests
                through real-time dashboards and performance analytics.
            </p>
            <div class="row g-4 mt-3">
                <div class="col-md-4">
                    <div class="p-4 h-100 shadow-sm rounded bg-white">
                        <i class="ri-line-chart-line fs-2 text-primary mb-2"></i>
                        <h6 class="fw-bold">Performance Tracking</h6>
                        <p class="text-muted small">Monitor processing times and workload efficiency.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 h-100 shadow-sm rounded bg-white">
                        <i class="ri-flow-chart fs-2 text-success mb-2"></i>
                        <h6 class="fw-bold">Workflow Status</h6>
                        <p class="text-muted small">Track every request and document stage in real time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 h-100 shadow-sm rounded bg-white">
                        <i class="ri-shield-check-line fs-2 text-warning mb-2"></i>
                        <h6 class="fw-bold">Compliance Overview</h6>
                        <p class="text-muted small">Ensure regulatory adherence across all transactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Online Property Requests --}}
    <section class="mb-5 animate-on-scroll" data-animation="animate__fadeInUp">
        <div class="p-4 p-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center animate__animated animate__fadeInLeft">
                    <img src="{{ asset('assets/img/elements/Online.png') }}" 
                         alt="Online Property Requests"
                         class="img-fluid rounded-4">
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <span class="badge bg-info-subtle text-info mb-3">
                        Public Service
                    </span>
                    <h2 class="fw-bold mb-3">Online Property Requests</h2>
                    <p class="text-muted mb-4">
                        Enable property owners to submit requests online, track progress in real time,
                        and receive timely updates—improving transparency and service delivery.
                    </p>
                    <ul class="list-unstyled">
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Online submissions and appeals</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Simple and user-friendly portal</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Real-time request tracking</li>
                        <li class="d-flex mb-2"><i class="ri-check-line text-success me-2"></i> Automated notifications</li>
                        <li class="d-flex"><i class="ri-check-line text-success me-2"></i> Improved municipal efficiency</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</div>

{{-- Scroll Animation Script --}}
<script>
$(document).ready(function () {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const $el = $(entry.target);
                const animation = $el.data('animation') || 'animate__fadeInUp';
                $el.addClass('animate__animated ' + animation);
                observer.unobserve(entry.target); // animate only once
            }
        });
    }, { threshold: 0.3 });

    $('.animate-on-scroll').each(function () {
        observer.observe(this);
    });
});
</script>

@endsection

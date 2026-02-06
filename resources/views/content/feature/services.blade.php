@extends('layouts/homelayout')
@section('title', 'Services Page')

@section('content')
<main class="container py-5">

    {{-- Property Visualization Section --}}
    <section class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
            <img src="{{ asset('assets/img/elements/Globe.png') }}" 
                 alt="Property Visualization" 
                 class="img-fluid rounded animate__animated animate__fadeInLeft">
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <div class="animate__animated animate__fadeInRight">
                <h2 class="fw-bold mb-3">Property Visualization</h2>
                <p class="mb-3">
                    Visualize and manage municipal properties with interactive maps and detailed property profiles. 
                    Access ownership details, assessment values, zoning info, and property history to support 
                    transparent decision-making and accurate valuations.
                </p>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Interactive maps highlight property locations and ownership.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Quick, intuitive search by owner, location, zoning, or assessment.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Centralized property records for accuracy and reduced manual work.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Generate standardized assessment notices and valuation reports automatically.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Ensure compliance with municipal regulations through predefined templates and validation.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="ri-check-line text-success me-2"></i> Maintain secure, auditable history for all property documents.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Automated Documents Section --}}
    <section class="row align-items-center mb-5 flex-lg-row-reverse">
        <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
            <img src="{{ asset('assets/img/elements/Documents.png') }}" 
                 alt="Automated Documents" 
                 class="img-fluid rounded animate-on-scroll" data-animation="animate__fadeInRight">
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <div class="animate-on-scroll" data-animation="animate__fadeInLeft">
                <h2 class="fw-bold mb-3">Automated Documents</h2>
                <p class="mb-3">
                    Automate the creation and management of official assessment documents, ensuring consistency, 
                    compliance, and efficiency. Reduce manual work while securely storing and tracking all records.
                </p>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Generate notices, valuation reports, and tax statements automatically.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Reduce errors and save time through automated workflows.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Maintain compliance using standardized templates and validated data sources.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Secure storage with full audit trail and access tracking.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="ri-check-line text-success me-2"></i> Facilitate seamless document sharing and retrieval for stakeholders.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Online Property Request Section --}}
    <section class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
            <img src="{{ asset('assets/img/elements/Online.png') }}" 
                 alt="Online Property Request" 
                 class="img-fluid rounded animate-on-scroll" data-animation="animate__fadeInLeft">
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <div class="animate-on-scroll" data-animation="animate__fadeInRight">
                <h2 class="fw-bold mb-3">Online Property Requests</h2>
                <p class="mb-3">
                    Allow property owners to submit assessment requests online, track progress in real time, 
                    and receive timely updates. Enhance public service efficiency and transparency.
                </p>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Submit inquiries, corrections, and appeals online.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> User-friendly portal ensures smooth and quick submissions.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Real-time status tracking for administrators and owners.
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="ri-check-line text-success me-2"></i> Automated notifications improve communication and transparency.
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="ri-check-line text-success me-2"></i> Streamlined workflow increases municipal efficiency and accountability.
                    </li>
                </ul>
            </div>
        </div>
    </section>

</main>

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

@extends('layouts/homelayout')

@section('title', 'Home Page')

@section('content')
    <div class="container gap-5">
        <section class="pt-5 mt-5">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="text-center text-lg-start mb-lg-0 w-100 ">
                        <img src="{{ asset('assets/img/backgrounds/cover2.jpg') }}" alt="Landing Background"
                            class="img-fluid cover mx-auto mx-lg-0 w-100 rounded animate__animated animate__fadeInLeft" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold space-lettering-tight">
                        Municipal Assessor System
                    </h1>
                    <p>The Municipal Assessor System is a comprehensive platform designed to streamline land and building assessments within municipal jurisdictions. It provides tools for accurate valuation, efficient data management, and seamless reporting for assessor offices.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="/login" class="btn btn-primary btn-lg rounded-pill px-3">Get
                            Started</a>
                        <a href="#services-section" class="btn btn-outline-primary btn-lg rounded-pill px-3">Our
                            Services</a>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-5 pt-5 mb-5">

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="d-flex align-items-center gap-3 p-3">
                    <div class="bg-light rounded p-4 text-primary">
                        <i class="ri-group-line fs-3"></i>
                    </div>
                    <div>
                        <span class="fw-bold fs-4">1000+</span>
                        <p class="mb-0">Users</p>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="d-flex align-items-center gap-3 p-3">
                    <div class="bg-light rounded p-4 text-primary">
                        <i class="ri-map-line fs-3"></i>
                    </div>
                    <div>
                        <span class="fw-bold fs-4">850+</span>
                        <p class="mb-0">Land Assess</p>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="d-flex align-items-center gap-3 p-3">
                    <div class="bg-light rounded p-4 text-primary">
                        <i class="ri-building-line fs-3"></i>
                    </div>
                    <div>
                        <span class="fw-bold fs-4">620+</span>
                        <p class="mb-0">Building Assess</p>
                    </div>
                    </div>
                </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100">
                    <div class="d-flex align-items-center gap-3 p-3">
                    <div class="bg-light rounded p-4 text-primary">
                        <i class="ri-earth-line fs-3"></i>
                    </div>
                    <div>
                        <span class="fw-bold fs-4">1200+</span>
                        <p class="mb-0">Total Land</p>
                    </div>
                    </div>
                </div>
            </div>

            </div>
        </section>
        <section class="mt-5" id="services-section">
            <div class="d-flex flex-column justify-content-center">
                <div class="text-center">
                    <h2 class="fw-bold pt-5">Our Services</h2>
                    <p class="text-muted pt-5 fw-semibold">Explore the essential services designed to support accurate property assessment, efficient data management, and transparent municipal operations.</p>
                </div>
                <div class="row g-4 mt-5">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card h-100 p-4 text-center">
                    <i class="ri-pin-distance-line fs-1 text-primary mb-3 mt-4"></i>
                    <h5 class="fw-bold mb-2">Property Visualization</h5>
                    <p class="text-muted">
                        Visualize and manage municipal properties with interactive maps and detailed property profiles. Access ownership details, assessment values, zoning information, and property history to support accurate valuation and transparent decision-making
                    </p>
                    <div>
                        <img class="img-fluid w-50" src="{{ asset('assets/img/elements/Map.png') }}" alt="">
                    </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card h-100 p-5 text-center">
                    <i class="ri-file-pdf-2-line fs-1 text-primary mb-3 mt-4"></i>
                    <h5 class="fw-bold">Automated Documents</h5>
                    <p class="text-muted">
                        Generate and manage official assessment documents automatically, including notices, valuation reports, and tax statements. Reduce manual work, ensure consistency, and maintain compliance with municipal regulations through secure document handling.
                    </p>
                    <div>
                        <img class="img-fluid w-50" src="{{ asset('assets/img/elements/Documents.png') }}" alt="">
                    </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card h-100 p-4 text-center">
                    <i class="ri-cloud-line fs-1 text-primary mb-3 mt-4"></i>
                    <h5 class="fw-bold">Online Property Request</h5>
                    <p class="text-muted">
                        Allow property owners and stakeholders to submit assessment-related requests online, such as valuation inquiries, corrections, or appeals. Streamline communication, track request status in real time, and improve public service efficiency.
                    </p>
                    <div>
                        <img class="img-fluid w-50" src="{{ asset('assets/img/elements/Online.png') }}" alt="">
                    </div>
                    </div>
                </div>

                </div>
            </div>

        </section>
        <section class="container mt-5 pb-5 pt-5 d-flex flex-column align-items-center justify-content-center">
            <h3 class="fw-bold pt-5 text-center">How To Use Municipal Assessor System</h3>
            <div class="row d-flex justify-content-center mt-4 pt-5">
                <div class="col-md-6 col-lg-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-door-open-line fs-4 text-primary"></i>
                    </div>
                    <h5 class="mt-3 text-center">Visit the Assessor’s Office</h3>
                        <p class="mt-3 text-center">
                            Property owners or representatives visit the municipal assessor’s office to have an account created and verified.
                        </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-login-box-line fs-4 text-white"></i>
                    </div>
                    <h5 class="mt-3 text-center">Log In to the System</h5>
                    <p class="mt-3 text-center">
                        Use your provided credentials to securely access the municipal assessor system.
                    </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-file-upload-line fs-4 text-primary"></i>
                    </div>
                    <h5 class="mt-3 text-center">Submit Property Requests</h5>
                    <p class="mt-3 text-center">
                        Submit assessment inquiries, corrections, or appeals and upload supporting documents directly through the system.
                    </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="ri-mail-check-line fs-4 text-white"></i>
                    </div>
                    <h5 class="text-center mt-3">Receive Updates</h5>
                    <p class="mt-3 text-center">
                        Track request status and receive email notifications for approvals, updates, or required actions.
                    </p>
                </div>
            </div> 
        </section>
    </div>
    <div class="container-fluid bg-white ">
        <div class="row justify-content-center mt-5">
            <div class=" p-4 p-md-5">
                <div class="text-center mb-4">
                    <h4 class="fw-bold mt-3">Why Use the Municipal Assessor System?</h4>
                    <p class="text-muted mt-2">
                        Designed to make property assessment faster, easier, and more transparent
                        for both residents and municipal staff.
                    </p>
                </div>

                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <i class="ri-time-line fs-3 text-primary mb-2"></i>
                        <h6 class="fw-bold">Save Time</h6>
                        <p class="text-muted small">
                            Submit requests and access property records online without repeated office visits.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <i class="ri-file-list-3-line fs-3 text-primary mb-2"></i>
                        <h6 class="fw-bold">Less Paperwork</h6>
                        <p class="text-muted small">
                            Digital records and automated documents reduce manual processing and errors.
                        </p>
                    </div>

                    <div class="col-md-4">
                        <i class="ri-notification-3-line fs-3 text-primary mb-2"></i>
                        <h6 class="fw-bold">Real-Time Updates</h6>
                        <p class="text-muted small">
                            Track request status and receive notifications for approvals or required actions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4 ">
        <div class="row">
            <div class="col-12">
                <div class="shadow rounded" style="overflow:hidden; border-radius:12px;">
                    <iframe
                        src="https://www.google.com/maps?q=Inopacan+Municipal+Hall,+Inopacan,+Leyte,+Philippines&output=embed"
                        width="100%"
                        height="350"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

@endsection

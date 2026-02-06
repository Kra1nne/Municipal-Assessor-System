@extends('layouts/homelayout')

@section('title', 'About Us')

@section('content')
<div
    class="container-fluid mb-5 p-0"
    style="
        background-image:
            linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
            url('{{ asset('assets/img/backgrounds/cover2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100%;
    "
>
    <div class="container d-flex align-items-center min-vh-100">
        <div class="row">
            <div class="col-lg-7">
                <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill">
                    About the System
                </span>

                <h1 class="fw-bold display-3 mb-3 text-white">
                    A Modern Municipal Property Assessment Platform
                </h1>

                <p class="fs-5 text-white">
                    Designed to improve transparency, efficiency, and accuracy in municipal property assessment
                    through secure and accessible digital solutions.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-5 pt-5"  style="background-color: #f8f9fa;">

    <!-- CORE VALUES -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Core Values</h2>
                <p class="text-muted fs-5">
                    The guiding principles of the Municipal Assessor System ensure transparency, efficiency, and service excellence, empowering both municipal staff and citizens.
                </p>
            </div>

            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm rounded-4 p-4" 
                         style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 10px rgba(0,0,0,0.05)';">
                        <div class="mb-3 mx-auto" 
                             style="width:60px; height:60px; background: linear-gradient(135deg, #4facfe, #00f2fe); border-radius:50%; display:flex; align-items:center; justify-content:center;">
                            <i class="ri-shield-check-line fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Transparency</h5>
                        <p class="text-muted small">
                            We prioritize clear, open access to property data, ensuring citizens and municipal staff can confidently understand, track, and utilize information. Transparency builds trust and accountability in every process we manage.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm rounded-4 p-4"
                         style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 10px rgba(0,0,0,0.05)';">
                        <div class="mb-3 mx-auto" 
                             style="width:60px; height:60px; background: linear-gradient(135deg, #43e97b, #38f9d7); border-radius:50%; display:flex; align-items:center; justify-content:center;">
                            <i class="ri-settings-3-line fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Efficiency</h5>
                        <p class="text-muted small">
                            By leveraging automation and streamlined workflows, we reduce manual tasks and minimize errors. This allows municipal teams to focus on strategic decisions while providing citizens faster, more reliable services.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm rounded-4 p-4"
                         style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 10px rgba(0,0,0,0.05)';">
                        <div class="mb-3 mx-auto" 
                             style="width:60px; height:60px; background: linear-gradient(135deg, #ff758c, #ff7eb3); border-radius:50%; display:flex; align-items:center; justify-content:center;">
                            <i class="ri-community-line fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Public Service</h5>
                        <p class="text-muted small">
                            Serving the community is at the heart of our mission. We support citizen-focused municipal services that are accountable, reliable, and designed to meet the evolving needs of the public efficiently.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MISSION & VISION -->
    <section class="container my-5 pb-5">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4"
                     style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 10px rgba(0,0,0,0.05)';">
                    <div class="d-flex align-items-center mb-3">
                        <span style="width:48px;height:48px; background: linear-gradient(135deg, #4facfe, #00f2fe); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:12px;">
                            <i class="ri-flag-line fs-4"></i>
                        </span>
                        <h4 class="fw-bold mb-0">Our Mission</h4>
                    </div>
                    <p class="text-muted">
                        To equip municipalities with a robust digital platform that simplifies property assessment, ensures data accuracy, and promotes full transparency. Our mission is to create secure, efficient, and user-friendly workflows that empower municipal staff and enhance citizen trust.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4"
                     style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.15)';"
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 10px rgba(0,0,0,0.05)';">
                    <div class="d-flex align-items-center mb-3">
                        <span style="width:48px;height:48px; background: linear-gradient(135deg, #4facfe, #00f2fe); color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:12px;">
                            <i class="ri-eye-line fs-4"></i>
                        </span>
                        <h4 class="fw-bold mb-0">Our Vision</h4>
                    </div>
                    <p class="text-muted">
                        To create a fully digital, transparent, and accessible municipal property assessment ecosystem. We envision a future where local governments can deliver faster, smarter, and more responsive public services, enhancing community development and citizen satisfaction.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

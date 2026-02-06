@extends('layouts/homelayout' )

@section('title', 'Contact Us Page')

@section('content')
<header class="container-fluid py-5">
    <h1 class="fw-bold text-center">Contact Us</h1>
</header>
<section class="container">
    <div class="py-5">
        <div class="row">
            <div class="col-md-12 col-lg-6 d-flex align-items-center mb-5">
                <div class="w-100 px-4 px-lg-5">

                    <h2 class="fw-bold mb-3 text-center">
                        You Will Be Assisted Properly
                    </h2>

                    <p class="text-muted mb-5 text-center">
                        The Municipal Assessor’s Office is committed to providing accurate
                        property assessment services and responsive public assistance.
                    </p>

                    <div class="row g-4">
                        <!-- Phone -->
                        <div class="col-6">
                            <div class="text-center">
                                <i class="ri-phone-fill fs-2 text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Call for Inquiry</h6>
                                <small class="text-muted">+63 912 345 6789</small>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-6">
                            <div class="text-center">
                                <i class="ri-mail-fill fs-2 text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Send us Email</h6>
                                <small class="text-muted">assessor@municipality.gov.ph</small>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div class="col-6">
                            <div class="text-center">
                                <i class="ri-time-fill fs-2 text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Opening Hours</h6>
                                <small class="text-muted">Mon – Fri: 8AM – 5PM</small>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-6">
                            <div class="text-center">
                                <i class="ri-map-pin-fill fs-2 text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Office</h6>
                                <small class="text-muted">
                                    Municipal Hall<br>
                                    Assessor’s Office - Brgy. Poblacion, Inopacan, Philippines, 6522
                                </small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                <div class="card p-5 rounded shadow-xl">
                    <h3 class="text-center mt-5 fw-bolder">Contact Info</h3>
                    <div class="row px-sm-1">
                        <div class="col-md-6 mt-2">
                            <label for="firstname" class="fw-bolder text-black mb-2">First Name</label>
                            <input type="text" class="form-control" placeholder="Your name">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="lastname" class="fw-bolder text-black mb-2">Last Name</label>
                            <input type="text" class="form-control" placeholder="Your last name">
                        </div>
                    </div>
                    <div class="row px-sm-1 pt-4">
                        <div class="col-md-12 mt-2">
                            <label for="email" class="fw-bolder text-black mb-2">Email</label>
                            <input type="text" class="form-control" placeholder="Your E-mail address">
                        </div>
                    </div>
                    <div class="row px-sm-1 pt-4">
                        <div class="col-md-12 mt-2">
                            <label for="message" class="fw-bolder text-black mb-2">Message</label>
                            <textarea name="Your Message" class="form-control no-resize" style="resize: none;" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row px-0 px-md-2 pt-5">
                        <div class="col d-flex align-items-center">
                            <button class=" btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container my-4">
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
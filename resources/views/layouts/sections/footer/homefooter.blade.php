<footer class="bg-white text-white py-4 mt-5">
    <div class="container mb-4">
        <div class="row">
            <!-- About -->
            <div class="col-lg-4 col-md-6 mb-3">
                <h6 class="text-dark mb-3">Municipal Assessor System</h6>
                <p class="text-muted small mb-2">
                    A comprehensive assessment platform for managing real property records,
                    valuations, and taxation data with accuracy and transparency.
                </p>
                <p class="text-muted small mb-0">
                    Serving the public with integrity. Driven by data.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 col-md-6 mb-3">
                <h6 class="text-dark mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('landing-page') }}" class="text-muted text-decoration-none">Home</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('services-page') }}" class="text-muted text-decoration-none">Services</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about-page') }}" class="text-muted text-decoration-none">About</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact-page') }}" class="text-muted text-decoration-none">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- System Access -->
            <div class="col-lg-4 col-md-6 mb-3">
                <h6 class="text-dark mb-3">Download Our App</h6>
                <p class="text-muted small mb-0">
                    Mobile app coming soon. Stay tuned for updates.
                </p>
            </div>
        </div>
    </div>

    <div class="border border-muted my-3"></div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
            <p class="mb-0 text-muted">
                &copy; {{ date('Y') }} Municipal Assessor System. All rights reserved.
            </p>
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="ri-global-line fs-5"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="ri-mail-line fs-5"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="text-decoration-none text-muted">
                        <i class="ri-phone-line fs-5"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>

@extends('home.layout')

@section('content')
<div class="container py-5">

    <!-- HERO -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="fw-bold mb-3">
                LiteERP
            </h1>
            <p class="lead text-muted">
                A lightweight, flexible ERP platform designed for small and medium businesses.
            </p>

            <ul class="text-muted">
                <li>Quick setup, no complex configuration</li>
                <li>Manage sales, inventory, and customers</li>
                <li>Modular architecture, easy to scale</li>
            </ul>

            <div class="mt-4">
                <a href="{{ url('/dashboard/login') }}" class="btn btn-primary me-2">
                    Get Started
                </a>
                <a href="https://github.com/liteerp-oss/liteerp/tree/dev/docs" target="_blank" class="btn btn-outline-secondary">
                    Documentation
                </a>
            </div>
        </div>

        <div class="col-md-6 text-center">
            <img 
                src="/assets/logo-full.png" 
                class="img-fluid rounded shadow"
                alt="LiteERP Dashboard"
            >
        </div>
    </div>

    <!-- FEATURES -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Lightweight & Fast</h5>
                    <p class="card-text text-muted">
                        Optimized for performance and runs smoothly on minimal infrastructure.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Modular System</h5>
                    <p class="card-text text-muted">
                        Enable only the modules you need. No unnecessary complexity.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Easy Integration</h5>
                    <p class="card-text text-muted">
                        Clean APIs for seamless integration with external services.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

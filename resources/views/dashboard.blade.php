@extends('layouts.app')

@section('content')
    <!-- [ breadcrumb ] start -->
    <x-breadcrumb title="{{ $pageTitle }}" :links="[
        'Dashboard' => route('dashboard'),
        $pageTitle => '#',
    ]" />
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Selamat Datang {{ auth()->user()->name }} </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                    <h4 class="mb-3">{{ $user }} </h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Rule</h6>
                    <h4 class="mb-3">{{ $role }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Proses Comparison</h6>
                    <h4 class="mb-3">{{ $comparison }}</h4>
                </div>
            </div>
        </div>


    </div>
@endsection
@pushOnce('scripts')
    <script src="{{ asset('/') }}assets/js/plugins/apexcharts.min.js"></script>
    <script src="{{ asset('/') }}assets/js/pages/dashboard-default.js"></script>
@endPushOnce

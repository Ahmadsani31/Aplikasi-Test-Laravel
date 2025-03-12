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
        <div class="col-sm-12">
            <div class="mb-4">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="mb-4">
                @include('profile.partials.update-password-form')
            </div>
            <div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection

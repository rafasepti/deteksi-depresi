{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.pasien.app')
@section('header')
    <div class="page-header min-height-400"
        style="background-image: url('{{ asset('assets/pasien') }}/assets/img/city-profile.jpg');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-8"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mx-auto my-auto">
                    <h3 class="text-white">Profile</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- START Testimonials w/ user image & text & info -->
    <section class="py-sm-7 py-5 position-relative">
        <div class="container">
            @include('profile.partials.update-profile-information-form')
        </div>
    </section>
    <!-- END Testimonials w/ user image & text & info -->
    <!-- START Blogs w/ 4 cards w/ image & text & link -->
    <section class="py-3">
        <div class="container">
            @include('profile.partials.update-password-form')
        </div>
    </section>
    <!-- END Blogs w/ 4 cards w/ image & text & link -->
@endsection

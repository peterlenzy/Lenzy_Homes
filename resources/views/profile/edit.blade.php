@extends('dashboard')
@section('title', 'Edit Profile')
@section('content')
<div id="app-content">
<x-app-layout>
<div class="card">
    <div class="p-4 sm:p-8 bg-gray shadow sm:rounded-lg py-12 ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="mb-3 text-center">
            <label for="avatarUpload" class="block text-sm font-medium text-gray-700">Profile Image</label>
            <div class="flex flex-col items-center">
                <div class="text-center my-3">
                <img id="profilePreview" src="{{ auth()->user()->img_path ? asset(auth()->user()->img_path) : '' }}"
                class="rounded-circle" width="120" height="120" style="object-fit: cover;" alt="Profile Image">
               <form method="post" action="{{route('profile_img')}}" enctype="multipart/form-data">
               @csrf
               <input type="file" name="image" id="imageInput" class="form-control mt-2" accept="image/*">
               <button type="submit"id="imageUploadFormBtn" class="btn btn-primary">save</button>
              </form>
              </div>

            </div>
        </div>
    </div>
    </div>
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
</div>
</x-app-layout>
</div>

@endsection

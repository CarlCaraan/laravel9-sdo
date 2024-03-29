@extends('user.user_master')

@section('title') Profile | Division of Laguna @endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container mt-2">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Account Info</h2>
            <ol>
                <li><a href="{{ route('user.welcome') }}">Home</a></li>
                <li>Account Info</li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs Section -->

<!-- Start Content -->
<section class="inner-page pt-4">
    <div class="container">
        <div class="section-header">
            <h2>Account Info</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header py-3 bg-white border-bottom">
                        <a href="{{ route('user.profile.edit') }}" class="btn custom-btn">Go to Account Settings</a>
                        <!-- <small class="text-muted float-end mt-2">Last Updated: {{ date('d-m-Y', strtotime($user->updated_at)) }}</small> -->
                        <small class="text-muted float-end mt-2 leftcard__headings--mobile">Last Updated: {{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</small>
                    </div>
                    <div class="card-body px-4 pt-4 pb-5">
                        <h4 class="mb-4 color-primary"><i class="fas fa-address-card"></i> Basic Information</h4>
                        <div class="avatar avatar-xl me-3 mb-3">
                            @if (!empty($user->profile_photo_path))
                            <img class="img-fluid rounded mb-2" data-bs-toggle="modal" data-bs-target="#showImage" style="width: 80px; height: 80px; cursor:zoom-in;" src="{{ url('upload/user_images/'.$user->profile_photo_path) }}" alt="Profile Photo">
                            @else
                            <br>
                            <span class="avatar-content bg-light shadow-sm rounded p-4">{{ substr($user->first_name,0,1) . substr($user->last_name,0,1)}}</span>
                            <br><br>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name" class="form-label fw-bold">First Name</label>
                                    <input class="form-control" type="text" disabled value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name" class="form-label fw-bold">Last Name</label>
                                    <input class="form-control" type="text" disabled value="{{ $user->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input class="form-control" type="text" disabled value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gender" class="form-label fw-bold">Gender</label>
                                    <input class="form-control" type="text" disabled value="{{ $user->gender }}" placeholder="Set your Gender">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="created_at" class="form-label fw-bold">Joined</label>
                                    <input class="form-control" type="text" disabled value="{{ date('d-m-Y', strtotime($user->created_at)) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Content -->

<!-- Show Profile Photo Modal -->
<div class="modal" id="showImage" tabindex="-1" aria-labelledby="showImage" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body center">
                <img class="img-fluid" src="{{ url('upload/user_images/'.$user->profile_photo_path) }}" alt="Profile Photo">
            </div>
        </div>
    </div>
</div>
@endsection
@extends('backend.layouts.user_master')
@section('title', __('Dashboard'))
@section('content')
    <x-admin.page-header title="{{ __('Dashboard') }}" icon="home" />

    <div class="row">
        <div class="col-sm-6 mb-3">
            <a href="/user/edit_profile" class="dashboard-action-card">
                <div class="card-body bg-midnight-bloom text-white text-center">
                    <i class="fa fa-user fa-3x mb-3"></i>
                    <h6>{{ __('Edit Profile') }}</h6>
                </div>
            </a>
        </div>
        <div class="col-sm-6 mb-3">
            <a href="/user/change_password" class="dashboard-action-card">
                <div class="card-body bg-arielle-smile text-white text-center">
                    <i class="fa fa-lock fa-3x mb-3"></i>
                    <h6>{{ __('Change Password') }}</h6>
                </div>
            </a>
        </div>
        <div class="col-sm-6 mb-3">
            <a href="/user_login/logout" class="dashboard-action-card">
                <div class="card-body bg-grow-early text-white text-center">
                    <i class="fa fa-sign-out-alt fa-3x mb-3"></i>
                    <h6>{{ __('Logout') }}</h6>
                </div>
            </a>
        </div>
    </div>
@endsection

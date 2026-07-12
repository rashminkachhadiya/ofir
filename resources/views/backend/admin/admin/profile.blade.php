@extends('backend.layouts.master')
@section('title', __('Admin Profile'))
@section('content')
    <x-admin.page-header title="{{ __('Admin Profile') }}" icon="user">
        <x-slot name="actions">
            <a href="{{ URL::to('/admin/edit_profile') }}" class="btn btn-success">
                <i class="fa fa-edit"></i> {{ __('Edit Profile') }}
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="row">
        <div class="col-lg-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless profile-table">
                            <tbody>
                            <tr>
                                <td class="subject">{{ __('Name') }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="subject">{{ __('Email') }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="subject">{{ __('Status') }}</td>
                                <td>
                                    @if($user->status)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

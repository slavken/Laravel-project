@extends('layouts.app')

@section('title', __('home.settings'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <a href="{{ route('home.index') }}" class="text-dark">
                                <i class="fas fa-user border rounded-circle p-3"></i>
                            </a>
                            <h3>{{ Auth::user()->name }}</h3>
                        </div>
                        <div class="list-group">
                            <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.dashboard') }}</a>
                            <a href="{{ route('home.posts') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.my_posts') }}</a>
                            <a href="{{ route('home.comments') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.my_comments') }}</a>
                            <a href="#" class="list-group-item list-group-item-action border-0 rounded active">{{ __('home.settings') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 order-md-1">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">{{ __('home.settings') }}</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <h5>Your account: {{ Auth::user()->name }}</h5>
                            <h5>Email: {{ Auth::user()->email }}</h5>
                        </div>

                        <a href="{{ route('home.email') }}" class="btn btn-primary mt-2 mt-sm-0 mr-2">{{ __('home.change_email') }}</a>
                        <a href="{{ route('home.username') }}" class="btn btn-primary mt-2 mt-sm-0 mr-2">{{ __('home.change_username') }}</a>
                        <a href="{{ route('home.password') }}" class="btn btn-primary mt-2 mt-sm-0">{{ __('home.change_password') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

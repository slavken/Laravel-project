@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card mb-4">
                    <h5 class="card-header">{{ __('home.cache') }}</h5>

                    <div class="card-body">
                        <div class="table-responsive mb-2">
                            <table class="table table-borderless table-hover table-dark">
                                <thead>
                                    <tr class="align-items-center">
                                        <th scope="col">Key</th>
                                        <th scope="col" class="text-center">Busy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $name => $key)
                                        <tr>
                                            <td scope="row">{{ $name }}</td>
                                            <td class="bg-{{ Cache::tags($name)->has($key) ? 'danger' : 'success' }} text-center">
                                                @if (Cache::tags($name)->has($key))
                                                    <a href="{{ route('cache.clear', [$name, $key]) }}" class="btn btn-success">Clear</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ route('cache.clear') }}" class="btn btn-lg d-block btn-primary">Clear cache</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <a href="{{ route('home.index') }}" class="text-dark mr-2">
                                <i class="fas fa-user p-3 border rounded-circle"></i>
                            </a>
                            <h3>{{ Auth::user()->name }}</h3>
                        </div>
                        <div class="list-group">
                            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.dashboard') }}</a>
                            <a href="{{ route('admin.posts') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.posts') }}</a>
                            <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.users') }}</a>
                            @can('categories')
                                <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.categories') }}</a>
                            @endcan
                            <a href="{{ route('comments.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.comments') }}</a>
                            <a href="#" class="list-group-item list-group-item-action border-0 rounded active">{{ __('home.cache') }}</a>
                            @can('roles')
                                <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.roles') }}</a>
                            @endcan
                            @can('permissions')
                                <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.permissions') }}</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

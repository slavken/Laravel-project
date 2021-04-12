@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header">Edit comment</h5>

                    <div class="card-body">
                        <h5>User: {{ $comment->user->name ?? 'guest' }}</h5>

                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="body">Comment:</label>
                                <input type="text" class="form-control form-control-lg @error('body') is-invalid @enderror" id="body" name="body" value="{{ $comment->body }}" required autofocus>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-lg btn-block btn-primary">Edit</button>
                        </form>
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
                            <a href="{{ route('comments.index') }}" class="list-group-item list-group-item-action border-0 rounded active">{{ __('home.comments') }}</a>
                            @can('cache')
                                <a href="{{ url('admin/cache') }}" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                            @endcan
                            @can('roles')
                                <a href="{{ url('admin/roles') }}" class="list-group-item list-group-item-action border-0 rounded">Roles</a>
                            @endcan
                            @can('permissions')
                                <a href="{{ url('admin/permissions') }}" class="list-group-item list-group-item-action border-0 rounded">Permissions</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

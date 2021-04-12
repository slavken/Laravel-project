@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-3">
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
                            <a href="#" class="list-group-item list-group-item-action border-0 rounded active">{{ __('home.categories') }}</a>
                            <a href="{{ route('comments.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.comments') }}</a>
                            @can('cache')
                                <a href="{{ route('cache.index') }}" class="list-group-item list-group-item-action border-0 rounded">Cache</a>
                            @endcan
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

            <div class="col-md-8 order-md-1">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card mb-4">
                    <h5 class="card-header d-flex align-items-center justify-content-between">
                        {{ __('home.categories') }}
                        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">
                            Add a category
                        </a>
                    </h5>

                    <div class="card-body">
                        @if ($categories->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->{'name_' . app()->currentLocale()} }}</td>
                                                <td>{{ $category->color }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center my-1">
                                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-light mr-2 border">Edit</a>
                                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $categories->links() }}
                            </div>
                        @else
                            <span class="text-danger">{{ __('interface.not_found') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', __('home.my_posts'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <a href="{{ route('home.index') }}" class="text-dark">
                                <i class="fas fa-user p-3 border rounded-circle"></i>
                            </a>
                            <h3>{{ Auth::user()->name }}</h3>
                        </div>
                        <div class="list-group">
                            <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.dashboard') }}</a>
                            <a href="#" class="list-group-item list-group-item-action border-0 rounded active">{{ __('home.my_posts') }}</a>
                            <a href="{{ route('home.comments') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.my_comments') }}</a>
                            <a href="{{ route('home.settings') }}" class="list-group-item list-group-item-action border-0 rounded">{{ __('home.settings') }}</a>
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
                    <div class="card-header">{{ __('home.posts') }}</div>

                    <div class="card-body">
                        @if ($posts->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('home.post') }}</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Views</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <th>
                                                    <a href="{{ route('post.show', $post->alias) }}" class="text-dark">
                                                        {{ Str::limit($post->{'title_' . app()->currentLocale()}, 30) }}
                                                    </a>
                                                </th>
                                                <td class="text-center">{{ $post->created_at->diffForHumans() }}</td>
                                                <td class="text-center">{{ $post->views }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-light mr-2 border">Edit</a>
                                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
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
                                {{ $posts->links() }}
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

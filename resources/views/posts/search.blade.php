@extends('layouts.default')

@section('title', __('interface.search'))

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h4>{{ __('interface.search') }}</h4>

            @if ($posts->isNotEmpty())
                <div class="mb-3">Results: {{ $posts->total() }}</div>
            @endif

            @if ($posts->isEmpty())
                <span>{{ __('interface.not_found') }}</span>
            @else
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-12 col-md-6">
                            <div class="card border-0 mb-4">
                                <a href="{{ route('post.show', $post->alias) }}">
                                    <img class="card-img round" src="{{ $post->img ? asset($post->img) : asset('img/default.png') }}" alt="Card image cap">
                                </a>

                                <div class="card-body mt-2 text-center p-0">
                                    @if ($post->categories->isNotEmpty())
                                        <span class="mr-3">
                                            @foreach ($post->categories as $category)
                                                <a href="{{ route('category.show', $category->alias) }}" class="font-weight-bold mr-1 {{ $category->color ?? 'text-dark' }}" {{ $category->color ? 'style=color:' . $category->color : null }}>{{ $category->{'name_' . app()->currentLocale()} }}</a>
                                            @endforeach
                                        </span>
                                    @endif

                                    <small class="text-gray">
                                        <a class="text-nowrap text-decoration-none text-gray mr-3" href="{{ route('post.show', [$post->alias, '#comments']) }}">
                                            <i class="far fa-comment"></i>
                                            {{ $post->comments_count }}
                                        </a>
                                        <span class="text-nowrap">
                                            <i class="far fa-eye"></i>
                                            {{ $post->post_views->views }}
                                        </span>
                                    </small>
                                </div>

                                <h4 class="card-title mt-1">
                                    <a href="post/{{ $post->alias }}" class="text-dark">
                                        {{ $post->{'title_' . app()->currentLocale()} }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>

        @include('includes.sidebar')
    </div>

    <x-trending />
@endsection
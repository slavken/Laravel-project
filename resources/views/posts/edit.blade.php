@extends('layouts.default')

@section('title', __('interface.edit'))

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4">
            <h1 class="mb-4">{{ __('interface.edit') }}</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $post->{'title_' . app()->currentLocale()} }}" required>
                </div>
                <div class="form-group">
                    <label for="editor">Body</label>
                    <editor-component name="body" state="{{ $post->{'body_' . app()->currentLocale()} }}"></editor-component>
                </div>
                <div class="form-group">
                    @foreach ($categories as $category)
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="category-{{ $category->id }}" name="category[]" value="{{ $category->id }}" @if ($post->categories->pluck('name_' . app()->currentLocale())->contains($category->{'name_' . app()->currentLocale()})) checked @endif>
                                <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->{'name_' . app()->currentLocale()} }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <input type="file" accept="image/*" name="img">
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-success">{{ __('interface.edit') }}</button>
            </form>
        </div>

        @include('includes.sidebar')
    </div>
@endsection

@extends('layouts.backoffice')

@section('back_styles')
    @parent
    <style>
        textarea.form-control {
            min-height: 200px;
            max-height: 200px;
        }
        .dropzone {
            min-height: 200px;
            max-height: 200px;
        }
    </style>
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-12 pb-5">
            <div class="card mb-5">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.post.title_singular') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('backoffice.posts.update', [$post->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mt-3">
                                <label class="required" for="title">{{ trans('cruds.post.fields.title') }}</label>
                                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                                @if($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.title_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label class="required" for="slug">{{ trans('cruds.post.fields.slug') }}</label>
                                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" required>
                                @if($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.slug_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="categories">{{ trans('cruds.post.fields.category') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                                    @foreach($categories as $id => $category)
                                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $post->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('categories'))
                                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.category_helper') }}</span>
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="tags">{{ trans('cruds.post.fields.tag') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                                    @foreach($tags as $id => $tag)
                                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $post->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.tag_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label for="content">{{ trans('cruds.post.fields.content') }}</label>
                                <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content', $post->content) !!}</textarea>
                                @if($errors->has('content'))
                                    <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.content_helper') }}</span>
                            </div>
                            <div class="form-group col-md-9 mt-3">
                                <label for="excerpt">{{ trans('cruds.post.fields.excerpt') }}</label>
                                <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
                                @if($errors->has('excerpt'))
                                    <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.excerpt_helper') }}</span>
                            </div>
                            <div class="form-group col-md-3 mt-3">
                                <label for="featured_image">{{ trans('cruds.post.fields.featured_image') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                                </div>
                                @if($errors->has('featured_image'))
                                    <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.post.fields.featured_image_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12 mt-5">
                                <a class="btn btn-danger" href="{{ route('backoffice.posts.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                                <button class="btn btn-success" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('back_scripts')
    @parent
    @include('partials.backoffice.editorscript')
    @yield('back_partial_scripts')
@endsection

@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.contentPage.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('backoffice.posts.update', [$post->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentPage.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="categories">{{ trans('cruds.contentPage.fields.category') }}</label>
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
                    <span class="help-block">{{ trans('cruds.contentPage.fields.category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tags">{{ trans('cruds.contentPage.fields.tag') }}</label>
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
                    <span class="help-block">{{ trans('cruds.contentPage.fields.tag_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="content">{{ trans('cruds.contentPage.fields.content') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content', $post->content) !!}</textarea>
                    @if($errors->has('content'))
                        <span class="text-danger">{{ $errors->first('content') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentPage.fields.content_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
                    <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @if($errors->has('excerpt'))
                        <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentPage.fields.excerpt_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                    </div>
                    @if($errors->has('featured_image'))
                        <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentPage.fields.featured_image_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('back_scripts')
    @parent
    <script>

        $(document).ready(function () {
            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        //extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>


    @yield('back_partial_scripts')
@endsection

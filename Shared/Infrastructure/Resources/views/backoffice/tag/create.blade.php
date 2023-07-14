@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.tag.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("backoffice.tags.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.tag.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.tag.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="slug">{{ trans('cruds.tag.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                    @if($errors->has('slug'))
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.tag.fields.slug_helper') }}</span>
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
    @yield('back_partial_scripts')
@endsection

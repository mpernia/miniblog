@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 pt-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('backoffice.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4 mt-3">
                                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="slug">{{ trans('cruds.category.fields.slug') }}</label>
                                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                                @if($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.slug_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="parent_id">{{ trans('cruds.category.fields.parent') }}</label>
                                <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id">
                                    @foreach($parents as $id => $entry)
                                        <option value="{{ $id }}" {{ old('parent_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('parent'))
                                    <span class="text-danger">{{ $errors->first('parent') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.category.fields.parent_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12 mt-5">
                                <a class="btn btn-danger" href="{{ route('backoffice.categories.index') }}">
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
    @yield('back_partial_scripts')
@endsection

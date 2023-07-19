@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 pt-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("backoffice.roles.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mt-3">
                                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                @if($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                                    @foreach($permissions as $id => $permission)
                                        <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('permissions'))
                                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                            </div>
                            <div class="form-group col-md-12 mt-5">
                                <a class="btn btn-danger" href="{{ route('backoffice.roles.index') }}">
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

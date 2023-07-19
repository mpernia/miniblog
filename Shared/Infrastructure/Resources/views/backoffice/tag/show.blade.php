@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 pt-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.tag.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('backoffice.tags.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.tag.fields.id') }}
                                </th>
                                <td>
                                    {{ $tag->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.tag.fields.name') }}
                                </th>
                                <td>
                                    {{ $tag->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.tag.fields.slug') }}
                                </th>
                                <td>
                                    {{ $tag->slug }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group mt-5">
                            <a class="btn btn-danger" href="{{ route('backoffice.tags.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('back_scripts')
    @parent
    @yield('back_partial_scripts')
@endsection

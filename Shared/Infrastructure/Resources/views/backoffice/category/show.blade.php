@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 pt-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.category.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('backoffice.categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.category.fields.id') }}
                                </th>
                                <td>
                                    {{ $category->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.category.fields.name') }}
                                </th>
                                <td>
                                    {{ $category->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.category.fields.slug') }}
                                </th>
                                <td>
                                    {{ $category->slug }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.category.fields.parent') }}
                                </th>
                                <td>
                                    {{ $category->parent_name ?? '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-danger" href="{{ route('backoffice.categories.index') }}">
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

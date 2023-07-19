@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 pt-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('backoffice.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id') }}
                                </th>
                                <td>
                                    {{ $user->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.roles') }}
                                </th>
                                <td>
                                    @foreach($user->roles as $key => $roles)
                                        <span class="label label-info">{{ $roles->title }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-danger" href="{{ route('backoffice.users.index') }}">
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

@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <h2 class="h3">Permissions</h2>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.permission.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-permission">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.permission.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.permission.fields.title') }}
                        </th>
                        <th class="td-action">
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $key => $permission)
                        <tr data-entry-id="{{ $permission->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $permission->id ?? '' }}
                            </td>
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>
                            <td>
                                @can('permission_show')
                                    <a class="btn btn-xs btn-primary btn-action" href="{{ route('admin.permissions.show', $permission->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('permission_edit')
                                    <a class="btn btn-xs btn-info btn-action" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('permission_delete')
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger btn-action" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('back_scripts')
    @parent
    <script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    @can('permission_create')
        let createButtonTrans = '{{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}';
        let createButton = {
        text: createButtonTrans,
        className: ['btn-success', 'btn', 'btn-datatable-action'],
        action: function (){
        $(location).attr('href',"{{ route('backoffice.permissions.create') }}");
        }
        }
        dtButtons.push(createButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    });
    let table = $('.datatable-permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
    .columns.adjust();
    });

    })

    </script>
    @yield('back_partial_scripts')
@endsection

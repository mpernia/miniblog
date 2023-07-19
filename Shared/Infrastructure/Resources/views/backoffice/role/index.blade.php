@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <h2 class="h3">Roles</h2>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
        </div>
        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Role">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.role.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.role.fields.permissions') }}
                    </th>
                    <th class="td-action">
                        &nbsp;
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('back_scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            {{-- @can('role_create') --}}
            let createButtonTrans = '{{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}';
            let createButton = {
                text: createButtonTrans,
                className: ['btn-success', 'btn', 'btn-datatable-action'],
                action: function (){
                    $(location).attr('href',"{{ route('backoffice.roles.create') }}");
                }
            }
            dtButtons.push(createButton);
            {{-- @endcan --}}

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('backoffice.roles.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder', visible:false },
                    { data: 'title', name: 'title' },
                    { data: 'permissions', name: 'permissions.description' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'asc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Role').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
    @yield('back_partial_scripts')
@endsection

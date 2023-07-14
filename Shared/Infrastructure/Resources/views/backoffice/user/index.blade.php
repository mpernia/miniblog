@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <h2 class="h3">Users</h2>
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email_verified_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.verified') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
                    </th>
                    <th>
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            {{-- @can('user_create') --}}
            let createButtonTrans = '{{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}';
            let createButton = {
                text: createButtonTrans,
                className: ['btn-success', 'btn', 'btn-datatable-action'],
                action: function (){
                    $(location).attr('href',"{{ route('backoffice.users.create') }}");
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
                ajax: "{{ route('backoffice.users.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'email_verified_at', name: 'email_verified_at' },
                    { data: 'verified', name: 'verified' },
                    { data: 'roles', name: 'roles.title' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'asc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
    @yield('back_partial_scripts')
@endsection

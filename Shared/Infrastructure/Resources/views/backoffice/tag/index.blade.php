@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <h2 class="h3">Tags</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 my-5 pt-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.tag.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="card-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-tag">
                        <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.tag.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.tag.fields.slug') }}
                            </th>
                            <th class="td-action">
                                &nbsp;
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('back_scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            {{-- @can('tag_create') --}}
            let createButtonTrans = '{{ trans('global.add') }} {{ trans('cruds.tag.title_singular') }}';
            let createButton = {
                text: createButtonTrans,
                className: ['btn-success', 'btn', 'btn-datatable-action'],
                action: function (){
                    $(location).attr('href',"{{ route('backoffice.tags.create') }}");
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
                ajax: "{{ route('backoffice.tags.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder', visible:false },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'asc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-tag').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
    @yield('back_partial_scripts')
@endsection

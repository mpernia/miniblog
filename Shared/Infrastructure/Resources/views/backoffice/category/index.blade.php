@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <h2 class="h3">Categories</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.category.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-category">
                        <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.category.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.category.fields.slug') }}
                            </th>
                            <th>
                                {{ trans('cruds.category.fields.parent') }}
                            </th>
                            <th class="td-action">
                                &nbsp;
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach($categories as $key => $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>

                            </td>
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
            {{-- @can('category_create') --}}
            let createButtonTrans = '{{ trans('global.add') }} {{ trans('cruds.category.title_singular') }}';
            let createButton = {
                text: createButtonTrans,
                className: ['btn-success', 'btn', 'btn-datatable-action'],
                action: function (){
                    $(location).attr('href',"{{ route('backoffice.categories.create') }}");
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
                ajax: "{{ route('backoffice.categories.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder', visible:false },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'parent_name', name: 'parent.name' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'asc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-category').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false;
                let value = strict && this.value ? "^" + this.value + "$" : this.value;
                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index];
                }
                table
                    .column(index)
                    .search(value, strict)
                    .draw();
            });
            table.on('column-visibility.dt', function(e, settings, column, state) {
                visibleColumnsIndexes = [];
                table.columns(":visible").every(function(colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        });

    </script>
    @yield('back_partial_scripts')
@endsection

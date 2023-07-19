@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <h2 class="h3">Posts</h2>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.post.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-post">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.post.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.post.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.post.fields.tag') }}
                    </th>
                    <th>
                        {{ trans('cruds.post.fields.excerpt') }}
                    </th>
                    <th>
                        {{ trans('cruds.post.fields.featured_image') }}
                    </th>
                    <th>
                        {{ trans('cruds.post.fields.created_at') }}
                    </th>
                    <th class="td-action">
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($categories as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($tags as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
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

            {{-- @can('post_create') --}}
                let createButtonTrans = '{{ trans('global.add') }} {{ trans('cruds.post.title_singular') }}';
                let createButton = {
                    text: createButtonTrans,
                    className: ['btn-success', 'btn', 'btn-datatable-action'],
                    action: function (){
                        $(location).attr('href',"{{ route('backoffice.posts.create') }}");
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
                ajax: "{{ route('backoffice.posts.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder', visible:false },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'categories.name' },
                    { data: 'tag', name: 'tags.name' },
                    { data: 'excerpt', name: 'excerpt' },
                    { data: 'featured_image', name: 'featured_image', sortable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 6, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-post').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index]
                }
                table.column(index).search(value, strict).draw();
            });
            table.on('column-visibility.dt', function(e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function(colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        });

    </script>
    @yield('back_partial_scripts')
@endsection

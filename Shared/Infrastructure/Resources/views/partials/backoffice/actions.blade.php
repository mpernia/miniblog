{{-- @can($viewGate) --}}
    <a class="btn btn-xs btn-primary btn-action" href="{{ route('backoffice.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
{{-- @endcan
@can($editGate) --}}
    <a class="btn btn-xs btn-info btn-action" href="{{ route('backoffice.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
{{-- @endcan
@can($deleteGate) --}}
    <form action="{{ route('backoffice.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger btn-action" value="{{ trans('global.delete') }}">
    </form>
{{-- @endcan --}}

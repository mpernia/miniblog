@extends('layouts.backoffice')

@section('back_styles')
    @parent
@endsection

@section('back_content')
    <div class="row justify-content-center">
        <div class="col-md-12 pb-5">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.post.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('backoffice.posts.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.id') }}
                                </th>
                                <td>
                                    {{ $post->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.title') }}
                                </th>
                                <td>
                                    {{ $post->title }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.slug') }}
                                </th>
                                <td>
                                    {{ $post->slug }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.category') }}
                                </th>
                                <td>
                                    @foreach($post->categories as $key => $category)
                                        <span class="label label-info">{{ $category }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.tag') }}
                                </th>
                                <td>
                                    @foreach($post->tags as $key => $tag)
                                        <span class="label label-info">{{ $tag }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.content') }}
                                </th>
                                <td>
                                    {!! $post->content !!}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.excerpt') }}
                                </th>
                                <td>
                                    {{ $post->excerpt }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.post.fields.featured_image') }}
                                </th>
                                <td>
                                    @if($post->featured_image)
                                        <a href="{{ $post->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $post->featured_image->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-danger" href="{{ route('backoffice.posts.index') }}">
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

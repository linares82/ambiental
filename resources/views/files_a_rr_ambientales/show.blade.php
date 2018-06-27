@extends('layouts.master1')

@section('content')
	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<a href="{{route('home')}}">
				<i class="ace-icon fa fa-home home-icon"></i>
				</a>
			</li>

			<li>
				<a href="{{ route('files_a_rr_ambientales.files_a_rr_ambientale.index') }}">{{ trans('files_a_rr_ambientales.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('files_a_rr_ambientales.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('files_a_rr_ambientales.files_a_rr_ambientale.destroy', $filesARrAmbientale->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('files_a_rr_ambientales.files_a_rr_ambientale.index')
                    <a href="{{ route('files_a_rr_ambientales.files_a_rr_ambientale.index') }}" class="btn btn-primary" title="{{ trans('files_a_rr_ambientales.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_rr_ambientales.files_a_rr_ambientale.create')
                    <a href="{{ route('files_a_rr_ambientales.files_a_rr_ambientale.create') }}" class="btn btn-success" title="{{ trans('files_a_rr_ambientales.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_rr_ambientales.files_a_rr_ambientale.edit')
                    <a href="{{ route('files_a_rr_ambientales.files_a_rr_ambientale.edit', $filesARrAmbientale->id ) }}" class="btn btn-primary" title="{{ trans('files_a_rr_ambientales.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('files_a_rr_ambientales.files_a_rr_ambientale.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('files_a_rr_ambientales.delete') }}" onclick="return confirm(&quot;{{ trans('files_a_rr_ambientales.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('files_a_rr_ambientales.a_rr_ambiental_id') }}</dt>
            <dd>{{ optional($filesARrAmbientale->aRrAmbientale)->descripcion }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.descripcion') }}</dt>
            <dd>{{ $filesARrAmbientale->descripcion }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.file_path') }}</dt>
            <dd>{{ $filesARrAmbientale->file_path }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.usu_alta_id') }}</dt>
            <dd>{{ optional($filesARrAmbientale->user)->name }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.usu_mod_id') }}</dt>
            <dd>{{ optional($filesARrAmbientale->user)->name }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.created_at') }}</dt>
            <dd>{{ $filesARrAmbientale->created_at }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.updated_at') }}</dt>
            <dd>{{ $filesARrAmbientale->updated_at }}</dd>
            <dt>{{ trans('files_a_rr_ambientales.deleted_at') }}</dt>
            <dd>{{ $filesARrAmbientale->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection
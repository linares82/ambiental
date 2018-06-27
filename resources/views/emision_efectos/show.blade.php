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
				<a href="{{ route('emision_efectos.emision_efecto.index') }}">{{ trans('emision_efectos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('emision_efectos.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('emision_efectos.emision_efecto.destroy', $emisionEfecto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('emision_efectos.emision_efecto.index')
                    <a href="{{ route('emision_efectos.emision_efecto.index') }}" class="btn btn-primary" title="{{ trans('emision_efectos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('emision_efectos.emision_efecto.create')
                    <a href="{{ route('emision_efectos.emision_efecto.create') }}" class="btn btn-success" title="{{ trans('emision_efectos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('emision_efectos.emision_efecto.edit')
                    <a href="{{ route('emision_efectos.emision_efecto.edit', $emisionEfecto->id ) }}" class="btn btn-primary" title="{{ trans('emision_efectos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('emision_efectos.emision_efecto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('emision_efectos.delete') }}" onclick="return confirm(&quot;{{ trans('emision_efectos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('emision_efectos.emision_efecto') }}</dt>
            <dd>{{ $emisionEfecto->emision_efecto }}</dd>
            <dt>{{ trans('emision_efectos.usu_alta_id') }}</dt>
            <dd>{{ optional($emisionEfecto->user)->name }}</dd>
            <dt>{{ trans('emision_efectos.usu_mod_id') }}</dt>
            <dd>{{ optional($emisionEfecto->user)->name }}</dd>
            <dt>{{ trans('emision_efectos.created_at') }}</dt>
            <dd>{{ $emisionEfecto->created_at }}</dd>
            <dt>{{ trans('emision_efectos.updated_at') }}</dt>
            <dd>{{ $emisionEfecto->updated_at }}</dd>
            <dt>{{ trans('emision_efectos.deleted_at') }}</dt>
            <dd>{{ $emisionEfecto->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection
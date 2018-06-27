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
				<a href="{{ route('ca_residuos.ca_residuo.index') }}">{{ trans('ca_residuos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('ca_residuos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ca_residuos.ca_residuo.destroy', $caResiduo->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ca_residuos.ca_residuo.index')
                    <a href="{{ route('ca_residuos.ca_residuo.index') }}" class="btn btn-primary" title="{{ trans('ca_residuos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_residuos.ca_residuo.create')
                    <a href="{{ route('ca_residuos.ca_residuo.create') }}" class="btn btn-success" title="{{ trans('ca_residuos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_residuos.ca_residuo.edit')
                    <a href="{{ route('ca_residuos.ca_residuo.edit', $caResiduo->id ) }}" class="btn btn-primary" title="{{ trans('ca_residuos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ca_residuos.ca_residuo.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ca_residuos.delete') }}" onclick="return confirm(&quot;{{ trans('ca_residuos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ca_residuos.residuo') }}</dt>
            <dd>{{ $caResiduo->residuo }}</dd>
            <dt>{{ trans('ca_residuos.unidad') }}</dt>
            <dd>{{ $caResiduo->unidad }}</dd>
            <dt>{{ trans('ca_residuos.peligroso') }}</dt>
            <dd>{{ $caResiduo->peligroso }}</dd>
            <dt>{{ trans('ca_residuos.usu_alta_id') }}</dt>
            <dd>{{ optional($caResiduo->user)->name }}</dd>
            <dt>{{ trans('ca_residuos.usu_mod_id') }}</dt>
            <dd>{{ optional($caResiduo->user)->name }}</dd>
            <dt>{{ trans('ca_residuos.created_at') }}</dt>
            <dd>{{ $caResiduo->created_at }}</dd>
            <dt>{{ trans('ca_residuos.updated_at') }}</dt>
            <dd>{{ $caResiduo->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection
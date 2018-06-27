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
				<a href="{{ route('ln_caracteristicas.ln_caracteristica.index') }}">{{ trans('ln_caracteristicas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('ln_caracteristicas.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('ln_caracteristicas.ln_caracteristica.destroy', $lnCaracteristica->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('ln_caracteristicas.ln_caracteristica.index')
                    <a href="{{ route('ln_caracteristicas.ln_caracteristica.index') }}" class="btn btn-primary" title="{{ trans('ln_caracteristicas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ln_caracteristicas.ln_caracteristica.create')
                    <a href="{{ route('ln_caracteristicas.ln_caracteristica.create') }}" class="btn btn-success" title="{{ trans('ln_caracteristicas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ln_caracteristicas.ln_caracteristica.edit')
                    <a href="{{ route('ln_caracteristicas.ln_caracteristica.edit', $lnCaracteristica->id ) }}" class="btn btn-primary" title="{{ trans('ln_caracteristicas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('ln_caracteristicas.ln_caracteristica.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('ln_caracteristicas.delete') }}" onclick="return confirm(&quot;{{ trans('ln_caracteristicas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('ln_caracteristicas.reg_impacto_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->lnImpacto)->created_at }}</dd>
            <dt>{{ trans('ln_caracteristicas.caracteristica_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->caracteristica)->caracteristica }}</dd>
            <dt>{{ trans('ln_caracteristicas.efecto_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->efecto)->efecto }}</dd>
            <dt>{{ trans('ln_caracteristicas.desc_efecto') }}</dt>
            <dd>{{ $lnCaracteristica->desc_efecto }}</dd>
            <dt>{{ trans('ln_caracteristicas.descripcion') }}</dt>
            <dd>{{ $lnCaracteristica->descripcion }}</dd>
            <dt>{{ trans('ln_caracteristicas.resarcion') }}</dt>
            <dd>{{ $lnCaracteristica->resarcion }}</dd>
            <dt>{{ trans('ln_caracteristicas.emision_efecto_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->emisionEfecto)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.duracion_accion_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->duracionAccion)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.continuidad_efecto_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->continuidadEfecto)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.reversibilidad_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->reversibilidad)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.probabilidad_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->probabilidad)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.mitigacion_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->mitigacion)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.intensidad_impacto_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->intensidadImpacto)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.imp_real_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->impReal)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.imp_potencial_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->impPotencial)->id }}</dd>
            <dt>{{ trans('ln_caracteristicas.usu_alta_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->user)->name }}</dd>
            <dt>{{ trans('ln_caracteristicas.usu_mod_id') }}</dt>
            <dd>{{ optional($lnCaracteristica->user)->name }}</dd>
            <dt>{{ trans('ln_caracteristicas.created_at') }}</dt>
            <dd>{{ $lnCaracteristica->created_at }}</dd>
            <dt>{{ trans('ln_caracteristicas.updated_at') }}</dt>
            <dd>{{ $lnCaracteristica->updated_at }}</dd>
            <dt>{{ trans('ln_caracteristicas.deleted_at') }}</dt>
            <dd>{{ $lnCaracteristica->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection
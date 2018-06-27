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
				<a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}">{{ trans('aspectos_ambientales.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('aspectos_ambientales.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('aspectos_ambientales.aspectos_ambientale.destroy', $aspectosAmbientale->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('aspectos_ambientales.aspectos_ambientale.index')
                    <a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}" class="btn btn-primary" title="{{ trans('aspectos_ambientales.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aspectos_ambientales.aspectos_ambientale.create')
                    <a href="{{ route('aspectos_ambientales.aspectos_ambientale.create') }}" class="btn btn-success" title="{{ trans('aspectos_ambientales.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aspectos_ambientales.aspectos_ambientale.edit')
                    <a href="{{ route('aspectos_ambientales.aspectos_ambientale.edit', $aspectosAmbientale->id ) }}" class="btn btn-primary" title="{{ trans('aspectos_ambientales.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aspectos_ambientales.aspectos_ambientale.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('aspectos_ambientales.delete') }}" onclick="return confirm(&quot;{{ trans('aspectos_ambientales.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('aspectos_ambientales.proceso_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->aaProceso)->proceso }}</dd>
            <dt>{{ trans('aspectos_ambientales.area_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->area)->area }}</dd>
            <dt>{{ trans('aspectos_ambientales.actividad') }}</dt>
            <dd>{{ $aspectosAmbientale->actividad }}</dd>
            <dt>{{ trans('aspectos_ambientales.descripcion') }}</dt>
            <dd>{{ $aspectosAmbientale->descripcion }}</dd>
            <dt>{{ trans('aspectos_ambientales.efecto') }}</dt>
            <dd>{{ $aspectosAmbientale->efecto }}</dd>
            <dt>{{ trans('aspectos_ambientales.aspecto_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->aaAspecto)->aspectos }}</dd>
            <dt>{{ trans('aspectos_ambientales.eme_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->aaEme)->eme }}</dd>
            <dt>{{ trans('aspectos_ambientales.condicion_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->aaCondicione)->condicion }}</dd>
            <dt>{{ trans('aspectos_ambientales.impacto_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->aaImpacto)->impacto }}</dd>
            <dt>{{ trans('aspectos_ambientales.puesto_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->puesto)->puesto }}</dd>
            <dt>{{ trans('aspectos_ambientales.al_federal_bnd') }}</dt>
            <dd>{{ optional($aspectosAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('aspectos_ambientales.al_estatal_bnd') }}</dt>
            <dd>{{ optional($aspectosAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('aspectos_ambientales.obj_corporativo_bnd') }}</dt>
            <dd>{{ optional($aspectosAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('aspectos_ambientales.quejas_bnd') }}</dt>
            <dd>{{ optional($aspectosAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('aspectos_ambientales.severidad_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->efecto)->efecto }}</dd>
            <dt>{{ trans('aspectos_ambientales.bnd_potencial') }}</dt>
            <dd>{{ optional($aspectosAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('aspectos_ambientales.frecuencia_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->duracionAccion)->duracion_accion }}</dd>
            <dt>{{ trans('aspectos_ambientales.bnd_real') }}</dt>
            <dd>{{ optional($aspectosAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('aspectos_ambientales.probabilidad_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->probabilidad)->probabilidad }}</dd>
            <dt>{{ trans('aspectos_ambientales.imp_potencial_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->impPotencial)->imp_potencial }}</dd>
            <dt>{{ trans('aspectos_ambientales.imp_real_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->impReal)->imp_real }}</dd>
            <dt>{{ trans('aspectos_ambientales.observaciones') }}</dt>
            <dd>{{ $aspectosAmbientale->observaciones }}</dd>
            <dt>{{ trans('aspectos_ambientales.ctrls_opracionales') }}</dt>
            <dd>{{ $aspectosAmbientale->ctrls_opracionales }}</dd>
            <dt>{{ trans('aspectos_ambientales.entity_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->entity)->rzon_social }}</dd>
            <dt>{{ trans('aspectos_ambientales.usu_alta_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->user)->name }}</dd>
            <dt>{{ trans('aspectos_ambientales.usu_mod_id') }}</dt>
            <dd>{{ optional($aspectosAmbientale->user)->name }}</dd>
            <dt>{{ trans('aspectos_ambientales.created_at') }}</dt>
            <dd>{{ $aspectosAmbientale->created_at }}</dd>
            <dt>{{ trans('aspectos_ambientales.updated_at') }}</dt>
            <dd>{{ $aspectosAmbientale->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
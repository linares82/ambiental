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
				<a href="{{ route('bitacora_ffs.bitacora_ff.index') }}">{{ trans('bitacora_ffs.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_ffs.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_ffs.bitacora_ff.destroy', $bitacoraFf->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_ffs.bitacora_ff.index')
                    <a href="{{ route('bitacora_ffs.bitacora_ff.index') }}" class="btn btn-primary" title="{{ trans('bitacora_ffs.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_ffs.bitacora_ff.create')
                    <a href="{{ route('bitacora_ffs.bitacora_ff.create') }}" class="btn btn-success" title="{{ trans('bitacora_ffs.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_ffs.bitacora_ff.edit')
                    <a href="{{ route('bitacora_ffs.bitacora_ff.edit', $bitacoraFf->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_ffs.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_ffs.bitacora_ff.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_ffs.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_ffs.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_ffs.ca_fuente_fija_id') }}</dt>
            <dd>{{ optional($bitacoraFf->caFuentesFija)->planta }}</dd>
            <dt>{{ trans('bitacora_ffs.fecha') }}</dt>
            <dd>{{ $bitacoraFf->fecha }}</dd>
            <dt>{{ trans('bitacora_ffs.turno_id') }}</dt>
            <dd>{{ optional($bitacoraFf->turno)->id }}</dd>
            <dt>{{ trans('bitacora_ffs.consumo') }}</dt>
            <dd>{{ $bitacoraFf->consumo }}</dd>
            <dt>{{ trans('bitacora_ffs.capacidad_diseno') }}</dt>
            <dd>{{ $bitacoraFf->capacidad_diseno }}</dd>
            <dt>{{ trans('bitacora_ffs.tp_gases') }}</dt>
            <dd>{{ $bitacoraFf->tp_gases }}</dd>
            <dt>{{ trans('bitacora_ffs.tp_chimenea') }}</dt>
            <dd>{{ $bitacoraFf->tp_chimenea }}</dd>
            <dt>{{ trans('bitacora_ffs.fec_ult_manto') }}</dt>
            <dd>{{ $bitacoraFf->fec_ult_manto }}</dd>
            <dt>{{ trans('bitacora_ffs.desc_manto') }}</dt>
            <dd>{{ $bitacoraFf->desc_manto }}</dd>
            <dt>{{ trans('bitacora_ffs.obs') }}</dt>
            <dd>{{ $bitacoraFf->obs }}</dd>
            <dt>{{ trans('bitacora_ffs.responsable_id') }}</dt>
            <dd>{{ optional($bitacoraFf->empleado)->nombre }}</dd>
            <dt>{{ trans('bitacora_ffs.entity_id') }}</dt>
            <dd>{{ optional($bitacoraFf->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_ffs.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraFf->user)->name }}</dd>
            <dt>{{ trans('bitacora_ffs.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraFf->user)->name }}</dd>
            <dt>{{ trans('bitacora_ffs.created_at') }}</dt>
            <dd>{{ $bitacoraFf->created_at }}</dd>
            <dt>{{ trans('bitacora_ffs.updated_at') }}</dt>
            <dd>{{ $bitacoraFf->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection
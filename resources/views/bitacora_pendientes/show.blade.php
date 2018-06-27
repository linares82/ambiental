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
				<a href="{{ route('bitacora_pendientes.bitacora_pendiente.index') }}">{{ trans('bitacora_pendientes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('bitacora_pendientes.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('bitacora_pendientes.bitacora_pendiente.destroy', $bitacoraPendiente->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('bitacora_pendientes.bitacora_pendiente.index')
                    <a href="{{ route('bitacora_pendientes.bitacora_pendiente.index') }}" class="btn btn-primary" title="{{ trans('bitacora_pendientes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_pendientes.bitacora_pendiente.create')
                    <a href="{{ route('bitacora_pendientes.bitacora_pendiente.create') }}" class="btn btn-success" title="{{ trans('bitacora_pendientes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_pendientes.bitacora_pendiente.edit')
                    <a href="{{ route('bitacora_pendientes.bitacora_pendiente.edit', $bitacoraPendiente->id ) }}" class="btn btn-primary" title="{{ trans('bitacora_pendientes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('bitacora_pendientes.bitacora_pendiente.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('bitacora_pendientes.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_pendientes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('bitacora_pendientes.pendiente') }}</dt>
            <dd>{{ $bitacoraPendiente->pendiente }}</dd>
            <dt>{{ trans('bitacora_pendientes.comentarios') }}</dt>
            <dd>{{ $bitacoraPendiente->comentarios }}</dd>
            <dt>{{ trans('bitacora_pendientes.observaciones') }}</dt>
            <dd>{{ $bitacoraPendiente->observaciones }}</dd>
            <dt>{{ trans('bitacora_pendientes.solucion') }}</dt>
            <dd>{{ $bitacoraPendiente->solucion }}</dd>
            <dt>{{ trans('bitacora_pendientes.fec_planeada') }}</dt>
            <dd>{{ $bitacoraPendiente->fec_planeada }}</dd>
            <dt>{{ trans('bitacora_pendientes.fec_fin') }}</dt>
            <dd>{{ $bitacoraPendiente->fec_fin }}</dd>
            <dt>{{ trans('bitacora_pendientes.aviso') }}</dt>
            <dd>{{ optional($bitacoraPendiente->bnd)->bnd }}</dd>
            <dt>{{ trans('bitacora_pendientes.dias_aviso') }}</dt>
            <dd>{{ $bitacoraPendiente->dias_aviso }}</dd>
            <dt>{{ trans('bitacora_pendientes.responsable_id') }}</dt>
            <dd>{{ optional($bitacoraPendiente->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('bitacora_pendientes.bit_st_id') }}</dt>
            <dd>{{ optional($bitacoraPendiente->bitSt)->id }}</dd>
            <dt>{{ trans('bitacora_pendientes.cia_id') }}</dt>
            <dd>{{ optional($bitacoraPendiente->entity)->rzon_social }}</dd>
            <dt>{{ trans('bitacora_pendientes.usu_alta_id') }}</dt>
            <dd>{{ optional($bitacoraPendiente->user)->name }}</dd>
            <dt>{{ trans('bitacora_pendientes.usu_mod_id') }}</dt>
            <dd>{{ optional($bitacoraPendiente->user)->name }}</dd>
            <dt>{{ trans('bitacora_pendientes.created_at') }}</dt>
            <dd>{{ $bitacoraPendiente->created_at }}</dd>
            <dt>{{ trans('bitacora_pendientes.updated_at') }}</dt>
            <dd>{{ $bitacoraPendiente->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection
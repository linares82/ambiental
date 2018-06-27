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
				<a href="{{ route('empleados.empleado.index') }}">{{ trans('empleados.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Empleado' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('empleados.empleado.destroy', $empleado->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('empleados.empleado.index')
                    <a href="{{ route('empleados.empleado.index') }}" class="btn btn-primary" title="{{ trans('empleados.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('empleados.empleado.create')
                    <a href="{{ route('empleados.empleado.create') }}" class="btn btn-success" title="{{ trans('empleados.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('empleados.empleado.edit')
                    <a href="{{ route('empleados.empleado.edit', $empleado->id ) }}" class="btn btn-primary" title="{{ trans('empleados.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('empleados.empleado.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('empleados.delete') }}" onclick="return confirm(&quot;{{ trans('empleados.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('empleados.ctrl_interno') }}</dt>
            <dd>{{ $empleado->ctrl_interno }}</dd>
            <dt>{{ trans('empleados.nombre') }}</dt>
            <dd>{{ $empleado->nombre }}</dd>
            <dt>{{ trans('empleados.direccion') }}</dt>
            <dd>{{ $empleado->direccion }}</dd>
            <dt>{{ trans('empleados.mail') }}</dt>
            <dd>{{ $empleado->mail }}</dd>
            <dt>{{ trans('empleados.contacto') }}</dt>
            <dd>{{ $empleado->contacto }}</dd>
            <dt>{{ trans('empleados.area_id') }}</dt>
            <dd>{{ optional($empleado->area)->id }}</dd>
            <dt>{{ trans('empleados.puesto_id') }}</dt>
            <dd>{{ optional($empleado->puesto)->puesto }}</dd>
            <dt>{{ trans('empleados.bnd_subordinados') }}</dt>
            <dd> @if(optional($empleado->bnd)->id==1)
                    Si
                @else
                    No
                @endif
            </dd>
            <dt>{{ trans('empleados.jefe_id') }}</dt>
            <dd>
                @if(optional($empleado->jefe)->id==1)
                    Si
                @else
                    No
                @endif
            </dd>
            <dt>{{ trans('empleados.user_id') }}</dt>
            <dd>{{ optional($empleado->user)->name }}</dd>
            <dt>{{ trans('empleados.entity_id') }}</dt>
            <dd>{{ optional($empleado->entity)->rzon_social }}</dd>
            <dt>{{ trans('empleados.usu_alta_id') }}</dt>
            <dd>{{ optional($empleado->user)->name }}</dd>
            <dt>{{ trans('empleados.usu_mod_id') }}</dt>
            <dd>{{ optional($empleado->user)->name }}</dd>
            <dt>{{ trans('empleados.created_at') }}</dt>
            <dd>{{ $empleado->created_at }}</dd>
            <dt>{{ trans('empleados.updated_at') }}</dt>
            <dd>{{ $empleado->updated_at }}</dd>
           

        </dl>

    </div>
</div>

@endsection
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
		</ul><!-- /.breadcrumb -->
	</div>

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
	
    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('empleados.model_plural') }}</h4>
            </div>
            
            @ifUserCan('empleados.empleado.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('empleados.empleado.create') }}" class="btn btn-success btn-xs" title="{{ trans('empleados.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            @endif
			<div class="btn-group btn-group-sm pull-right" role="group">
                <button id="search_btn" class="btn btn-warning btn-xs" title="Buscar">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
            </div>
			<div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('empleados.empleado.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($empleados) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('empleados.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('empleados.empleado.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
						<div class="form-group col-md-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                                                    <label for="nombre" class="control-label">{{ trans('empleados.nombre') }}</label>

                                                        <input class="form-control input-sm " name="nombre" type="text" id="nombre" value="{{ old('nombre') }}" minlength="1" maxlength="255" placeholder="{{ trans('empleados.nombre__placeholder') }}">
                                                        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}

                                                </div>
                                                <div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<input class="btn btn-info btn-app btn-xs" type="submit" value="Buscar">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="table-responsive">

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('empleados.entity_id') }}</th>
                            <th>{{ trans('empleados.ctrl_interno') }}</th>
                            <th>{{ trans('empleados.nombre') }}</th>
                            <th>{{ trans('empleados.mail') }}</th>
                            <th>{{ trans('empleados.area_id') }}</th>
                            <th>{{ trans('empleados.puesto_id') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->entity->abreviatura }}</td>
                            <td>{{ $empleado->ctrl_interno }}</td>
                            <td>{{ $empleado->nombre }}</td>
                            <td>{{ $empleado->mail }}</td>
                            <td>{{ optional($empleado->area)->area }}</td>
                            <td>{{ optional($empleado->puesto)->puesto }}</td>
                            <td>

                                <form method="POST" action="{!! route('empleados.empleado.destroy', $empleado->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('empleados.empleado.show')
                                        <a href="{{ route('empleados.empleado.show', $empleado->id ) }}" class="btn btn-info btn-xs" title="{{ trans('empleados.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('empleados.empleado.edit')
                                        <a href="{{ route('empleados.empleado.edit', $empleado->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('empleados.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('empleados.empleado.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('empleados.delete') }}" onclick="return confirm(&quot;{{ trans('empleados.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        @endif
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $empleados->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
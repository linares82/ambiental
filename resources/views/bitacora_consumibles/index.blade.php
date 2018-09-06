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
				<a href="{{ route('bitacora_consumibles.bitacora_consumible.index') }}">{{ trans('bitacora_consumibles.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('bitacora_consumibles.model_plural') }}</h4>
            </div>
            
            @ifUserCan('bitacora_consumibles.bitacora_consumible.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('bitacora_consumibles.bitacora_consumible.create') }}" class="btn btn-success btn-xs" title="{{ trans('bitacora_consumibles.create') }}">
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
                <a href="{{ route('bitacora_consumibles.bitacora_consumible.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($bitacoraConsumibles) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('bitacora_consumibles.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('bitacora_consumibles.bitacora_consumible.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('consumible_id') ? 'has-error' : '' }}">
                                                    <label for="consumible_id" class="control-label">{{ trans('bitacora_consumibles.consumible_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="consumible_id" name="consumible_id">
                                                                    <option value="" style="display: none;" {{ old('consumible_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_consumibles.consumible_id__placeholder') }}</option>
                                                                @foreach ($caConsumibles as $key => $caConsumible)
                                                                            <option value="{{ $key }}" {{ old('consumible_id') == $key ? 'selected' : '' }}>
                                                                                {{ $caConsumible }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('consumible_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>
                                                <div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
                                                    <label for="fecha" class="control-label">{{ trans('bitacora_consumibles.fecha') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha') }}" placeholder="{{ trans('bitacora_consumibles.fecha__placeholder') }}">
                                                        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
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
                            <th>{{ trans('bitacora_consumibles.consumible_id') }}</th>
                            <th>{{ trans('bitacora_consumibles.consumo') }}</th>
                            <th>{{ trans('bitacora_consumibles.fecha') }}</th>
                            <th>Unidad</th>
                            <th>Dias Ultima Captura</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bitacoraConsumibles as $bitacoraConsumible)
                        <?php 
                        $dias = \Carbon\Carbon::now()->diffInDays($bitacoraConsumible->fecha);
                        ?>
                        <tr>
                            <td>{{ $bitacoraConsumible->id }}</td>
                            <td>{{ optional($bitacoraConsumible->caConsumible)->consumible }}</td>
                            <td>{{ $bitacoraConsumible->consumo }}</td>
                            <td>{{ $bitacoraConsumible->fecha }}</td>
                            <td>{{ optional($bitacoraConsumible->caConsumible)->unidad }}</td>
                            <td>
                                @if($dias > 0 )
                                    <span class='label label-danger'>
                                @elseif($dias == 0 )
                                    <span class='label label-warning'>
                                @elseif($dias < 0 )
                                    <span class='label label-success'>
                                @endif
                                {{ $dias}}</td>
                                </span>
                            </td>
                            
                            <td>

                                <form method="POST" action="{!! route('bitacora_consumibles.bitacora_consumible.destroy', $bitacoraConsumible->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('bitacora_consumibles.bitacora_consumible.show')
                                        <a href="{{ route('bitacora_consumibles.bitacora_consumible.show', $bitacoraConsumible->id ) }}" class="btn btn-info btn-xs" title="{{ trans('bitacora_consumibles.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('bitacora_consumibles.bitacora_consumible.edit')
                                        <a href="{{ route('bitacora_consumibles.bitacora_consumible.edit', $bitacoraConsumible->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('bitacora_consumibles.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('bitacora_consumibles.bitacora_consumible.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('bitacora_consumibles.delete') }}" onclick="return confirm(&quot;{{ trans('bitacora_consumibles.confirm_delete') }}&quot;)">
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
            {!! $bitacoraConsumibles->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
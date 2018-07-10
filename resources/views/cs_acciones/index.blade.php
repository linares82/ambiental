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
				<a href="{{ route('cs_acciones.cs_accione.index') }}">{{ trans('cs_acciones.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('cs_acciones.model_plural') }}</h4>
            </div>
            
            @ifUserCan('cs_acciones.cs_accione.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('cs_acciones.cs_accione.create') }}" class="btn btn-success btn-xs" title="{{ trans('cs_acciones.create') }}">
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
                <a href="{{ route('cs_acciones.cs_accione.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($csAcciones) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('cs_acciones.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('cs_acciones.cs_accione.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('accion') ? 'has-error' : '' }}">
                                                    <label for="accion" class="control-label">{{ trans('cs_acciones.accion') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="accion" type="text" id="accion" value="{{ old('accion') }}" minlength="1" maxlength="255" placeholder="{{ trans('cs_acciones.accion__placeholder') }}">
                                                        {!! $errors->first('accion', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('cs_acciones.accion') }}</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($csAcciones as $csAccione)
                        <tr>
                            <td>{{ $csAccione->id }}</td>
                            <td>{{ $csAccione->accion }}</td>
                            
                            <td>

                                <form method="POST" action="{!! route('cs_acciones.cs_accione.destroy', $csAccione->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('cs_acciones.cs_accione.show')
                                        <a href="{{ route('cs_acciones.cs_accione.show', $csAccione->id ) }}" class="btn btn-info btn-xs" title="{{ trans('cs_acciones.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('cs_acciones.cs_accione.edit')
                                        <a href="{{ route('cs_acciones.cs_accione.edit', $csAccione->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('cs_acciones.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('cs_acciones.cs_accione.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('cs_acciones.delete') }}" onclick="return confirm(&quot;{{ trans('cs_acciones.confirm_delete') }}&quot;)">
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
            {!! $csAcciones->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
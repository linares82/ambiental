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
				<a href="{{ route('intensidad_impactos.intensidad_impacto.index') }}">{{ trans('intensidad_impactos.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('intensidad_impactos.model_plural') }}</h4>
            </div>
            
            @ifUserCan('intensidad_impactos.intensidad_impacto.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('intensidad_impactos.intensidad_impacto.create') }}" class="btn btn-success btn-xs" title="{{ trans('intensidad_impactos.create') }}">
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
                <a href="{{ route('intensidad_impactos.intensidad_impacto.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($intensidadImpactos) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('intensidad_impactos.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('intensidad_impactos.intensidad_impacto.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
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
                            <th>{{ trans('intensidad_impactos.intensidad_impacto') }}</th>
                            <th>{{ trans('intensidad_impactos.usu_alta_id') }}</th>
                            <th>{{ trans('intensidad_impactos.usu_mod_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($intensidadImpactos as $intensidadImpacto)
                        <tr>
                            <td>{{ $intensidadImpacto->intensidad_impacto }}</td>
                            <td>{{ optional($intensidadImpacto->user)->name }}</td>
                            <td>{{ optional($intensidadImpacto->user)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('intensidad_impactos.intensidad_impacto.destroy', $intensidadImpacto->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('intensidad_impactos.intensidad_impacto.show')
                                        <a href="{{ route('intensidad_impactos.intensidad_impacto.show', $intensidadImpacto->id ) }}" class="btn btn-info btn-xs" title="{{ trans('intensidad_impactos.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('intensidad_impactos.intensidad_impacto.edit')
                                        <a href="{{ route('intensidad_impactos.intensidad_impacto.edit', $intensidadImpacto->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('intensidad_impactos.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('intensidad_impactos.intensidad_impacto.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('intensidad_impactos.delete') }}" onclick="return confirm(&quot;{{ trans('intensidad_impactos.confirm_delete') }}&quot;)">
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
            {!! $intensidadImpactos->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
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
				<a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.index') }}">{{ trans('s_comentarios_procedimientos.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('s_comentarios_procedimientos.model_plural') }}</h4>
            </div>
            
            @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.create') }}" class="btn btn-success btn-xs" title="{{ trans('s_comentarios_procedimientos.create') }}">
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
                <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($sComentariosProcedimientos) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('s_comentarios_procedimientos.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
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
                            <th>{{ trans('s_comentarios_procedimientos.s_procedimiento_id') }}</th>
                            <th>{{ trans('s_comentarios_procedimientos.comentario') }}</th>
                            <th>{{ trans('s_comentarios_procedimientos.estatus_id') }}</th>
                            <th>{{ trans('s_comentarios_procedimientos.usu_alta_id') }}</th>
                            <th>{{ trans('s_comentarios_procedimientos.usu_mod_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($sComentariosProcedimientos as $sComentariosProcedimiento)
                        <tr>
                            <td>{{ optional($sComentariosProcedimiento->sProcedimiento)->descripcion }}</td>
                            <td>{{ $sComentariosProcedimiento->comentario }}</td>
                            <td>{{ optional($sComentariosProcedimiento->sEstatusProcedimiento)->estatus }}</td>
                            <td>{{ optional($sComentariosProcedimiento->user)->name }}</td>
                            <td>{{ optional($sComentariosProcedimiento->user)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('s_comentarios_procedimientos.s_comentarios_procedimiento.destroy', $sComentariosProcedimiento->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.show')
                                        <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.show', $sComentariosProcedimiento->id ) }}" class="btn btn-info btn-xs" title="{{ trans('s_comentarios_procedimientos.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.edit')
                                        <a href="{{ route('s_comentarios_procedimientos.s_comentarios_procedimiento.edit', $sComentariosProcedimiento->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('s_comentarios_procedimientos.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('s_comentarios_procedimientos.s_comentarios_procedimiento.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('s_comentarios_procedimientos.delete') }}" onclick="return confirm(&quot;{{ trans('s_comentarios_procedimientos.confirm_delete') }}&quot;)">
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
            {!! $sComentariosProcedimientos->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
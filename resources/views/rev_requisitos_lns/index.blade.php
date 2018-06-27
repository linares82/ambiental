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
				<a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.index') }}">{{ trans('rev_requisitos_lns.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('rev_requisitos_lns.model_plural') }}</h4>
            </div>
            
            @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.create') }}" class="btn btn-success btn-xs" title="{{ trans('rev_requisitos_lns.create') }}">
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
                <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($revRequisitosLns) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('rev_requisitos_lns.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('rev_requisitos_lns.rev_requisitos_ln.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
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
                            <th>{{ trans('rev_requisitos_lns.rev_requisitos_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.impacto_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.condicion_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.area_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.norma') }}</th>
                            <th>{{ trans('rev_requisitos_lns.estatus_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.importancia_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.responsable_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.dias_advertencia1') }}</th>
                            <th>{{ trans('rev_requisitos_lns.dias_advertencia2') }}</th>
                            <th>{{ trans('rev_requisitos_lns.dias_advertencia3') }}</th>
                            <th>{{ trans('rev_requisitos_lns.fec_cumplimiento') }}</th>
                            <th>{{ trans('rev_requisitos_lns.observaciones') }}</th>
                            <th>{{ trans('rev_requisitos_lns.usu_alta_id') }}</th>
                            <th>{{ trans('rev_requisitos_lns.usu_mod_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($revRequisitosLns as $revRequisitosLn)
                        <tr>
                            <td>{{ optional($revRequisitosLn->revRequisito)->anio }}</td>
                            <td>{{ optional($revRequisitosLn->aaImpacto)->impacto }}</td>
                            <td>{{ optional($revRequisitosLn->condicione)->condicion }}</td>
                            <td>{{ optional($revRequisitosLn->area)->area }}</td>
                            <td>{{ $revRequisitosLn->norma }}</td>
                            <td>{{ optional($revRequisitosLn->estatusCondicione)->id }}</td>
                            <td>{{ optional($revRequisitosLn->importancium)->id }}</td>
                            <td>{{ optional($revRequisitosLn->empleado)->ctrl_interno }}</td>
                            <td>{{ $revRequisitosLn->dias_advertencia1 }}</td>
                            <td>{{ $revRequisitosLn->dias_advertencia2 }}</td>
                            <td>{{ $revRequisitosLn->dias_advertencia3 }}</td>
                            <td>{{ $revRequisitosLn->fec_cumplimiento }}</td>
                            <td>{{ $revRequisitosLn->observaciones }}</td>
                            <td>{{ optional($revRequisitosLn->user)->name }}</td>
                            <td>{{ optional($revRequisitosLn->user)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('rev_requisitos_lns.rev_requisitos_ln.destroy', $revRequisitosLn->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.show')
                                        <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.show', $revRequisitosLn->id ) }}" class="btn btn-info btn-xs" title="{{ trans('rev_requisitos_lns.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.edit')
                                        <a href="{{ route('rev_requisitos_lns.rev_requisitos_ln.edit', $revRequisitosLn->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('rev_requisitos_lns.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('rev_requisitos_lns.rev_requisitos_ln.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('rev_requisitos_lns.delete') }}" onclick="return confirm(&quot;{{ trans('rev_requisitos_lns.confirm_delete') }}&quot;)">
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
            {!! $revRequisitosLns->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
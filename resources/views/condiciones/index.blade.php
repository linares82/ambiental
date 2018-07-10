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
				<a href="{{ route('condiciones.condicione.index') }}">{{ trans('condiciones.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('condiciones.model_plural') }}</h4>
            </div>
            
            @ifUserCan('condiciones.condicione.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('condiciones.condicione.create') }}" class="btn btn-success btn-xs" title="{{ trans('condiciones.create') }}">
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
                <a href="{{ route('condiciones.condicione.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($condiciones) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('condiciones.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('condiciones.condicione.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('impacto_id') ? 'has-error' : '' }}">
                                                    <label for="impacto_id" class="control-label">{{ trans('condiciones.impacto_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="impacto_id" name="impacto_id">
                                                                    <option value="" style="display: none;" {{ old('impacto_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('condiciones.impacto_id__placeholder') }}</option>
                                                                @foreach ($aaImpactos as $key => $aaImpacto)
                                                                            <option value="{{ $key }}" {{ old('impacto_id') == $key ? 'selected' : '' }}>
                                                                                {{ $aaImpacto }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('condicion') ? 'has-error' : '' }}">
                                                    <label for="condicion" class="control-label">{{ trans('condiciones.condicion') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="condicion" type="text" id="condicion" value="{{ old('condicion') }}" minlength="1" maxlength="500" placeholder="{{ trans('condiciones.condicion__placeholder') }}">
                                                        {!! $errors->first('condicion', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('condiciones.impacto_id') }}</th>
                            <th>{{ trans('condiciones.condicion') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($condiciones as $condicione)
                        <tr>
                            <td>{{ $condicione->id }}</td>
                            <td>{{ optional($condicione->aaImpacto)->impacto }}</td>
                            <td>{{ $condicione->condicion }}</td>
                            <td>

                                <form method="POST" action="{!! route('condiciones.condicione.destroy', $condicione->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('condiciones.condicione.show')
                                        <a href="{{ route('condiciones.condicione.show', $condicione->id ) }}" class="btn btn-info btn-xs" title="{{ trans('condiciones.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('condiciones.condicione.edit')
                                        <a href="{{ route('condiciones.condicione.edit', $condicione->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('condiciones.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('condiciones.condicione.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('condiciones.delete') }}" onclick="return confirm(&quot;{{ trans('condiciones.confirm_delete') }}&quot;)">
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
            {!! $condiciones->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
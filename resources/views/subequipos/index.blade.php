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
				<a href="{{ route('subequipos.subequipo.index') }}">{{ trans('subequipos.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('subequipos.model_plural') }}</h4>
            </div>
            
            @ifUserCan('subequipos.subequipo.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('subequipos.subequipo.create') }}" class="btn btn-success btn-xs" title="{{ trans('subequipos.create') }}">
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
                <a href="{{ route('subequipos.subequipo.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($subequipos) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('subequipos.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('subequipos.subequipo.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('equipo_id') ? 'has-error' : '' }}">
                                                    <label for="equipo_id" class="control-label">{{ trans('subequipos.equipo_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="equipo_id" name="equipo_id" >
                                                                    <option value="" style="display: none;" {{ old('equipo_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('subequipos.equipo_id__placeholder') }}</option>
                                                                @foreach ($mObjetivos as $key => $mObjetivo)
                                                                            <option value="{{ $key }}" {{ old('equipo_id') == $key ? 'selected' : '' }}>
                                                                                {{ $mObjetivo }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('equipo_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('subequipo') ? 'has-error' : '' }}">
                                                    <label for="subequipo" class="control-label">{{ trans('subequipos.subequipo') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="subequipo" type="text" id="subequipo" value="{{ old('subequipo') }}" minlength="1" maxlength="255" placeholder="{{ trans('subequipos.subequipo__placeholder') }}">
                                                        {!! $errors->first('subequipo', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('subequipos.equipo_id') }}</th>
                            <th>{{ trans('subequipos.subequipo') }}</th>
                            <th>{{ trans('subequipos.clase') }}</th>
                            <th>{{ trans('subequipos.marca') }}</th>
                            <th>{{ trans('subequipos.modelo') }}</th>
                            <th>{{ trans('subequipos.no_serie') }}</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($subequipos as $subequipo)
                        <tr>
                            <td>{{ $subequipo->id }}</td>
                            <td>{{ optional($subequipo->mObjetivo)->objetivo }}</td>
                            <td>{{ $subequipo->subequipo }}</td>
                            <td>{{ $subequipo->clase }}</td>
                            <td>{{ $subequipo->marca }}</td>
                            <td>{{ $subequipo->modelo }}</td>
                            <td>{{ $subequipo->no_serie }}</td>
                            
                            <td>

                                <form method="POST" action="{!! route('subequipos.subequipo.destroy', $subequipo->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('subequipos.subequipo.show')
                                        <a href="{{ route('subequipos.subequipo.show', $subequipo->id ) }}" class="btn btn-info btn-xs" title="{{ trans('subequipos.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('subequipos.subequipo.edit')
                                        <a href="{{ route('subequipos.subequipo.edit', $subequipo->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('subequipos.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('subequipos.subequipo.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('subequipos.delete') }}" onclick="return confirm(&quot;{{ trans('subequipos.confirm_delete') }}&quot;)">
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
            {!! $subequipos->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
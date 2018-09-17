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
				<a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}">{{ trans('aspectos_ambientales.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('aspectos_ambientales.model_plural') }}</h4>
            </div>
            
            @ifUserCan('aspectos_ambientales.aspectos_ambientale.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('aspectos_ambientales.aspectos_ambientale.create') }}" class="btn btn-success btn-xs" title="{{ trans('aspectos_ambientales.create') }}">
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
                <a href="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($aspectosAmbientales) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('aspectos_ambientales.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('aspectos_ambientales.aspectos_ambientale.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('proceso_id') ? 'has-error' : '' }}">
                                                    <label for="proceso_id" class="control-label">{{ trans('aspectos_ambientales.proceso_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="proceso_id" name="proceso_id">
                                                                    <option value="" style="display: none;" {{ old('proceso_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.proceso_id__placeholder') }}</option>
                                                                @foreach ($aaProcesos as $key => $aaProceso)
                                                                            <option value="{{ $key }}" {{ old('proceso_id') == $key ? 'selected' : '' }}>
                                                                                {{ $aaProceso }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('proceso_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
                                                    <label for="area_id" class="control-label">{{ trans('aspectos_ambientales.area_id') }}</label><br/>
                                                    <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="area_id" name="area_id">
                                                                    <option value="" style="display: none;" {{ old('area_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.area_id__placeholder') }}</option>
                                                                @foreach ($areas as $key => $area)
                                                                            <option value="{{ $key }}" {{ old('area_id') == $key ? 'selected' : '' }}>
                                                                                {{ $area }}
                                                                            </option>
                                                                        @endforeach
                                                        </select>

                                                        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('actividad') ? 'has-error' : '' }}">
                                                    <label for="actividad" class="control-label">{{ trans('aspectos_ambientales.actividad') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                        <input class="form-control input-sm " name="actividad" type="text" id="actividad" value="{{ old('actividad') }}" minlength="1" maxlength="255" placeholder="{{ trans('aspectos_ambientales.actividad__placeholder') }}">
                                                        {!! $errors->first('actividad', '<p class="help-block">:message</p>') !!}
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
                            <th>{{ trans('aspectos_ambientales.entity_id') }}</th>
                            <th>{{ trans('aspectos_ambientales.proceso_id') }}</th>
                            <th>{{ trans('aspectos_ambientales.area_id') }}</th>
                            <th>{{ trans('aspectos_ambientales.actividad') }}</th>
                            <th>{{ trans('aspectos_ambientales.imp_potencial_id') }}</th>
                            <th>{{ trans('aspectos_ambientales.imp_real_id') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($aspectosAmbientales as $aspectosAmbientale)
                        <tr>
                            <td>{{ $aspectosAmbientale->id }}</td>
                            <td>{{ $aspectosAmbientale->entity->abreviatura }}</td>
                            <td>{{ optional($aspectosAmbientale->aaProceso)->proceso }}</td>
                            <td>{{ optional($aspectosAmbientale->area)->area }}</td>
                            <td>{{ $aspectosAmbientale->actividad }}</td>
                            
                            <td>{{ optional($aspectosAmbientale->impPotencial)->imp_potencial }}</td>
                            <td>{{ optional($aspectosAmbientale->impReal)->imp_real }}</td>
                            
                            <td>

                                <form method="POST" action="{!! route('aspectos_ambientales.aspectos_ambientale.destroy', $aspectosAmbientale->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('aspectos_ambientales.aspectos_ambientale.show')
                                        <a href="{{ route('aspectos_ambientales.aspectos_ambientale.show', $aspectosAmbientale->id ) }}" class="btn btn-info btn-xs" title="{{ trans('aspectos_ambientales.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('aspectos_ambientales.aspectos_ambientale.edit')
                                        <a href="{{ route('aspectos_ambientales.aspectos_ambientale.edit', $aspectosAmbientale->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('aspectos_ambientales.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('aspectos_ambientales.aspectos_ambientale.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('aspectos_ambientales.delete') }}" onclick="return confirm(&quot;{{ trans('aspectos_ambientales.confirm_delete') }}&quot;)">
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
            {!! $aspectosAmbientales->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
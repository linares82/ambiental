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
				<a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.index') }}">{{ trans('a_rr_amb_leyes.model_plural') }}</a>
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
                <h4 class="mt-5 mb-5">{{ trans('a_rr_amb_leyes.model_plural') }}</h4>
            </div>
            
            @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.create')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.create') }}" class="btn btn-success btn-xs" title="{{ trans('a_rr_amb_leyes.create') }}">
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
                <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.index') }}" class="btn btn-xs" title="Refrescar">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($aRrAmbLeyes) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('a_rr_amb_leyes.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="row" >
				<div class="col-md-12">
					<form method="GET" action="{{ route('a_rr_amb_leyes.a_rr_amb_leye.index') }}" id="search_form" name="search_form" accept-charset="UTF-8" class="">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="GET">
						<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
							<label for="id" class="control-label">Id</label>
							<input class="form-control input-sm" name="id" type="text" id="slug" minlength="1" maxlength="255" placeholder="Capturar id ...">
						</div>
                                                <div class="form-group col-md-4 {{ $errors->has('entity_id') ? 'has-error' : '' }}">
                                                        <label for="material_id" class="control-label">{{ trans('a_rr_amb_leyes.entity_id') }}</label>
                                                        <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="entity_id" name="entity_id">
                                                            <option value="" style="display: none;" {{ old('entity_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.entity_id__placeholder') }}</option>
                                                            @foreach ($entities as $key => $entity)
                                                            <option value="{{ $key }}" {{ old('entity_id') == $key ? 'selected' : '' }}>
                                                                    {{ $entity }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('material_id') ? 'has-error' : '' }}">
                                                        <label for="material_id" class="control-label">{{ trans('a_rr_ambientales.material_id') }}</label>
                                                        <!--<div class="col-md-10">-->
                                                        <select class="form-control chosen" id="material_id" name="material_id">
                                                            <option value="" style="display: none;" {{ old('material_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.material_id__placeholder') }}</option>
                                                            @foreach ($caMaterials as $key => $caMaterial)
                                                            <option value="{{ $key }}" {{ old('material_id') == $key ? 'selected' : '' }}>
                                                                    {{ $caMaterial }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
                                                    <!--</div>-->
                                                </div>

                                                <div class="form-group col-md-4 {{ $errors->has('categoria_id') ? 'has-error' : '' }}">
                                                    <label for="categoria_id" class="control-label">{{ trans('a_rr_ambientales.categoria_id') }}</label>
                                                    <!--<div class="col-md-10">-->
                                                    <select class="form-control chosen" id="categoria_id" name="categoria_id">
                                                        <option value="" style="display: none;" {{ old('categoria_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.categoria_id__placeholder') }}</option>
                                                        @foreach ($caCategorias as $key => $caCategorium)
                                                        <option value="{{ $key }}" {{ old('categoria_id') == $key ? 'selected' : '' }}>
                                                                {{ $caCategorium }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
                                                <!--</div>-->
                                            </div>

                                            <div class="form-group col-md-4 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
                                                <label for="documento_id" class="control-label">{{ trans('a_rr_ambientales.documento_id') }}</label>
                                                <!--<div class="col-md-10">-->
                                                <select class="form-control chosen" id="documento_id" name="documento_id">
                                                    <option value="" style="display: none;" {{ old('documento_id') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.documento_id__placeholder') }}</option>
                                                    @foreach ($caAaDocs as $key => $caAaDoc)
                                                    <option value="{{ $key }}" {{ old('documento_id') == $key ? 'selected' : '' }}>
                                                            {{ $caAaDoc }}
                                                </option>
                                                @endforeach
                                            </select>
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
                            <th>{{ trans('a_rr_amb_leyes.material_id') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.categoria_id') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.documento_id') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.descripcion') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.fec_fin_vigencia') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.aviso') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.dias_aviso') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.entity_id') }}</th>
                            <th>{{ trans('a_rr_amb_leyes.activo') }}</th>
                            

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($aRrAmbLeyes as $aRrAmbLeye)
                        <tr>
                            <td>{{ optional($aRrAmbLeye->caMaterial)->material }}</td>
                            <td>{{ optional($aRrAmbLeye->caCategoria)->categoria }}</td>
                            <td>{{ optional($aRrAmbLeye->caAaDoc)->doc }}</td>
                            <td>{{ $aRrAmbLeye->descripcion }}</td>
                            <td>{{ $aRrAmbLeye->fec_fin_vigencia }}</td>
                            <td>{{ optional($aRrAmbLeye->bnd)->bnd }}</td>
                            <td>{{ $aRrAmbLeye->dias_aviso }}</td>
                            <td>{{ optional($aRrAmbLeye->entity)->rzon_social }}</td>
                            <td>{{ $aRrAmbLeye->activo==1?'SI':'NO' }}</td>
                            

                            <td>

                                <form method="POST" action="{!! route('a_rr_amb_leyes.a_rr_amb_leye.destroy', $aRrAmbLeye->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.show')
                                        <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.show', $aRrAmbLeye->id ) }}" class="btn btn-info btn-xs" title="{{ trans('a_rr_amb_leyes.show') }}">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.edit')
                                        <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.edit', $aRrAmbLeye->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('a_rr_amb_leyes.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        @endif
                                        @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.destroy')
                                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('a_rr_amb_leyes.delete') }}" onclick="return confirm(&quot;{{ trans('a_rr_amb_leyes.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        @endif
                                        @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.generar')
                                        <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.generar', array('id'=>$aRrAmbLeye->id) ) }}" class="btn btn-success btn-xs" title="Generar para Entidad">
                                            <span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
                                        </a>
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
            {!! $aRrAmbLeyes->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
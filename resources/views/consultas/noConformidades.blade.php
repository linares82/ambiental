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
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('condiciones.create') }}</h4>
            </span>
            @ifUserCan('condiciones.condicione.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('condiciones.condicione.index') }}" class="btn btn-primary" title="{{ trans('condiciones.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>
            @endif
        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        <form method="POST" action="{{ route('consultas.consulta.postNoConformidades') }}" accept-charset="UTF-8" id="create_condicione_form" name="create_condicione_form" class="">
            {{ csrf_field() }}

        <div class="form-group col-md-6 {{ $errors->has('cia_f') ? 'has-error' : '' }}">
            <label for="cia_f" class="control-label">Entidad de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="cia_f" name="cia_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($cias_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('cia_t') ? 'has-error' : '' }}">
            <label for="cia_t" class="control-label">Entidad a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="cia_t" name="cia_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($cias_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('area_f') ? 'has-error' : '' }}">
            <label for="area_f" class="control-label">Area de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="area_f" name="area_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($areas_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('area_t') ? 'has-error' : '' }}">
            <label for="area_t" class="control-label">Area a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="area_t" name="area_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($areas_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('tpo_deteccion_f') ? 'has-error' : '' }}">
            <label for="tpo_deteccion_f" class="control-label">Tipo Deteccion de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="tpo_deteccion_f" name="tpo_deteccion_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_detecciones_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('tpo_deteccion_t') ? 'has-error' : '' }}">
            <label for="tpo_deteccion_t" class="control-label">Tipo Deteccion a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="tpo_deteccion_t" name="tpo_deteccion_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_detecciones_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('tpo_bitacora_f') ? 'has-error' : '' }}">
            <label for="tpo_bitacora_f" class="control-label">Tipo Bitacora de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="tpo_bitacora_f" name="tpo_bitacora_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_bitacoras_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('tpo_deteccion_t') ? 'has-error' : '' }}">
            <label for="tpo_bitacora_t" class="control-label">Tipo Bitacora a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="tpo_bitacora_t" name="tpo_bitacora_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_bitacoras_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>
        
        <div class="form-group col-md-6 {{ $errors->has('tpo_inconformidad_f') ? 'has-error' : '' }}">
            <label for="tpo_inconformidad_f" class="control-label">Tipo Inconformidad de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="tpo_inconformidad_f" name="tpo_inconformidad_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_inconformidades_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('tpo_inconformidad_t') ? 'has-error' : '' }}">
            <label for="tpo_inconformidad_t" class="control-label">Tipo Inconformidad a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="tpo_inconformidad_t" name="tpo_inconformidad_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($tpo_inconformidades_ls as $key => $cia)
                                    <option value="{{ $key }}">
                                        {{ $cia }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>
        
        <div class="form-group col-md-6 {{ $errors->has('responsable_f') ? 'has-error' : '' }}">
            <label for="responsable_f" class="control-label">Responsable de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="responsable_f" name="responsable_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($responsables_ls as $key => $responsable)
                                    <option value="{{ $key }}">
                                        {{ $responsable }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('responsable_t') ? 'has-error' : '' }}">
            <label for="responsable_t" class="control-label">Responsable a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="responsable_t" name="responsable_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($responsables_ls as $key => $responsable)
                                    <option value="{{ $key }}">
                                        {{ $responsable }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>
        
        <div class="form-group col-md-6 {{ $errors->has('estatus_f') ? 'has-error' : '' }}">
            <label for="estatus_f" class="control-label">Estatus de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="estatus_f" name="estatus_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($estatus_ls as $key => $responsable)
                                    <option value="{{ $key }}">
                                        {{ $responsable }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('estatus_t') ? 'has-error' : '' }}">
            <label for="estatus_t" class="control-label">Estatus a:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="estatus_t" name="estatus_t" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($estatus_ls as $key => $responsable)
                                    <option value="{{ $key }}">
                                        {{ $responsable }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
        <div class="form-group col-md-6 {{ $errors->has('fecha_f') ? 'has-error' : '' }}">
            <label for="fecha_f" class="control-label">Fecha de:</label>
            <!--<div class="col-md-10">-->
                <input class="form-control input-sm date-picker" name="fecha_f" type="text" id="fecha_f" value="" minlength="1" maxlength="500" required="true" placeholder="">
                {!! $errors->first('condicion', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>
            
        <div class="form-group col-md-6 {{ $errors->has('fecha_t') ? 'has-error' : '' }}">
            <label for="fecha_t" class="control-label">Fecha a:</label>
            <!--<div class="col-md-10">-->
                <input class="form-control input-sm date-picker" name="fecha_t" type="text" id="fecha_t" value="" minlength="1" maxlength="500" required="true" placeholder="">
                {!! $errors->first('condicion', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('condiciones.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });
</script>
@endpush    

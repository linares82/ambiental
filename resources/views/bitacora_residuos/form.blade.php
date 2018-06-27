
<div class="form-group col-md-4 {{ $errors->has('residuo') ? 'has-error' : '' }}">
    <label for="residuo" class="control-label">{{ trans('bitacora_residuos.residuo') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="residuo" name="residuo" required="true">
        	    <option value="" style="display: none;" {{ old('residuo', optional($bitacoraResiduo)->residuo ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_residuos.residuo__placeholder') }}</option>
        	@foreach ($caResiduos as $key => $caResiduo)
			    <option value="{{ $key }}" {{ old('residuo', optional($bitacoraResiduo)->residuo) == $key ? 'selected' : '' }}>
			    	{{ $caResiduo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('residuo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('cantidad') ? 'has-error' : '' }}">
    <label for="cantidad" class="control-label">{{ trans('bitacora_residuos.cantidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="cantidad" type="number" id="cantidad" value="{{ old('cantidad', optional($bitacoraResiduo)->cantidad) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_residuos.cantidad__placeholder') }}" step="any">
        {!! $errors->first('cantidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_residuos.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraResiduo)->fecha) }}" required="true" placeholder="{{ trans('bitacora_residuos.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('lugar_generacion') ? 'has-error' : '' }}">
    <label for="lugar_generacion" class="control-label">{{ trans('bitacora_residuos.lugar_generacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="lugar_generacion" type="text" id="lugar_generacion" value="{{ old('lugar_generacion', optional($bitacoraResiduo)->lugar_generacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.lugar_generacion__placeholder') }}">
        {!! $errors->first('lugar_generacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('ubicacion') ? 'has-error' : '' }}">
    <label for="ubicacion" class="control-label">{{ trans('bitacora_residuos.ubicacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="ubicacion" type="text" id="ubicacion" value="{{ old('ubicacion', optional($bitacoraResiduo)->ubicacion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.ubicacion__placeholder') }}">
        {!! $errors->first('ubicacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dispocision') ? 'has-error' : '' }}">
    <label for="dispocision" class="control-label">{{ trans('bitacora_residuos.dispocision') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dispocision" type="text" id="dispocision" value="{{ old('dispocision', optional($bitacoraResiduo)->dispocision) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.dispocision__placeholder') }}">
        {!! $errors->first('dispocision', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('transportista') ? 'has-error' : '' }}">
    <label for="transportista" class="control-label">{{ trans('bitacora_residuos.transportista') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="transportista" type="text" id="transportista" value="{{ old('transportista', optional($bitacoraResiduo)->transportista) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.transportista__placeholder') }}">
        {!! $errors->first('transportista', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('bitacora_residuos.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($bitacoraResiduo)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_residuos.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($bitacoraResiduo)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-4 {{ $errors->has('manifiesto') ? 'has-error' : '' }}">
    <label for="manifiesto" class="control-label">{{ trans('bitacora_residuos.manifiesto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="manifiesto" type="text" id="manifiesto" value="{{ old('manifiesto', optional($bitacoraResiduo)->manifiesto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.manifiesto__placeholder') }}">
        {!! $errors->first('manifiesto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('resp_tecnico') ? 'has-error' : '' }}">
    <label for="resp_tecnico" class="control-label">{{ trans('bitacora_residuos.resp_tecnico') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="resp_tecnico" type="text" id="resp_tecnico" value="{{ old('resp_tecnico', optional($bitacoraResiduo)->resp_tecnico) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.resp_tecnico__placeholder') }}">
        {!! $errors->first('resp_tecnico', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('requiere_vobo') ? 'has-error' : '' }}">
    <label for="requiere_vobo" class="control-label">{{ trans('bitacora_residuos.requiere_vobo') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="requiere_vobo" name="requiere_vobo" required="true">
        	    <option value="" style="display: none;" {{ old('requiere_vobo', optional($bitacoraResiduo)->requiere_vobo ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_residuos.requiere_vobo__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('requiere_vobo', optional($bitacoraResiduo)->requiere_vobo) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('requiere_vobo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('registro_residuos') ? 'has-error' : '' }}">
    <label for="registro_residuos" class="control-label">{{ trans('bitacora_residuos.registro_residuos') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="registro_residuos" name="registro_residuos" required="true">
        	    <option value="" style="display: none;" {{ old('registro_residuos', optional($bitacoraResiduo)->registro_residuos ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_residuos.registro_residuos__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('registro_residuos', optional($bitacoraResiduo)->registro_residuos) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('registro_residuos', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('peligrosidad') ? 'has-error' : '' }}" style="clear:left">
    <label for="peligrosidad" class="control-label">{{ trans('bitacora_residuos.peligrosidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="peligrosidad" type="text" id="peligrosidad" value="{{ old('peligrosidad', optional($bitacoraResiduo)->peligrosidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_residuos.peligrosidad__placeholder') }}">
        {!! $errors->first('peligrosidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_ingreso') ? 'has-error' : '' }}">
    <label for="fec_ingreso" class="control-label">{{ trans('bitacora_residuos.fec_ingreso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_ingreso" type="text" id="fec_ingreso" value="{{ old('fec_ingreso', optional($bitacoraResiduo)->fec_ingreso) }}" required="true" placeholder="{{ trans('bitacora_residuos.fec_ingreso__placeholder') }}">
        {!! $errors->first('fec_ingreso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_salida') ? 'has-error' : '' }}">
    <label for="fec_salida" class="control-label">{{ trans('bitacora_residuos.fec_salida') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_salida" type="text" id="fec_salida" value="{{ old('fec_salida', optional($bitacoraResiduo)->fec_salida) }}" placeholder="{{ trans('bitacora_residuos.fec_salida__placeholder') }}">
        {!! $errors->first('fec_salida', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('cedula_operacion') ? 'has-error' : '' }}">
    <label for="cedula_operacion" class="control-label">{{ trans('bitacora_residuos.cedula_operacion') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="cedula_operacion" name="cedula_operacion" required="true">
        	    <option value="" style="display: none;" {{ old('cedula_operacion', optional($bitacoraResiduo)->cedula_operacion ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_residuos.cedula_operacion__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('cedula_operacion', optional($bitacoraResiduo)->cedula_operacion) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('cedula_operacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('factor_indicador') ? 'has-error' : '' }}">
    <label for="factor_indicador" class="control-label">{{ trans('bitacora_residuos.factor_indicador') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="factor_indicador" type="number" id="factor_indicador" value="{{ old('factor_indicador', optional($bitacoraResiduo)->factor_indicador) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_residuos.factor_indicador__placeholder') }}" step="any">
        {!! $errors->first('factor_indicador', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


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




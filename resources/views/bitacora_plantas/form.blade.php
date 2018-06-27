
<div class="form-group col-md-4 {{ $errors->has('planta_id') ? 'has-error' : '' }}">
    <label for="planta_id" class="control-label">{{ trans('bitacora_plantas.planta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="planta_id" name="planta_id" required="true">
        	    <option value="" style="display: none;" {{ old('planta_id', optional($bitacoraPlanta)->planta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_plantas.planta_id__placeholder') }}</option>
        	@foreach ($caPlantas as $key => $caPlantum)
			    <option value="{{ $key }}" {{ old('planta_id', optional($bitacoraPlanta)->planta_id) == $key ? 'selected' : '' }}>
			    	{{ $caPlantum }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('planta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_plantas.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraPlanta)->fecha) }}" required="true" placeholder="{{ trans('bitacora_plantas.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('turno_id') ? 'has-error' : '' }}">
    <label for="turno_id" class="control-label">{{ trans('bitacora_plantas.turno_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="turno_id" name="turno_id" required="true">
        	    <option value="" style="display: none;" {{ old('turno_id', optional($bitacoraPlanta)->turno_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_plantas.turno_id__placeholder') }}</option>
        	@foreach ($turnos as $key => $turno)
			    <option value="{{ $key }}" {{ old('turno_id', optional($bitacoraPlanta)->turno_id) == $key ? 'selected' : '' }}>
			    	{{ $turno }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('turno_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('agua_entrada') ? 'has-error' : '' }}" style="clear:left;">
    <label for="agua_entrada" class="control-label">{{ trans('bitacora_plantas.agua_entrada') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="agua_entrada" type="number" id="agua_entrada" value="{{ old('agua_entrada', optional($bitacoraPlanta)->agua_entrada) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_plantas.agua_entrada__placeholder') }}" step="any">
        {!! $errors->first('agua_entrada', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('agua_salida') ? 'has-error' : '' }}">
    <label for="agua_salida" class="control-label">{{ trans('bitacora_plantas.agua_salida') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="agua_salida" type="number" id="agua_salida" value="{{ old('agua_salida', optional($bitacoraPlanta)->agua_salida) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_plantas.agua_salida__placeholder') }}" step="any">
        {!! $errors->first('agua_salida', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('q_usados') ? 'has-error' : '' }}">
    <label for="q_usados" class="control-label">{{ trans('bitacora_plantas.q_usados') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="q_usados" type="text" id="q_usados" value="{{ old('q_usados', optional($bitacoraPlanta)->q_usados) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_plantas.q_usados__placeholder') }}">
        {!! $errors->first('q_usados', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('q_existentes') ? 'has-error' : '' }}">
    <label for="q_existentes" class="control-label">{{ trans('bitacora_plantas.q_existentes') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="q_existentes" type="text" id="q_existentes" value="{{ old('q_existentes', optional($bitacoraPlanta)->q_existentes) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_plantas.q_existentes__placeholder') }}">
        {!! $errors->first('q_existentes', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tiempo_operacion') ? 'has-error' : '' }}">
    <label for="tiempo_operacion" class="control-label">{{ trans('bitacora_plantas.tiempo_operacion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tiempo_operacion" type="number" id="tiempo_operacion" value="{{ old('tiempo_operacion', optional($bitacoraPlanta)->tiempo_operacion) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_plantas.tiempo_operacion__placeholder') }}" step="any">
        {!! $errors->first('tiempo_operacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('motivo_paro') ? 'has-error' : '' }}">
    <label for="motivo_paro" class="control-label">{{ trans('bitacora_plantas.motivo_paro') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="motivo_paro" type="text" id="motivo_paro" value="{{ old('motivo_paro', optional($bitacoraPlanta)->motivo_paro) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_plantas.motivo_paro__placeholder') }}">
        {!! $errors->first('motivo_paro', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('vol_lodos') ? 'has-error' : '' }}">
    <label for="vol_lodos" class="control-label">{{ trans('bitacora_plantas.vol_lodos') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="vol_lodos" type="number" id="vol_lodos" value="{{ old('vol_lodos', optional($bitacoraPlanta)->vol_lodos) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_plantas.vol_lodos__placeholder') }}" step="any">
        {!! $errors->first('vol_lodos', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('disp_lodos') ? 'has-error' : '' }}">
    <label for="disp_lodos" class="control-label">{{ trans('bitacora_plantas.disp_lodos') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="disp_lodos" type="text" id="disp_lodos" value="{{ old('disp_lodos', optional($bitacoraPlanta)->disp_lodos) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_plantas.disp_lodos__placeholder') }}">
        {!! $errors->first('disp_lodos', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('bitacora_plantas.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($bitacoraPlanta)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_plantas.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($bitacoraPlanta)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-4 {{ $errors->has('fec_ult_manto') ? 'has-error' : '' }}" style="clear:left;">
    <label for="fec_ult_manto" class="control-label">{{ trans('bitacora_plantas.fec_ult_manto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_ult_manto" type="text" id="fec_ult_manto" value="{{ old('fec_ult_manto', optional($bitacoraPlanta)->fec_ult_manto) }}" required="true" placeholder="{{ trans('bitacora_plantas.fec_ult_manto__placeholder') }}">
        {!! $errors->first('fec_ult_manto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('desc_manto') ? 'has-error' : '' }}">
    <label for="desc_manto" class="control-label">{{ trans('bitacora_plantas.desc_manto') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="desc_manto" type="text" id="desc_manto" rows="2" maxlength="255">
        {{ old('desc_manto', optional($bitacoraPlanta)->desc_manto) }}
    </textarea>
        {!! $errors->first('desc_manto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="control-label">{{ trans('bitacora_plantas.obs') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="obs" type="text" id="obs" rows="2" maxlength="255">
        {{ old('obs', optional($bitacoraPlanta)->obs) }}
    </textarea>
        
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
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
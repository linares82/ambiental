
<div class="form-group col-md-4 {{ $errors->has('ca_fuente_fija_id') ? 'has-error' : '' }}">
    <label for="ca_fuente_fija_id" class="control-label">{{ trans('bitacora_ffs.ca_fuente_fija_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="ca_fuente_fija_id" name="ca_fuente_fija_id" required="true">
        	    <option value="" style="display: none;" {{ old('ca_fuente_fija_id', optional($bitacoraFf)->ca_fuente_fija_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_ffs.ca_fuente_fija_id__placeholder') }}</option>
        	@foreach ($caFuentesFijas as $key => $caFuentesFija)
			    <option value="{{ $key }}" {{ old('ca_fuente_fija_id', optional($bitacoraFf)->ca_fuente_fija_id) == $key ? 'selected' : '' }}>
			    	{{ $caFuentesFija }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('ca_fuente_fija_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_ffs.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraFf)->fecha) }}" required="true" placeholder="{{ trans('bitacora_ffs.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('turno_id') ? 'has-error' : '' }}">
    <label for="turno_id" class="control-label">{{ trans('bitacora_ffs.turno_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="turno_id" name="turno_id" required="true">
        	    <option value="" style="display: none;" {{ old('turno_id', optional($bitacoraFf)->turno_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_ffs.turno_id__placeholder') }}</option>
        	@foreach ($turnos as $key => $turno)
			    <option value="{{ $key }}" {{ old('turno_id', optional($bitacoraFf)->turno_id) == $key ? 'selected' : '' }}>
			    	{{ $turno }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('turno_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('consumo') ? 'has-error' : '' }}" style="clear:left;">
    <label for="consumo" class="control-label">{{ trans('bitacora_ffs.consumo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="consumo" type="number" id="consumo" value="{{ old('consumo', optional($bitacoraFf)->consumo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_ffs.consumo__placeholder') }}" step="any">
        {!! $errors->first('consumo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('capacidad_diseno') ? 'has-error' : '' }}">
    <label for="capacidad_diseno" class="control-label">{{ trans('bitacora_ffs.capacidad_diseno') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="capacidad_diseno" type="number" id="capacidad_diseno" value="{{ old('capacidad_diseno', optional($bitacoraFf)->capacidad_diseno) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_ffs.capacidad_diseno__placeholder') }}" step="any">
        {!! $errors->first('capacidad_diseno', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tp_gases') ? 'has-error' : '' }}">
    <label for="tp_gases" class="control-label">{{ trans('bitacora_ffs.tp_gases') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tp_gases" type="number" id="tp_gases" value="{{ old('tp_gases', optional($bitacoraFf)->tp_gases) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_ffs.tp_gases__placeholder') }}" step="any">
        {!! $errors->first('tp_gases', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tp_chimenea') ? 'has-error' : '' }}">
    <label for="tp_chimenea" class="control-label">{{ trans('bitacora_ffs.tp_chimenea') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tp_chimenea" type="number" id="tp_chimenea" value="{{ old('tp_chimenea', optional($bitacoraFf)->tp_chimenea) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_ffs.tp_chimenea__placeholder') }}" step="any">
        {!! $errors->first('tp_chimenea', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('bitacora_ffs.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($bitacoraFf)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_ffs.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($bitacoraFf)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_ult_manto') ? 'has-error' : '' }}">
    <label for="fec_ult_manto" class="control-label">{{ trans('bitacora_ffs.fec_ult_manto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_ult_manto" type="text" id="fec_ult_manto" value="{{ old('fec_ult_manto', optional($bitacoraFf)->fec_ult_manto) }}" required="true" placeholder="{{ trans('bitacora_ffs.fec_ult_manto__placeholder') }}">
        {!! $errors->first('fec_ult_manto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('desc_manto') ? 'has-error' : '' }}">
    <label for="desc_manto" class="control-label">{{ trans('bitacora_ffs.desc_manto') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="desc_manto" maxlength="255" type="text" id="desc_manto" rows="3">
        {{ old('desc_manto', optional($bitacoraFf)->desc_manto) }}
    </textarea>
        {!! $errors->first('desc_manto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="control-label">{{ trans('bitacora_ffs.obs') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " maxlength="255" name="obs" type="text" id="obs" rows="3">
        {{ old('obs', optional($bitacoraFf)->obs) }}
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
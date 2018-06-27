
<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('bitacora_enfermedades.area_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($bitacoraEnfermedade)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($bitacoraEnfermedade)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('persona_id') ? 'has-error' : '' }}">
    <label for="persona_id" class="control-label">{{ trans('bitacora_enfermedades.persona_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="persona_id" name="persona_id" required="true">
        	    <option value="" style="display: none;" {{ old('persona_id', optional($bitacoraEnfermedade)->persona_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.persona_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('persona_id', optional($bitacoraEnfermedade)->persona_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('persona_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('enfermedad_id') ? 'has-error' : '' }}">
    <label for="enfermedad_id" class="control-label">{{ trans('bitacora_enfermedades.enfermedad_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="enfermedad_id" name="enfermedad_id" required="true">
        	    <option value="" style="display: none;" {{ old('enfermedad_id', optional($bitacoraEnfermedade)->enfermedad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.enfermedad_id__placeholder') }}</option>
        	@foreach ($csEnfermedades as $key => $csEnfermedade)
			    <option value="{{ $key }}" {{ old('enfermedad_id', optional($bitacoraEnfermedade)->enfermedad_id) == $key ? 'selected' : '' }}>
			    	{{ $csEnfermedade }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('enfermedad_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('bitacora_enfermedades.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($bitacoraEnfermedade)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_enfermedades.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('accion_id') ? 'has-error' : '' }}">
    <label for="accion_id" class="control-label">{{ trans('bitacora_enfermedades.accion_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="accion_id" name="accion_id" required="true">
        	    <option value="" style="display: none;" {{ old('accion_id', optional($bitacoraEnfermedade)->accion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.accion_id__placeholder') }}</option>
        	@foreach ($csAcciones as $key => $csAccione)
			    <option value="{{ $key }}" {{ old('accion_id', optional($bitacoraEnfermedade)->accion_id) == $key ? 'selected' : '' }}>
			    	{{ $csAccione }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('accion_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo_directo') ? 'has-error' : '' }}">
    <label for="costo_directo" class="control-label">{{ trans('bitacora_enfermedades.costo_directo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo_directo" type="number" id="costo_directo" value="{{ old('costo_directo', optional($bitacoraEnfermedade)->costo_directo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_enfermedades.costo_directo__placeholder') }}" step="any">
        {!! $errors->first('costo_directo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo_indirecto') ? 'has-error' : '' }}">
    <label for="costo_indirecto" class="control-label">{{ trans('bitacora_enfermedades.costo_indirecto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo_indirecto" type="number" id="costo_indirecto" value="{{ old('costo_indirecto', optional($bitacoraEnfermedade)->costo_indirecto) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_enfermedades.costo_indirecto__placeholder') }}" step="any">
        {!! $errors->first('costo_indirecto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_enfermedades.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraEnfermedade)->fecha) }}" required="true" placeholder="{{ trans('bitacora_enfermedades.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('turno_id') ? 'has-error' : '' }}">
    <label for="turno_id" class="control-label">{{ trans('bitacora_enfermedades.turno_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="turno_id" name="turno_id" required="true">
        	    <option value="" style="display: none;" {{ old('turno_id', optional($bitacoraEnfermedade)->turno_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_enfermedades.turno_id__placeholder') }}</option>
        	@foreach ($turnos as $key => $turno)
			    <option value="{{ $key }}" {{ old('turno_id', optional($bitacoraEnfermedade)->turno_id) == $key ? 'selected' : '' }}>
			    	{{ $turno }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('turno_id', '<p class="help-block">:message</p>') !!}
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


<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('bitacora_accidentes.area_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($bitacoraAccidente)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_accidentes.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($bitacoraAccidente)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id chosen" class="control-label">{{ trans('bitacora_accidentes.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($bitacoraAccidente)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_accidentes.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($bitacoraAccidente)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('persona_id') ? 'has-error' : '' }}">
    <label for="persona_id" class="control-label">{{ trans('bitacora_accidentes.persona_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="persona_id" name="persona_id" required="true">
        	    <option value="" style="display: none;" {{ old('persona_id', optional($bitacoraAccidente)->persona_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_accidentes.persona_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('persona_id', optional($bitacoraAccidente)->persona_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('persona_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('accidente_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="accidente_id" class="control-label">{{ trans('bitacora_accidentes.accidente_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="accidente_id" name="accidente_id" required="true">
        	    <option value="" style="display: none;" {{ old('accidente_id', optional($bitacoraAccidente)->accidente_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_accidentes.accidente_id__placeholder') }}</option>
        	@foreach ($csAccidentes as $key => $csAccidente)
			    <option value="{{ $key }}" {{ old('accidente_id', optional($bitacoraAccidente)->accidente_id) == $key ? 'selected' : '' }}>
			    	{{ $csAccidente }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('accidente_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('bitacora_accidentes.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($bitacoraAccidente)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_accidentes.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('investigacion') ? 'has-error' : '' }}">
    <label for="investigacion" class="control-label">{{ trans('bitacora_accidentes.investigacion') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="investigacion" type="text" id="investigacion" rows="3" maxlength="255">
        {{ old('investigacion', optional($bitacoraAccidente)->investigacion) }}
    </textarea>
        {!! $errors->first('investigacion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('accion_id') ? 'has-error' : '' }}">
    <label for="accion_id" class="control-label">{{ trans('bitacora_accidentes.accion_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="accion_id" name="accion_id" required="true">
        	    <option value="" style="display: none;" {{ old('accion_id', optional($bitacoraAccidente)->accion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_accidentes.accion_id__placeholder') }}</option>
        	@foreach ($csAcciones as $key => $csAccione)
			    <option value="{{ $key }}" {{ old('accion_id', optional($bitacoraAccidente)->accion_id) == $key ? 'selected' : '' }}>
			    	{{ $csAccione }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('accion_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('procedimiento') ? 'has-error' : '' }}">
    <label for="procedimiento" class="control-label">{{ trans('bitacora_accidentes.procedimiento') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="procedimiento" type="text" id="procedimiento" rows="3" maxlength="255">
        {{ old('procedimiento', optional($bitacoraAccidente)->procedimiento) }}
    </textarea>
        {!! $errors->first('procedimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo_directo') ? 'has-error' : '' }}">
    <label for="costo_directo" class="control-label">{{ trans('bitacora_accidentes.costo_directo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo_directo" type="number" id="costo_directo" value="{{ old('costo_directo', optional($bitacoraAccidente)->costo_directo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_accidentes.costo_directo__placeholder') }}" step="any">
        {!! $errors->first('costo_directo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo_indirecto') ? 'has-error' : '' }}">
    <label for="costo_indirecto" class="control-label">{{ trans('bitacora_accidentes.costo_indirecto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo_indirecto" type="number" id="costo_indirecto" value="{{ old('costo_indirecto', optional($bitacoraAccidente)->costo_indirecto) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_accidentes.costo_indirecto__placeholder') }}" step="any">
        {!! $errors->first('costo_indirecto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_accidentes.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraAccidente)->fecha) }}" required="true" placeholder="{{ trans('bitacora_accidentes.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('turno_id') ? 'has-error' : '' }}">
    <label for="turno_id" class="control-label">{{ trans('bitacora_accidentes.turno_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="turno_id" name="turno_id" required="true">
        	    <option value="" style="display: none;" {{ old('turno_id', optional($bitacoraAccidente)->turno_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_accidentes.turno_id__placeholder') }}</option>
        	@foreach ($turnos as $key => $turno)
			    <option value="{{ $key }}" {{ old('turno_id', optional($bitacoraAccidente)->turno_id) == $key ? 'selected' : '' }}>
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
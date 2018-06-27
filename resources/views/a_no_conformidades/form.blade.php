
<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('a_no_conformidades.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($aNoConformidade)->fecha) }}" required="true" placeholder="{{ trans('a_no_conformidades.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_deteccion_id') ? 'has-error' : '' }}">
    <label for="tpo_deteccion_id" class="control-label">{{ trans('a_no_conformidades.tpo_deteccion_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_deteccion_id" name="tpo_deteccion_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_deteccion_id', optional($aNoConformidade)->tpo_deteccion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_no_conformidades.tpo_deteccion_id__placeholder') }}</option>
        	@foreach ($csTpoDeteccions as $key => $csTpoDeteccion)
			    <option value="{{ $key }}" {{ old('tpo_deteccion_id', optional($aNoConformidade)->tpo_deteccion_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoDeteccion }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_deteccion_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('a_no_conformidades.area_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($aNoConformidade)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_no_conformidades.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($aNoConformidade)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('tpo_bitacora_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="tpo_bitacora_id" class="control-label">{{ trans('a_no_conformidades.tpo_bitacora_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_bitacora_id" name="tpo_bitacora_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_bitacora_id', optional($aNoConformidade)->tpo_bitacora_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_no_conformidades.tpo_bitacora_id__placeholder') }}</option>
        	@foreach ($caTpoBitacoras as $key => $caTpoBitacora)
			    <option value="{{ $key }}" {{ old('tpo_bitacora_id', optional($aNoConformidade)->tpo_bitacora_id) == $key ? 'selected' : '' }}>
			    	{{ $caTpoBitacora }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_bitacora_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('tpo_inconformidad_id') ? 'has-error' : '' }}">
    <label for="tpo_inconformidad_id" class="control-label">{{ trans('a_no_conformidades.tpo_inconformidad_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_inconformidad_id" name="tpo_inconformidad_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_inconformidad_id', optional($aNoConformidade)->tpo_inconformidad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_no_conformidades.tpo_inconformidad_id__placeholder') }}</option>
        	@foreach ($caTpoNoConformidads as $key => $caTpoNoConformidad)
			    <option value="{{ $key }}" {{ old('tpo_inconformidad_id', optional($aNoConformidade)->tpo_inconformidad_id) == $key ? 'selected' : '' }}>
			    	{{ $caTpoNoConformidad }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_inconformidad_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-12 {{ $errors->has('no_conformidad') ? 'has-error' : '' }}">
    <label for="no_conformidad" class="control-label">{{ trans('a_no_conformidades.no_conformidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="no_conformidad" type="text" id="no_conformidad" value="{{ old('no_conformidad', optional($aNoConformidade)->no_conformidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_no_conformidades.no_conformidad__placeholder') }}">
        {!! $errors->first('no_conformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('solucion') ? 'has-error' : '' }}">
    <label for="solucion" class="control-label">{{ trans('a_no_conformidades.solucion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="solucion" type="text" id="solucion" value="{{ old('solucion', optional($aNoConformidade)->solucion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_no_conformidades.solucion__placeholder') }}">
        {!! $errors->first('solucion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('a_no_conformidades.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($aNoConformidade)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_no_conformidades.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($aNoConformidade)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('a_no_conformidades.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($aNoConformidade)->dias_aviso) }}" min="-2147483648" max="2147483647" placeholder="{{ trans('a_no_conformidades.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_planeada') ? 'has-error' : '' }}">
    <label for="fec_planeada" class="control-label">{{ trans('a_no_conformidades.fec_planeada') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_planeada" type="text" id="fec_planeada" value="{{ old('fec_planeada', optional($aNoConformidade)->fec_planeada) }}" required="true" placeholder="{{ trans('a_no_conformidades.fec_planeada__placeholder') }}">
        {!! $errors->first('fec_planeada', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_solucion') ? 'has-error' : '' }}">
    <label for="fec_solucion" class="control-label">{{ trans('a_no_conformidades.fec_solucion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_solucion" type="text" id="fec_solucion" value="{{ old('fec_solucion', optional($aNoConformidade)->fec_solucion) }}" required="true" placeholder="{{ trans('a_no_conformidades.fec_solucion__placeholder') }}">
        {!! $errors->first('fec_solucion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



<div class="form-group col-md-4 {{ $errors->has('anio') ? 'has-error' : '' }}">
    <label for="anio" class="control-label">{{ trans('a_no_conformidades.anio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="anio" type="number" id="anio" value="{{ old('anio', optional($aNoConformidade)->anio) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('a_no_conformidades.anio__placeholder') }}">
        {!! $errors->first('anio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo') ? 'has-error' : '' }}">
    <label for="costo" class="control-label">{{ trans('a_no_conformidades.costo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo" type="number" id="costo" value="{{ old('costo', optional($aNoConformidade)->costo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('a_no_conformidades.costo__placeholder') }}" step="any">
        {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
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
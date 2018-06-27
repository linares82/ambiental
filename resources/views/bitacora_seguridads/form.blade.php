
<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_seguridads.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraSeguridad)->fecha) }}" required="true" placeholder="{{ trans('bitacora_seguridads.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_deteccion_id') ? 'has-error' : '' }}">
    <label for="tpo_deteccion_id" class="control-label">{{ trans('bitacora_seguridads.tpo_deteccion_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_deteccion_id" name="tpo_deteccion_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_deteccion_id', optional($bitacoraSeguridad)->tpo_deteccion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.tpo_deteccion_id__placeholder') }}</option>
        	@foreach ($csTpoDeteccions as $key => $csTpoDeteccion)
			    <option value="{{ $key }}" {{ old('tpo_deteccion_id', optional($bitacoraSeguridad)->tpo_deteccion_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoDeteccion }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_deteccion_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('bitacora_seguridads.area_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($bitacoraSeguridad)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($bitacoraSeguridad)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_bitacora_id') ? 'has-error' : '' }}">
    <label for="tpo_bitacora_id" class="control-label">{{ trans('bitacora_seguridads.tpo_bitacora_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_bitacora_id" name="tpo_bitacora_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_bitacora_id', optional($bitacoraSeguridad)->tpo_bitacora_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.tpo_bitacora_id__placeholder') }}</option>
        	@foreach ($csTpoBitacoras as $key => $csTpoBitacora)
			    <option value="{{ $key }}" {{ old('tpo_bitacora_id', optional($bitacoraSeguridad)->tpo_bitacora_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoBitacora }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_bitacora_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_inconformidad_id') ? 'has-error' : '' }}">
    <label for="tpo_inconformidad_id" class="control-label">{{ trans('bitacora_seguridads.tpo_inconformidad_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_inconformidad_id" name="tpo_inconformidad_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_inconformidad_id', optional($bitacoraSeguridad)->tpo_inconformidad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.tpo_inconformidad_id__placeholder') }}</option>
        	@foreach ($csTpoInconformidades as $key => $csTpoInconformidade)
			    <option value="{{ $key }}" {{ old('tpo_inconformidad_id', optional($bitacoraSeguridad)->tpo_inconformidad_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoInconformidade }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_inconformidad_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('inconformidad') ? 'has-error' : '' }}">
    <label for="inconformidad" class="control-label">{{ trans('bitacora_seguridads.inconformidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="inconformidad" type="text" id="inconformidad" value="{{ old('inconformidad', optional($bitacoraSeguridad)->inconformidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_seguridads.inconformidad__placeholder') }}">
        {!! $errors->first('inconformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('solucion') ? 'has-error' : '' }}">
    <label for="solucion" class="control-label">{{ trans('bitacora_seguridads.solucion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="solucion" type="text" id="solucion" value="{{ old('solucion', optional($bitacoraSeguridad)->solucion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_seguridads.solucion__placeholder') }}">
        {!! $errors->first('solucion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo') ? 'has-error' : '' }}">
    <label for="costo" class="control-label">{{ trans('bitacora_seguridads.costo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo" type="number" id="costo" value="{{ old('costo', optional($bitacoraSeguridad)->costo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_seguridads.costo__placeholder') }}" step="any">
        {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('bitacora_seguridads.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($bitacoraSeguridad)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($bitacoraSeguridad)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('bitacora_seguridads.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($bitacoraSeguridad)->dias_aviso) }}" min="-2147483648" max="2147483647" placeholder="{{ trans('bitacora_seguridads.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_planeada') ? 'has-error' : '' }}">
    <label for="fec_planeada" class="control-label">{{ trans('bitacora_seguridads.fec_planeada') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_planeada" type="text" id="fec_planeada" value="{{ old('fec_planeada', optional($bitacoraSeguridad)->fec_planeada) }}" required="true" placeholder="{{ trans('bitacora_seguridads.fec_planeada__placeholder') }}">
        {!! $errors->first('fec_planeada', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_solucion') ? 'has-error' : '' }}">
    <label for="fec_solucion" class="control-label">{{ trans('bitacora_seguridads.fec_solucion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_solucion" type="text" id="fec_solucion" value="{{ old('fec_solucion', optional($bitacoraSeguridad)->fec_solucion) }}" required="true" placeholder="{{ trans('bitacora_seguridads.fec_solucion__placeholder') }}">
        {!! $errors->first('fec_solucion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-4 {{ $errors->has('grupo_id') ? 'has-error' : '' }}">
    <label for="grupo_id" class="control-label">{{ trans('bitacora_seguridads.grupo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="grupo_id" name="grupo_id" required="true">
        	    <option value="" style="display: none;" {{ old('grupo_id', optional($bitacoraSeguridad)->grupo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.grupo_id__placeholder') }}</option>
        	@foreach ($csGrupoNormas as $key => $csGrupoNorma)
			    <option value="{{ $key }}" {{ old('grupo_id', optional($bitacoraSeguridad)->grupo_id) == $key ? 'selected' : '' }}>
			    	{{ $csGrupoNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('grupo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('norma_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="norma_id" class="control-label">{{ trans('bitacora_seguridads.norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="norma_id" name="norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('norma_id', optional($bitacoraSeguridad)->norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_seguridads.norma_id__placeholder') }}</option>
        	@foreach ($csNormas as $key => $csNorma)
			    <option value="{{ $key }}" {{ old('norma_id', optional($bitacoraSeguridad)->norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('norma') ? 'has-error' : '' }}">
    <label for="norma" class="control-label">{{ trans('bitacora_seguridads.norma') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="norma" type="text" id="norma" value="{{ old('norma', optional($bitacoraSeguridad)->norma) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bitacora_seguridads.norma__placeholder') }}">
        {!! $errors->first('norma', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

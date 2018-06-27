
<div class="form-group col-md-4 {{ $errors->has('proceso_id') ? 'has-error' : '' }}">
    <label for="proceso_id" class="control-label">{{ trans('aspectos_ambientales.proceso_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="proceso_id" name="proceso_id" required="true">
        	    <option value="" style="display: none;" {{ old('proceso_id', optional($aspectosAmbientale)->proceso_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.proceso_id__placeholder') }}</option>
        	@foreach ($aaProcesos as $key => $aaProceso)
			    <option value="{{ $key }}" {{ old('proceso_id', optional($aspectosAmbientale)->proceso_id) == $key ? 'selected' : '' }}>
			    	{{ $aaProceso }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('proceso_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('aspectos_ambientales.area_id') }}</label><br/>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($aspectosAmbientale)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($aspectosAmbientale)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('actividad') ? 'has-error' : '' }}">
    <label for="actividad" class="control-label">{{ trans('aspectos_ambientales.actividad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="actividad" type="text" id="actividad" value="{{ old('actividad', optional($aspectosAmbientale)->actividad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aspectos_ambientales.actividad__placeholder') }}">
        {!! $errors->first('actividad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('aspectos_ambientales.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($aspectosAmbientale)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aspectos_ambientales.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('efecto') ? 'has-error' : '' }}">
    <label for="efecto" class="control-label">{{ trans('aspectos_ambientales.efecto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="efecto" type="text" id="efecto" value="{{ old('efecto', optional($aspectosAmbientale)->efecto) }}" minlength="1" maxlength="255" placeholder="{{ trans('aspectos_ambientales.efecto__placeholder') }}">
        {!! $errors->first('efecto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aspecto_id') ? 'has-error' : '' }}">
    <label for="aspecto_id" class="control-label">{{ trans('aspectos_ambientales.aspecto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aspecto_id" name="aspecto_id" required="true">
        	    <option value="" style="display: none;" {{ old('aspecto_id', optional($aspectosAmbientale)->aspecto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.aspecto_id__placeholder') }}</option>
        	@foreach ($aaAspectos as $key => $aaAspecto)
			    <option value="{{ $key }}" {{ old('aspecto_id', optional($aspectosAmbientale)->aspecto_id) == $key ? 'selected' : '' }}>
			    	{{ $aaAspecto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aspecto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('eme_id') ? 'has-error' : '' }}">
    <label for="eme_id" class="control-label">{{ trans('aspectos_ambientales.eme_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="eme_id" name="eme_id" required="true">
        	    <option value="" style="display: none;" {{ old('eme_id', optional($aspectosAmbientale)->eme_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.eme_id__placeholder') }}</option>
        	@foreach ($aaEmes as $key => $aaEme)
			    <option value="{{ $key }}" {{ old('eme_id', optional($aspectosAmbientale)->eme_id) == $key ? 'selected' : '' }}>
			    	{{ $aaEme }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('eme_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('condicion_id') ? 'has-error' : '' }}">
    <label for="condicion_id" class="control-label">{{ trans('aspectos_ambientales.condicion_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="condicion_id" name="condicion_id" required="true">
        	    <option value="" style="display: none;" {{ old('condicion_id', optional($aspectosAmbientale)->condicion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.condicion_id__placeholder') }}</option>
        	@foreach ($aaCondiciones as $key => $aaCondicione)
			    <option value="{{ $key }}" {{ old('condicion_id', optional($aspectosAmbientale)->condicion_id) == $key ? 'selected' : '' }}>
			    	{{ $aaCondicione }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('condicion_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('impacto_id') ? 'has-error' : '' }}">
    <label for="impacto_id" class="control-label">{{ trans('aspectos_ambientales.impacto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="impacto_id" name="impacto_id" required="true">
        	    <option value="" style="display: none;" {{ old('impacto_id', optional($aspectosAmbientale)->impacto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.impacto_id__placeholder') }}</option>
        	@foreach ($aaImpactos as $key => $aaImpacto)
			    <option value="{{ $key }}" {{ old('impacto_id', optional($aspectosAmbientale)->impacto_id) == $key ? 'selected' : '' }}>
			    	{{ $aaImpacto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('puesto_id') ? 'has-error' : '' }}">
    <label for="puesto_id" class="control-label">{{ trans('aspectos_ambientales.puesto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="puesto_id" name="puesto_id" required="true">
        	    <option value="" style="display: none;" {{ old('puesto_id', optional($aspectosAmbientale)->puesto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.puesto_id__placeholder') }}</option>
        	@foreach ($puestos as $key => $puesto)
			    <option value="{{ $key }}" {{ old('puesto_id', optional($aspectosAmbientale)->puesto_id) == $key ? 'selected' : '' }}>
			    	{{ $puesto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('puesto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="row"></div>

<div class="page-header">
    <h4>Consideraciones</h4>
</div>

<div class="form-group col-md-4 {{ $errors->has('al_federal_bnd') ? 'has-error' : '' }}">
    <label for="al_federal_bnd" class="control-label">{{ trans('aspectos_ambientales.al_federal_bnd') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="al_federal_bnd" name="al_federal_bnd" required="true">
        	    <option value="" style="display: none;" {{ old('al_federal_bnd', optional($aspectosAmbientale)->al_federal_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.al_federal_bnd__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('al_federal_bnd', optional($aspectosAmbientale)->al_federal_bnd) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('al_federal_bnd', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('al_estatal_bnd') ? 'has-error' : '' }}">
    <label for="al_estatal_bnd" class="control-label">{{ trans('aspectos_ambientales.al_estatal_bnd') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="al_estatal_bnd" name="al_estatal_bnd" required="true">
        	    <option value="" style="display: none;" {{ old('al_estatal_bnd', optional($aspectosAmbientale)->al_estatal_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.al_estatal_bnd__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('al_estatal_bnd', optional($aspectosAmbientale)->al_estatal_bnd) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('al_estatal_bnd', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('obj_corporativo_bnd') ? 'has-error' : '' }}">
    <label for="obj_corporativo_bnd" class="control-label">{{ trans('aspectos_ambientales.obj_corporativo_bnd') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="obj_corporativo_bnd" name="obj_corporativo_bnd" required="true">
        	    <option value="" style="display: none;" {{ old('obj_corporativo_bnd', optional($aspectosAmbientale)->obj_corporativo_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.obj_corporativo_bnd__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('obj_corporativo_bnd', optional($aspectosAmbientale)->obj_corporativo_bnd) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('obj_corporativo_bnd', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('quejas_bnd') ? 'has-error' : '' }}">
    <label for="quejas_bnd" class="control-label">{{ trans('aspectos_ambientales.quejas_bnd') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="quejas_bnd" name="quejas_bnd" required="true">
        	    <option value="" style="display: none;" {{ old('quejas_bnd', optional($aspectosAmbientale)->quejas_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.quejas_bnd__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('quejas_bnd', optional($aspectosAmbientale)->quejas_bnd) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('quejas_bnd', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="row"></div>

<div class="page-header">
    <h4>Calificacion del Impacto</h4>
</div>

<div class="form-group col-md-4 {{ $errors->has('severidad_id') ? 'has-error' : '' }}">
    <label for="severidad_id" class="control-label">{{ trans('aspectos_ambientales.severidad_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="severidad_id" name="severidad_id" required="true">
        	    <option value="" style="display: none;" {{ old('severidad_id', optional($aspectosAmbientale)->severidad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.severidad_id__placeholder') }}</option>
        	@foreach ($efectos as $key => $efecto)
			    <option value="{{ $key }}" {{ old('severidad_id', optional($aspectosAmbientale)->severidad_id) == $key ? 'selected' : '' }}>
			    	{{ $efecto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('severidad_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('bnd_potencial') ? 'has-error' : '' }}">
    <label for="bnd_potencial" class="control-label">{{ trans('aspectos_ambientales.bnd_potencial') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="bnd_potencial" name="bnd_potencial" required="true">
        	    <option value="" style="display: none;" {{ old('bnd_potencial', optional($aspectosAmbientale)->bnd_potencial ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.bnd_potencial__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('bnd_potencial', optional($aspectosAmbientale)->bnd_potencial) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('bnd_potencial', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('frecuencia_id') ? 'has-error' : '' }}">
    <label for="frecuencia_id" class="control-label">{{ trans('aspectos_ambientales.frecuencia_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="frecuencia_id" name="frecuencia_id" required="true">
        	    <option value="" style="display: none;" {{ old('frecuencia_id', optional($aspectosAmbientale)->frecuencia_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.frecuencia_id__placeholder') }}</option>
        	@foreach ($duracionAccions as $key => $duracionAccion)
			    <option value="{{ $key }}" {{ old('frecuencia_id', optional($aspectosAmbientale)->frecuencia_id) == $key ? 'selected' : '' }}>
			    	{{ $duracionAccion }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('frecuencia_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('bnd_real') ? 'has-error' : '' }}">
    <label for="bnd_real" class="control-label">{{ trans('aspectos_ambientales.bnd_real') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="bnd_real" name="bnd_real" required="true">
        	    <option value="" style="display: none;" {{ old('bnd_real', optional($aspectosAmbientale)->bnd_real ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.bnd_real__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('bnd_real', optional($aspectosAmbientale)->bnd_real) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('bnd_real', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('probabilidad_id') ? 'has-error' : '' }}">
    <label for="probabilidad_id" class="control-label">{{ trans('aspectos_ambientales.probabilidad_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="probabilidad_id" name="probabilidad_id" required="true">
        	    <option value="" style="display: none;" {{ old('probabilidad_id', optional($aspectosAmbientale)->probabilidad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aspectos_ambientales.probabilidad_id__placeholder') }}</option>
        	@foreach ($probabilidads as $key => $probabilidad)
			    <option value="{{ $key }}" {{ old('probabilidad_id', optional($aspectosAmbientale)->probabilidad_id) == $key ? 'selected' : '' }}>
			    	{{ $probabilidad }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('probabilidad_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('observaciones') ? 'has-error' : '' }}">
    <label for="observaciones" class="control-label">{{ trans('aspectos_ambientales.observaciones') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="observaciones" type="text" id="observaciones" value="{{ old('observaciones', optional($aspectosAmbientale)->observaciones) }}" minlength="1" maxlength="255" placeholder="{{ trans('aspectos_ambientales.observaciones__placeholder') }}">
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('ctrls_opracionales') ? 'has-error' : '' }}">
    <label for="ctrls_opracionales" class="control-label">{{ trans('aspectos_ambientales.ctrls_opracionales') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="ctrls_opracionales" type="text" id="ctrls_opracionales" value="{{ old('ctrls_opracionales', optional($aspectosAmbientale)->ctrls_opracionales) }}" minlength="1" maxlength="255" placeholder="{{ trans('aspectos_ambientales.ctrls_opracionales__placeholder') }}">
        {!! $errors->first('ctrls_opracionales', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


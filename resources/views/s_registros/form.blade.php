
<div class="form-group col-md-6 {{ $errors->has('grupo_id') ? 'has-error' : '' }}">
    <label for="grupo_id" class="control-label">{{ trans('s_registros.grupo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="grupo_id" name="grupo_id" required="true">
        	    <option value="" style="display: none;" {{ old('grupo_id', optional($sRegistro)->grupo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_registros.grupo_id__placeholder') }}</option>
        	@foreach ($csGrupoNormas as $key => $csGrupoNorma)
			    <option value="{{ $key }}" {{ old('grupo_id', optional($sRegistro)->grupo_id) == $key ? 'selected' : '' }}>
			    	{{ $csGrupoNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('grupo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('norma_id') ? 'has-error' : '' }}">
    <label for="norma_id" class="control-label">{{ trans('s_registros.norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="norma_id" name="norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('norma_id', optional($sRegistro)->norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_registros.norma_id__placeholder') }}</option>
        	@foreach ($csNormas as $key => $csNorma)
			    <option value="{{ $key }}" {{ old('norma_id', optional($sRegistro)->norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('elemento_id') ? 'has-error' : '' }}">
    <label for="elemento_id" class="control-label">{{ trans('s_registros.elemento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="elemento_id" name="elemento_id" required="true">
        	    <option value="" style="display: none;" {{ old('elemento_id', optional($sRegistro)->elemento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_registros.elemento_id__placeholder') }}</option>
        	@foreach ($csElementosInspeccions as $key => $csElementosInspeccion)
			    <option value="{{ $key }}" {{ old('elemento_id', optional($sRegistro)->elemento_id) == $key ? 'selected' : '' }}>
			    	{{ $csElementosInspeccion }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('elemento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('detalle') ? 'has-error' : '' }}">
    <label for="detalle" class="control-label">{{ trans('s_registros.detalle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="detalle" type="text" id="detalle" value="{{ old('detalle', optional($sRegistro)->detalle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_registros.detalle__placeholder') }}">
        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_registro') ? 'has-error' : '' }}">
    <label for="fec_registro" class="control-label">{{ trans('s_registros.fec_registro') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_registro" type="text" id="fec_registro" value="{{ old('fec_registro', optional($sRegistro)->fec_registro) }}" required="true" placeholder="{{ trans('s_registros.fec_registro__placeholder') }}">
        {!! $errors->first('fec_registro', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('s_registros.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($sRegistro)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_registros.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($sRegistro)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('s_registros.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($sRegistro)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('s_registros.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="responsable_id" class="control-label">{{ trans('s_registros.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($sRegistro)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_registros.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($sRegistro)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('s_registros.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($sRegistro)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('s_registros.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-4 {{ $errors->has('material_id') ? 'has-error' : '' }}">
    <label for="material_id" class="control-label">{{ trans('a_rr_amb_leyes.material_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="material_id" name="material_id" required="true">
        	    <option value="" style="display: none;" {{ old('material_id', optional($aRrAmbLeye)->material_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_amb_leyes.material_id__placeholder') }}</option>
        	@foreach ($caMaterials as $key => $caMaterial)
			    <option value="{{ $key }}" {{ old('material_id', optional($aRrAmbLeye)->material_id) == $key ? 'selected' : '' }}>
			    	{{ $caMaterial }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('categoria_id') ? 'has-error' : '' }}">
    <label for="categoria_id" class="control-label">{{ trans('a_rr_amb_leyes.categoria_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="categoria_id" name="categoria_id" required="true">
        	    <option value="" style="display: none;" {{ old('categoria_id', optional($aRrAmbLeye)->categoria_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_amb_leyes.categoria_id__placeholder') }}</option>
        	@foreach ($caCategorias as $key => $caCategorium)
			    <option value="{{ $key }}" {{ old('categoria_id', optional($aRrAmbLeye)->categoria_id) == $key ? 'selected' : '' }}>
			    	{{ $caCategorium }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
    <label for="documento_id" class="control-label">{{ trans('a_rr_amb_leyes.documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="documento_id" name="documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('documento_id', optional($aRrAmbLeye)->documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_amb_leyes.documento_id__placeholder') }}</option>
        	@foreach ($caAaDocs as $key => $caAaDoc)
			    <option value="{{ $key }}" {{ old('documento_id', optional($aRrAmbLeye)->documento_id) == $key ? 'selected' : '' }}>
			    	{{ $caAaDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('a_rr_amb_leyes.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($aRrAmbLeye)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_rr_amb_leyes.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('a_rr_amb_leyes.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($aRrAmbLeye)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('a_rr_amb_leyes.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('a_rr_amb_leyes.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($aRrAmbLeye)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_amb_leyes.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($aRrAmbLeye)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('a_rr_amb_leyes.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($aRrAmbLeye)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('a_rr_amb_leyes.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('entity_id') ? 'has-error' : '' }}">
    <label for="entity_id" class="control-label">{{ trans('a_rr_amb_leyes.entity_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="entity_id" name="entity_id" required="true">
        	    <option value="" style="display: none;" {{ old('entity_id', optional($aRrAmbLeye)->entity_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_amb_leyes.entity_id__placeholder') }}</option>
        	@foreach ($entities as $key => $entity)
			    <option value="{{ $key }}" {{ old('entity_id', optional($aRrAmbLeye)->entity_id) == $key ? 'selected' : '' }}>
			    	{{ $entity }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('entity_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-3 {{ $errors->has('activo') ? 'has-error' : '' }}">
    <label for="multi_entidad" class="control-label">{{ trans('a_rr_amb_leyes.activo') }}</label>    
        <div class="checkbox">
            <label for="activo">
            	<input id="activo" class="" name="activo" type="checkbox" value="1" {{ old('activo', optional($entity)->activo) == '1' ? 'checked' : '' }}>
                Si
            </label>
        </div>
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}    
</div>

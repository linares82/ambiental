
<div class="form-group col-md-4 {{ $errors->has('intensidad_impacto') ? 'has-error' : '' }}">
    <label for="intensidad_impacto" class="control-label">{{ trans('intensidad_impactos.intensidad_impacto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="intensidad_impacto" type="text" id="intensidad_impacto" value="{{ old('intensidad_impacto', optional($intensidadImpacto)->intensidad_impacto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('intensidad_impactos.intensidad_impacto__placeholder') }}">
        {!! $errors->first('intensidad_impacto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('intensidad_impactos.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($intensidadImpacto)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('intensidad_impactos.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($intensidadImpacto)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('intensidad_impactos.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($intensidadImpacto)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('intensidad_impactos.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($intensidadImpacto)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



<div class="form-group col-md-4 {{ $errors->has('tpo_deteccion') ? 'has-error' : '' }}">
    <label for="tpo_deteccion" class="control-label">{{ trans('cs_tpo_deteccions.tpo_deteccion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_deteccion" type="text" id="tpo_deteccion" value="{{ old('tpo_deteccion', optional($csTpoDeteccion)->tpo_deteccion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_tpo_deteccions.tpo_deteccion__placeholder') }}">
        {!! $errors->first('tpo_deteccion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('cs_tpo_deteccions.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($csTpoDeteccion)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_tpo_deteccions.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($csTpoDeteccion)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('cs_tpo_deteccions.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($csTpoDeteccion)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_tpo_deteccions.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($csTpoDeteccion)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


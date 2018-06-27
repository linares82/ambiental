
<div class="form-group col-md-4 {{ $errors->has('duracion_accion') ? 'has-error' : '' }}">
    <label for="duracion_accion" class="control-label">{{ trans('duracion_accions.duracion_accion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="duracion_accion" type="text" id="duracion_accion" value="{{ old('duracion_accion', optional($duracionAccion)->duracion_accion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('duracion_accions.duracion_accion__placeholder') }}">
        {!! $errors->first('duracion_accion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('duracion_accions.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($duracionAccion)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('duracion_accions.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($duracionAccion)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('duracion_accions.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($duracionAccion)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('duracion_accions.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($duracionAccion)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


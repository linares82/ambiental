
<div class="form-group col-md-4 {{ $errors->has('tipo_entity') ? 'has-error' : '' }}">
    <label for="tipo_entity" class="control-label">{{ trans('tipo_entities.tipo_entity') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tipo_entity" type="text" id="tipo_entity" value="{{ old('tipo_entity', optional($tipoEntity)->tipo_entity) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('tipo_entities.tipo_entity__placeholder') }}">
        {!! $errors->first('tipo_entity', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('tipo_entities.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($tipoEntity)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('tipo_entities.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($tipoEntity)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('tipo_entities.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($tipoEntity)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('tipo_entities.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($tipoEntity)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


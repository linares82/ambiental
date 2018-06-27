
<div class="form-group col-md-4 {{ $errors->has('condicion') ? 'has-error' : '' }}">
    <label for="condicion" class="control-label">{{ trans('aa_condiciones.condicion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="condicion" type="text" id="condicion" value="{{ old('condicion', optional($aaCondicione)->condicion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_condiciones.condicion__placeholder') }}">
        {!! $errors->first('condicion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('detalle') ? 'has-error' : '' }}">
    <label for="detalle" class="control-label">{{ trans('aa_condiciones.detalle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="detalle" type="text" id="detalle" value="{{ old('detalle', optional($aaCondicione)->detalle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_condiciones.detalle__placeholder') }}">
        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('aa_condiciones.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($aaCondicione)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aa_condiciones.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($aaCondicione)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('aa_condiciones.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($aaCondicione)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('aa_condiciones.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($aaCondicione)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



<div class="form-group col-md-4 {{ $errors->has('imp_potencial') ? 'has-error' : '' }}">
    <label for="imp_potencial" class="control-label">{{ trans('imp_potencials.imp_potencial') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="imp_potencial" type="text" id="imp_potencial" value="{{ old('imp_potencial', optional($impPotencial)->imp_potencial) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('imp_potencials.imp_potencial__placeholder') }}">
        {!! $errors->first('imp_potencial', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('imp_potencials.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($impPotencial)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('imp_potencials.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('imp_potencials.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($impPotencial)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('imp_potencials.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($impPotencial)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('imp_potencials.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($impPotencial)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('imp_potencials.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($impPotencial)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


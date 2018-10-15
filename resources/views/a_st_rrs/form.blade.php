
<div class="form-group col-md-4 {{ $errors->has('estatus') ? 'has-error' : '' }}">
    <label for="estatus" class="control-label">{{ trans('a_st_rrs.estatus') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="estatus" type="text" id="estatus" value="{{ old('estatus', optional($aStRr)->estatus) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_st_rrs.estatus__placeholder') }}">
        {!! $errors->first('estatus', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('avance') ? 'has-error' : '' }}">
    <label for="avance" class="control-label">{{ trans('a_st_rrs.avance') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="avance" type="number" id="avance" value="{{ old('avance', optional($aStRr)->avance) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('a_st_rrs.avance__placeholder') }}" step="any">
        {!! $errors->first('avance', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('a_st_rrs.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($aStRr)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_st_rrs.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($aStRr)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('a_st_rrs.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($aStRr)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_st_rrs.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($aStRr)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


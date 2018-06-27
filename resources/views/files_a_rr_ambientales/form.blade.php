
<div class="form-group col-md-4 {{ $errors->has('a_rr_ambiental_id') ? 'has-error' : '' }}">
    <label for="a_rr_ambiental_id" class="control-label">{{ trans('files_a_rr_ambientales.a_rr_ambiental_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_rr_ambiental_id" name="a_rr_ambiental_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_rr_ambiental_id', optional($filesARrAmbientale)->a_rr_ambiental_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_rr_ambientales.a_rr_ambiental_id__placeholder') }}</option>
        	@foreach ($aRrAmbientales as $key => $aRrAmbientale)
			    <option value="{{ $key }}" {{ old('a_rr_ambiental_id', optional($filesARrAmbientale)->a_rr_ambiental_id) == $key ? 'selected' : '' }}>
			    	{{ $aRrAmbientale }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_rr_ambiental_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('files_a_rr_ambientales.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($filesARrAmbientale)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_a_rr_ambientales.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('file_path') ? 'has-error' : '' }}">
    <label for="file_path" class="control-label">{{ trans('files_a_rr_ambientales.file_path') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="file_path" type="text" id="file_path" value="{{ old('file_path', optional($filesARrAmbientale)->file_path) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_a_rr_ambientales.file_path__placeholder') }}">
        {!! $errors->first('file_path', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('files_a_rr_ambientales.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($filesARrAmbientale)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_rr_ambientales.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($filesARrAmbientale)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('files_a_rr_ambientales.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($filesARrAmbientale)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_rr_ambientales.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($filesARrAmbientale)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


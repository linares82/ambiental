
<div class="form-group col-md-4 {{ $errors->has('a_archivo_id') ? 'has-error' : '' }}">
    <label for="a_archivo_id" class="control-label">{{ trans('files_a_archivos.a_archivo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_archivo_id" name="a_archivo_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_archivo_id', optional($filesAArchivo)->a_archivo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_archivos.a_archivo_id__placeholder') }}</option>
        	@foreach ($aArchivos as $key => $aArchivo)
			    <option value="{{ $key }}" {{ old('a_archivo_id', optional($filesAArchivo)->a_archivo_id) == $key ? 'selected' : '' }}>
			    	{{ $aArchivo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_archivo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('documento') ? 'has-error' : '' }}">
    <label for="documento" class="control-label">{{ trans('files_a_archivos.documento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="documento" type="text" id="documento" value="{{ old('documento', optional($filesAArchivo)->documento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_a_archivos.documento__placeholder') }}">
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('files_a_archivos.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($filesAArchivo)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_a_archivos.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('files_a_archivos.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($filesAArchivo)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_archivos.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($filesAArchivo)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('files_a_archivos.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($filesAArchivo)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_archivos.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($filesAArchivo)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


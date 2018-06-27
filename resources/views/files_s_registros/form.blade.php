
<div class="form-group col-md-4 {{ $errors->has('file_path') ? 'has-error' : '' }}">
    <label for="file_path" class="control-label">{{ trans('files_s_registros.file_path') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="file_path" type="text" id="file_path" value="{{ old('file_path', optional($filesSRegistro)->file_path) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_s_registros.file_path__placeholder') }}">
        {!! $errors->first('file_path', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('files_s_registros.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($filesSRegistro)->descripcion) }}" maxlength="255" placeholder="{{ trans('files_s_registros.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('s_registro_id') ? 'has-error' : '' }}">
    <label for="s_registro_id" class="control-label">{{ trans('files_s_registros.s_registro_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="s_registro_id" name="s_registro_id">
        	    <option value="" style="display: none;" {{ old('s_registro_id', optional($filesSRegistro)->s_registro_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_s_registros.s_registro_id__placeholder') }}</option>
        	@foreach ($sRegistros as $key => $sRegistro)
			    <option value="{{ $key }}" {{ old('s_registro_id', optional($filesSRegistro)->s_registro_id) == $key ? 'selected' : '' }}>
			    	{{ $sRegistro }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('s_registro_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


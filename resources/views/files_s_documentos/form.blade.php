
<div class="form-group col-md-4 {{ $errors->has('file_path') ? 'has-error' : '' }}">
    <label for="file_path" class="control-label">{{ trans('files_s_documentos.file_path') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="file_path" type="text" id="file_path" value="{{ old('file_path', optional($filesSDocumento)->file_path) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_s_documentos.file_path__placeholder') }}">
        {!! $errors->first('file_path', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('files_s_documentos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($filesSDocumento)->descripcion) }}" maxlength="255" placeholder="{{ trans('files_s_documentos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('s_documento_id') ? 'has-error' : '' }}">
    <label for="s_documento_id" class="control-label">{{ trans('files_s_documentos.s_documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="s_documento_id" name="s_documento_id">
        	    <option value="" style="display: none;" {{ old('s_documento_id', optional($filesSDocumento)->s_documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_s_documentos.s_documento_id__placeholder') }}</option>
        	@foreach ($sDocumentos as $key => $sDocumento)
			    <option value="{{ $key }}" {{ old('s_documento_id', optional($filesSDocumento)->s_documento_id) == $key ? 'selected' : '' }}>
			    	{{ $sDocumento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('s_documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


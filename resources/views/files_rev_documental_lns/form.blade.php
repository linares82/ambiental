
<div class="form-group col-md-4 {{ $errors->has('file_path') ? 'has-error' : '' }}">
    <label for="file_path" class="control-label">{{ trans('files_rev_documental_lns.file_path') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="file_path" type="text" id="file_path" value="{{ old('file_path', optional($filesRevDocumentalLn)->file_path) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_rev_documental_lns.file_path__placeholder') }}">
        {!! $errors->first('file_path', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('files_rev_documental_lns.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($filesRevDocumentalLn)->descripcion) }}" maxlength="255" placeholder="{{ trans('files_rev_documental_lns.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rev_documental_ln_id') ? 'has-error' : '' }}">
    <label for="rev_documental_ln_id" class="control-label">{{ trans('files_rev_documental_lns.rev_documental_ln_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="rev_documental_ln_id" name="rev_documental_ln_id">
        	    <option value="" style="display: none;" {{ old('rev_documental_ln_id', optional($filesRevDocumentalLn)->rev_documental_ln_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_rev_documental_lns.rev_documental_ln_id__placeholder') }}</option>
        	@foreach ($revDocumentalLns as $key => $revDocumentalLn)
			    <option value="{{ $key }}" {{ old('rev_documental_ln_id', optional($filesRevDocumentalLn)->rev_documental_ln_id) == $key ? 'selected' : '' }}>
			    	{{ $revDocumentalLn }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('rev_documental_ln_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


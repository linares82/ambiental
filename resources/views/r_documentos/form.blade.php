
<div class="form-group col-md-4 {{ $errors->has('tpo_documento_id') ? 'has-error' : '' }}">
    <label for="tpo_documento_id" class="control-label">{{ trans('r_documentos.tpo_documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_documento_id" name="tpo_documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_documento_id', optional($rDocumento)->tpo_documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('r_documentos.tpo_documento_id__placeholder') }}</option>
        	@foreach ($tpoDocs as $key => $tpoDoc)
			    <option value="{{ $key }}" {{ old('tpo_documento_id', optional($rDocumento)->tpo_documento_id) == $key ? 'selected' : '' }}>
			    	{{ $tpoDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('r_documento') ? 'has-error' : '' }}">
    <label for="r_documento" class="control-label">{{ trans('r_documentos.r_documento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="r_documento" type="text" id="r_documento" value="{{ old('r_documento', optional($rDocumento)->r_documento) }}" minlength="1" maxlength="500" required="true" placeholder="{{ trans('r_documentos.r_documento__placeholder') }}">
        {!! $errors->first('r_documento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

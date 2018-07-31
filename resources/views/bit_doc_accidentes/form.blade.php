
<div class="form-group col-md-4 {{ $errors->has('bitacora_accidente_id') ? 'has-error' : '' }}">
    <label for="bitacora_accidente_id" class="control-label">{{ trans('bit_doc_accidentes.bitacora_accidente_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="bitacora_accidente_id" name="bitacora_accidente_id" required="true">
        	    <option value="" style="display: none;" {{ old('bitacora_accidente_id', optional($bitDocAccidente)->bitacora_accidente_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bit_doc_accidentes.bitacora_accidente_id__placeholder') }}</option>
        	@foreach ($bitacoraAccidentes as $key => $bitacoraAccidente)
			    <option value="{{ $key }}" {{ old('bitacora_accidente_id', optional($bitDocAccidente)->bitacora_accidente_id) == $key ? 'selected' : '' }}>
			    	{{ $bitacoraAccidente }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('bitacora_accidente_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('documento') ? 'has-error' : '' }}">
    <label for="documento" class="control-label">{{ trans('bit_doc_accidentes.documento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="documento" type="text" id="documento" value="{{ old('documento', optional($bitDocAccidente)->documento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bit_doc_accidentes.documento__placeholder') }}">
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('bit_doc_accidentes.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($bitDocAccidente)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bit_doc_accidentes.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


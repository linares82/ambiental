
<div class="form-group col-md-4 {{ $errors->has('bitacora_enfermedade_id') ? 'has-error' : '' }}">
    <label for="bitacora_enfermedade_id" class="control-label">{{ trans('bit_doc_enfermedades.bitacora_enfermedade_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="bitacora_enfermedade_id" name="bitacora_enfermedade_id" required="true">
        	    <option value="" style="display: none;" {{ old('bitacora_enfermedade_id', optional($bitDocEnfermedade)->bitacora_enfermedade_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bit_doc_enfermedades.bitacora_enfermedade_id__placeholder') }}</option>
        	@foreach ($bitacoraEnfermedades as $key => $bitacoraEnfermedade)
			    <option value="{{ $key }}" {{ old('bitacora_enfermedade_id', optional($bitDocEnfermedade)->bitacora_enfermedade_id) == $key ? 'selected' : '' }}>
			    	{{ $bitacoraEnfermedade }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('bitacora_enfermedade_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('documento') ? 'has-error' : '' }}">
    <label for="documento" class="control-label">{{ trans('bit_doc_enfermedades.documento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="documento" type="text" id="documento" value="{{ old('documento', optional($bitDocEnfermedade)->documento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bit_doc_enfermedades.documento__placeholder') }}">
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('bit_doc_enfermedades.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($bitDocEnfermedade)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bit_doc_enfermedades.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


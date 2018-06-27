
<div class="form-group col-md-4 {{ $errors->has('tpo_bitacora_id') ? 'has-error' : '' }}">
    <label for="tpo_bitacora_id" class="control-label">{{ trans('cs_tpo_inconformidades.tpo_bitacora_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_bitacora_id" name="tpo_bitacora_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_bitacora_id', optional($csTpoInconformidade)->tpo_bitacora_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_tpo_inconformidades.tpo_bitacora_id__placeholder') }}</option>
        	@foreach ($csTpoBitacoras as $key => $csTpoBitacora)
			    <option value="{{ $key }}" {{ old('tpo_bitacora_id', optional($csTpoInconformidade)->tpo_bitacora_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoBitacora }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_bitacora_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_inconformidad') ? 'has-error' : '' }}">
    <label for="tpo_inconformidad" class="control-label">{{ trans('cs_tpo_inconformidades.tpo_inconformidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_inconformidad" type="text" id="tpo_inconformidad" value="{{ old('tpo_inconformidad', optional($csTpoInconformidade)->tpo_inconformidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_tpo_inconformidades.tpo_inconformidad__placeholder') }}">
        {!! $errors->first('tpo_inconformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

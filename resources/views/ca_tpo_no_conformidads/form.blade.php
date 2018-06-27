
<div class="form-group col-md-4 {{ $errors->has('tpo_bitacora_id') ? 'has-error' : '' }}">
    <label for="tpo_bitacora_id" class="control-label">{{ trans('ca_tpo_no_conformidads.tpo_bitacora_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_bitacora_id" name="tpo_bitacora_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_bitacora_id', optional($caTpoNoConformidad)->tpo_bitacora_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_tpo_no_conformidads.tpo_bitacora_id__placeholder') }}</option>
        	@foreach ($caTpoBitacoras as $key => $caTpoBitacora)
			    <option value="{{ $key }}" {{ old('tpo_bitacora_id', optional($caTpoNoConformidad)->tpo_bitacora_id) == $key ? 'selected' : '' }}>
			    	{{ $caTpoBitacora }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_bitacora_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_inconformidad') ? 'has-error' : '' }}">
    <label for="tpo_inconformidad" class="control-label">{{ trans('ca_tpo_no_conformidads.tpo_inconformidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_inconformidad" type="text" id="tpo_inconformidad" value="{{ old('tpo_inconformidad', optional($caTpoNoConformidad)->tpo_inconformidad) }}" minlength="1" maxlength="500" required="true" placeholder="{{ trans('ca_tpo_no_conformidads.tpo_inconformidad__placeholder') }}">
        {!! $errors->first('tpo_inconformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


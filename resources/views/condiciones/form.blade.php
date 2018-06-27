
<div class="form-group col-md-4 {{ $errors->has('impacto_id') ? 'has-error' : '' }}">
    <label for="impacto_id" class="control-label">{{ trans('condiciones.impacto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="impacto_id" name="impacto_id" required="true">
        	    <option value="" style="display: none;" {{ old('impacto_id', optional($condicione)->impacto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('condiciones.impacto_id__placeholder') }}</option>
        	@foreach ($aaImpactos as $key => $aaImpacto)
			    <option value="{{ $key }}" {{ old('impacto_id', optional($condicione)->impacto_id) == $key ? 'selected' : '' }}>
			    	{{ $aaImpacto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('condicion') ? 'has-error' : '' }}">
    <label for="condicion" class="control-label">{{ trans('condiciones.condicion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="condicion" type="text" id="condicion" value="{{ old('condicion', optional($condicione)->condicion) }}" minlength="1" maxlength="500" required="true" placeholder="{{ trans('condiciones.condicion__placeholder') }}">
        {!! $errors->first('condicion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


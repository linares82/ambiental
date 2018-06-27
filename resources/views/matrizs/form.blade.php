
<div class="form-group col-md-4 {{ $errors->has('tipo_impacto_id') ? 'has-error' : '' }}">
    <label for="tipo_impacto_id" class="control-label">{{ trans('matrizs.tipo_impacto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tipo_impacto_id" name="tipo_impacto_id" required="true">
        	    <option value="" style="display: none;" {{ old('tipo_impacto_id', optional($matriz)->tipo_impacto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.tipo_impacto_id__placeholder') }}</option>
        	@foreach ($tipoImpactos as $key => $tipoImpacto)
			    <option value="{{ $key }}" {{ old('tipo_impacto_id', optional($matriz)->tipo_impacto_id) == $key ? 'selected' : '' }}>
			    	{{ $tipoImpacto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tipo_impacto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('factor_id') ? 'has-error' : '' }}">
    <label for="factor_id" class="control-label">{{ trans('matrizs.factor_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="factor_id" name="factor_id" required="true">
        	    <option value="" style="display: none;" {{ old('factor_id', optional($matriz)->factor_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.factor_id__placeholder') }}</option>
        	@foreach ($factors as $key => $factor)
			    <option value="{{ $key }}" {{ old('factor_id', optional($matriz)->factor_id) == $key ? 'selected' : '' }}>
			    	{{ $factor }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('factor_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rubro_id') ? 'has-error' : '' }}">
    <label for="rubro_id" class="control-label">{{ trans('matrizs.rubro_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="rubro_id" name="rubro_id" required="true">
        	    <option value="" style="display: none;" {{ old('rubro_id', optional($matriz)->rubro_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.rubro_id__placeholder') }}</option>
        	@foreach ($rubros as $key => $rubro)
			    <option value="{{ $key }}" {{ old('rubro_id', optional($matriz)->rubro_id) == $key ? 'selected' : '' }}>
			    	{{ $rubro }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('rubro_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('especifico_id') ? 'has-error' : '' }}">
    <label for="especifico_id" class="control-label">{{ trans('matrizs.especifico_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="especifico_id" name="especifico_id" required="true">
        	    <option value="" style="display: none;" {{ old('especifico_id', optional($matriz)->especifico_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('matrizs.especifico_id__placeholder') }}</option>
        	@foreach ($especificos as $key => $especifico)
			    <option value="{{ $key }}" {{ old('especifico_id', optional($matriz)->especifico_id) == $key ? 'selected' : '' }}>
			    	{{ $especifico }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('especifico_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

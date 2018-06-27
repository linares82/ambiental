
<div class="form-group col-md-4 {{ $errors->has('impacto_id') ? 'has-error' : '' }}">
    <label for="impacto_id" class="control-label">{{ trans('rev_requisitos_lns.impacto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="impacto_id" name="impacto_id" required="true">
        	    <option value="" style="display: none;" {{ old('impacto_id', optional($revRequisitosLn)->impacto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos_lns.impacto_id__placeholder') }}</option>
        	@foreach ($aaImpactos as $key => $aaImpacto)
			    <option value="{{ $key }}" {{ old('impacto_id', optional($revRequisitosLn)->impacto_id) == $key ? 'selected' : '' }}>
			    	{{ $aaImpacto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('condicion_id') ? 'has-error' : '' }}">
    <label for="condicion_id" class="control-label">{{ trans('rev_requisitos_lns.condicion_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="condicion_id" name="condicion_id" required="true">
        	    <option value="" style="display: none;" {{ old('condicion_id', optional($revRequisitosLn)->condicion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos_lns.condicion_id__placeholder') }}</option>
        	@foreach ($condiciones as $key => $condicione)
			    <option value="{{ $key }}" {{ old('condicion_id', optional($revRequisitosLn)->condicion_id) == $key ? 'selected' : '' }}>
			    	{{ $condicione }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('condicion_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('rev_requisitos_lns.area_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($revRequisitosLn)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos_lns.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($revRequisitosLn)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('norma') ? 'has-error' : '' }}">
    <label for="norma" class="control-label">{{ trans('rev_requisitos_lns.norma') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="norma" type="text" id="norma" value="{{ old('norma', optional($revRequisitosLn)->norma) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('rev_requisitos_lns.norma__placeholder') }}">
        {!! $errors->first('norma', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
    <label for="estatus_id" class="control-label">{{ trans('rev_requisitos_lns.estatus_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="estatus_id" name="estatus_id" required="true">
        	    <option value="" style="display: none;" {{ old('estatus_id', optional($revRequisitosLn)->estatus_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos_lns.estatus_id__placeholder') }}</option>
        	@foreach ($estatusCondiciones as $key => $estatusCondicione)
			    <option value="{{ $key }}" {{ old('estatus_id', optional($revRequisitosLn)->estatus_id) == $key ? 'selected' : '' }}>
			    	{{ $estatusCondicione }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('importancia_id') ? 'has-error' : '' }}">
    <label for="importancia_id" class="control-label">{{ trans('rev_requisitos_lns.importancia_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="importancia_id" name="importancia_id" required="true">
        	    <option value="" style="display: none;" {{ old('importancia_id', optional($revRequisitosLn)->importancia_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos_lns.importancia_id__placeholder') }}</option>
        	@foreach ($importancia as $key => $importancium)
			    <option value="{{ $key }}" {{ old('importancia_id', optional($revRequisitosLn)->importancia_id) == $key ? 'selected' : '' }}>
			    	{{ $importancium }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('importancia_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('rev_requisitos_lns.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($revRequisitosLn)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos_lns.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($revRequisitosLn)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_advertencia1') ? 'has-error' : '' }}">
    <label for="dias_advertencia1" class="control-label">{{ trans('rev_requisitos_lns.dias_advertencia1') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_advertencia1" type="number" id="dias_advertencia1" value="{{ old('dias_advertencia1', optional($revRequisitosLn)->dias_advertencia1) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_requisitos_lns.dias_advertencia1__placeholder') }}">
        {!! $errors->first('dias_advertencia1', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_advertencia2') ? 'has-error' : '' }}">
    <label for="dias_advertencia2" class="control-label">{{ trans('rev_requisitos_lns.dias_advertencia2') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_advertencia2" type="number" id="dias_advertencia2" value="{{ old('dias_advertencia2', optional($revRequisitosLn)->dias_advertencia2) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_requisitos_lns.dias_advertencia2__placeholder') }}">
        {!! $errors->first('dias_advertencia2', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_advertencia3') ? 'has-error' : '' }}">
    <label for="dias_advertencia3" class="control-label">{{ trans('rev_requisitos_lns.dias_advertencia3') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_advertencia3" type="number" id="dias_advertencia3" value="{{ old('dias_advertencia3', optional($revRequisitosLn)->dias_advertencia3) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_requisitos_lns.dias_advertencia3__placeholder') }}">
        {!! $errors->first('dias_advertencia3', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_cumplimiento') ? 'has-error' : '' }}">
    <label for="fec_cumplimiento" class="control-label">{{ trans('rev_requisitos_lns.fec_cumplimiento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_cumplimiento" type="text" id="fec_cumplimiento" value="{{ old('fec_cumplimiento', optional($revRequisitosLn)->fec_cumplimiento) }}" required="true" placeholder="{{ trans('rev_requisitos_lns.fec_cumplimiento__placeholder') }}">
        {!! $errors->first('fec_cumplimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('observaciones') ? 'has-error' : '' }}">
    <label for="observaciones" class="control-label">{{ trans('rev_requisitos_lns.observaciones') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="observaciones" type="text" id="observaciones" value="{{ old('observaciones', optional($revRequisitosLn)->observaciones) }}" minlength="1" maxlength="255" placeholder="{{ trans('rev_requisitos_lns.observaciones__placeholder') }}">
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

@push('scripts')
<script type="text/javascript">
    
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });
</script>
@endpush    
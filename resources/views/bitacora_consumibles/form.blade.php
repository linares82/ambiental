
<div class="form-group col-md-4 {{ $errors->has('consumible_id') ? 'has-error' : '' }}">
    <label for="consumible_id" class="control-label">{{ trans('bitacora_consumibles.consumible_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="consumible_id" name="consumible_id" required="true">
        	    <option value="" style="display: none;" {{ old('consumible_id', optional($bitacoraConsumible)->consumible_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_consumibles.consumible_id__placeholder') }}</option>
        	@foreach ($caConsumibles as $key => $caConsumible)
			    <option value="{{ $key }}" {{ old('consumible_id', optional($bitacoraConsumible)->consumible_id) == $key ? 'selected' : '' }}>
			    	{{ $caConsumible }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('consumible_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('consumo') ? 'has-error' : '' }}">
    <label for="consumo" class="control-label">{{ trans('bitacora_consumibles.consumo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="consumo" type="number" id="consumo" value="{{ old('consumo', optional($bitacoraConsumible)->consumo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_consumibles.consumo__placeholder') }}" step="any">
        {!! $errors->first('consumo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fecha') ? 'has-error' : '' }}">
    <label for="fecha" class="control-label">{{ trans('bitacora_consumibles.fecha') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fecha" type="text" id="fecha" value="{{ old('fecha', optional($bitacoraConsumible)->fecha) }}" required="true" placeholder="{{ trans('bitacora_consumibles.fecha__placeholder') }}">
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-4 {{ $errors->has('costo') ? 'has-error' : '' }}" style="clear:left;">
    <label for="costo" class="control-label">{{ trans('bitacora_consumibles.costo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo" type="number" id="costo" value="{{ old('costo', optional($bitacoraConsumible)->costo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_consumibles.costo__placeholder') }}" step="any">
        {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_inicio') ? 'has-error' : '' }}">
    <label for="fec_inicio" class="control-label">{{ trans('bitacora_consumibles.fec_inicio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_inicio" type="text" id="fec_inicio" value="{{ old('fec_inicio', optional($bitacoraConsumible)->fec_inicio) }}" required="true" placeholder="{{ trans('bitacora_consumibles.fec_inicio__placeholder') }}">
        {!! $errors->first('fec_inicio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin') ? 'has-error' : '' }}">
    <label for="fec_fin" class="control-label">{{ trans('bitacora_consumibles.fec_fin') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin" type="text" id="fec_fin" value="{{ old('fec_fin', optional($bitacoraConsumible)->fec_fin) }}" required="true" placeholder="{{ trans('bitacora_consumibles.fec_fin__placeholder') }}">
        {!! $errors->first('fec_fin', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('factor_indicador') ? 'has-error' : '' }}">
    <label for="factor_indicador" class="control-label">{{ trans('bitacora_consumibles.factor_indicador') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="factor_indicador" type="number" id="factor_indicador" value="{{ old('factor_indicador', optional($bitacoraConsumible)->factor_indicador) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_consumibles.factor_indicador__placeholder') }}" step="any">
        {!! $errors->first('factor_indicador', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('factor_calculado') ? 'has-error' : '' }}">
    <label for="factor_calculado" class="control-label">{{ trans('bitacora_consumibles.factor_calculado') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="factor_calculado" type="number" id="factor_calculado" value="{{ old('factor_calculado', optional($bitacoraConsumible)->factor_calculado) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('bitacora_consumibles.factor_calculado__placeholder') }}" step="any">
        {!! $errors->first('factor_calculado', '<p class="help-block">:message</p>') !!}
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
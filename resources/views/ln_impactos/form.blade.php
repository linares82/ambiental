

<div class="form-group col-md-4 {{ $errors->has('factor_id') ? 'has-error' : '' }}">
    <label for="factor_id" class="control-label">{{ trans('ln_impactos.factor_id') }}</label>
    <!--<div class="col-md-10">-->
    <select class="form-control chosen" id="factor_id" name="factor_id" required="true">
        <option value="" style="display: none;" {{ old('factor_id', optional($lnImpacto)->factor_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_impactos.factor_id__placeholder') }}</option>
        @foreach ($factors as $key => $factor)
        <option value="{{ $key }}" {{ old('factor_id', optional($lnImpacto)->factor_id) == $key ? 'selected' : '' }}>
                {{ $factor }}
    </option>
    @endforeach
</select>

{!! $errors->first('factor_id', '<p class="help-block">:message</p>') !!}
<!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rubro_id') ? 'has-error' : '' }}">
    <label for="rubro_id" class="control-label">{{ trans('ln_impactos.rubro_id') }}</label>
    <!--<div class="col-md-10">-->
    <select class="form-control chosen" id="rubro_id" name="rubro_id" required="true">
        <option value="" style="display: none;" {{ old('rubro_id', optional($lnImpacto)->rubro_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_impactos.rubro_id__placeholder') }}</option>
        @foreach ($rubros as $key => $rubro)
        <option value="{{ $key }}" {{ old('rubro_id', optional($lnImpacto)->rubro_id) == $key ? 'selected' : '' }}>
                {{ $rubro }}
    </option>
    @endforeach
</select>

{!! $errors->first('rubro_id', '<p class="help-block">:message</p>') !!}
<!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('especifico_id') ? 'has-error' : '' }}">
    <label for="especifico_id" class="control-label">{{ trans('ln_impactos.especifico_id') }}</label>
    <!--<div class="col-md-10">-->
    <select class="form-control chosen" id="especifico_id" name="especifico_id" required="true">
        <option value="" style="display: none;" {{ old('especifico_id', optional($lnImpacto)->especifico_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_impactos.especifico_id__placeholder') }}</option>
        @foreach ($especificos as $key => $especifico)
        <option value="{{ $key }}" {{ old('especifico_id', optional($lnImpacto)->especifico_id) == $key ? 'selected' : '' }}>
                {{ $especifico }}
    </option>
    @endforeach
</select>

{!! $errors->first('especifico_id', '<p class="help-block">:message</p>') !!}
<!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
    <label for="estatus_id" class="control-label">{{ trans('ln_impactos.estatus_id') }}</label>
    <!--<div class="col-md-10">-->
    <select class="form-control chosen" id="estatus_id" name="estatus_id" required="true">
        <option value="" style="display: none;" {{ old('estatus_id', optional($lnImpacto)->estatus_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_impactos.estatus_id__placeholder') }}</option>
        @foreach ($stRegImpactos as $key => $stRegImpacto)
        <option value="{{ $key }}" {{ old('estatus_id', optional($lnImpacto)->estatus_id) == $key ? 'selected' : '' }}>
                {{ $stRegImpacto }}
    </option>
    @endforeach
</select>

{!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
<!--</div>-->
</div>


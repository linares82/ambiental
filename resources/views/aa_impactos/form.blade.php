
<div class="form-group col-md-4 {{ $errors->has('impacto') ? 'has-error' : '' }}">
    <label for="impacto" class="control-label">{{ trans('aa_impactos.impacto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="impacto" type="text" id="impacto" value="{{ old('impacto', optional($aaImpacto)->impacto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_impactos.impacto__placeholder') }}">
        {!! $errors->first('impacto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('detalle') ? 'has-error' : '' }}">
    <label for="detalle" class="control-label">{{ trans('aa_impactos.detalle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="detalle" type="text" id="detalle" value="{{ old('detalle', optional($aaImpacto)->detalle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_impactos.detalle__placeholder') }}">
        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


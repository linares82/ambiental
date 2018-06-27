
<div class="form-group col-md-4 {{ $errors->has('consumible') ? 'has-error' : '' }}">
    <label for="consumible" class="control-label">{{ trans('ca_consumibles.consumible') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="consumible" type="text" id="consumible" value="{{ old('consumible', optional($caConsumible)->consumible) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_consumibles.consumible__placeholder') }}">
        {!! $errors->first('consumible', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('unidad') ? 'has-error' : '' }}">
    <label for="unidad" class="control-label">{{ trans('ca_consumibles.unidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="unidad" type="text" id="unidad" value="{{ old('unidad', optional($caConsumible)->unidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_consumibles.unidad__placeholder') }}">
        {!! $errors->first('unidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

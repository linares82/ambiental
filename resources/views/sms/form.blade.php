
<div class="form-group col-md-4 {{ $errors->has('monto') ? 'has-error' : '' }}">
    <label for="monto" class="control-label">{{ trans('sms.monto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="monto" type="number" id="monto" value="{{ old('monto', optional($sm)->monto) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('sms.monto__placeholder') }}" step="any">
        {!! $errors->first('monto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


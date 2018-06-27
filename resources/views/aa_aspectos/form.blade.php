
<div class="form-group col-md-4 {{ $errors->has('aspectos') ? 'has-error' : '' }}">
    <label for="aspectos" class="control-label">{{ trans('aa_aspectos.aspectos') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="aspectos" type="text" id="aspectos" value="{{ old('aspectos', optional($aaAspecto)->aspectos) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_aspectos.aspectos__placeholder') }}">
        {!! $errors->first('aspectos', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('detalle') ? 'has-error' : '' }}">
    <label for="detalle" class="control-label">{{ trans('aa_aspectos.detalle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="detalle" type="text" id="detalle" value="{{ old('detalle', optional($aaAspecto)->detalle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_aspectos.detalle__placeholder') }}">
        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



<div class="form-group col-md-4 {{ $errors->has('especifico') ? 'has-error' : '' }}">
    <label for="especifico" class="col-md-2 control-label">{{ trans('especificos.especifico') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="especifico" type="text" id="especifico" value="{{ old('especifico', optional($especifico)->especifico) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('especificos.especifico__placeholder') }}">
        {!! $errors->first('especifico', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

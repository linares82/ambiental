
<div class="form-group col-md-4 {{ $errors->has('area') ? 'has-error' : '' }}">
    <label for="area" class="control-label">{{ trans('a_checks.area') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="area" type="text" id="area" value="{{ old('area', optional($aCheck)->area) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_checks.area__placeholder') }}">
        {!! $errors->first('area', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


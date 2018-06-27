
<div class="form-group col-md-4 {{ $errors->has('norma') ? 'has-error' : '' }}">
    <label for="norma" class="control-label">{{ trans('normas.norma') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="norma" type="text" id="norma" value="{{ old('norma', optional($norma)->norma) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('normas.norma__placeholder') }}">
        {!! $errors->first('norma', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

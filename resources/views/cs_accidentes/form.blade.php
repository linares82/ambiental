
<div class="form-group col-md-4 {{ $errors->has('accidente') ? 'has-error' : '' }}">
    <label for="accidente" class="control-label">{{ trans('cs_accidentes.accidente') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="accidente" type="text" id="accidente" value="{{ old('accidente', optional($csAccidente)->accidente) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_accidentes.accidente__placeholder') }}">
        {!! $errors->first('accidente', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


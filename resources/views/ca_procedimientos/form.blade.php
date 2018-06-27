
<div class="form-group col-md-4 {{ $errors->has('procedimiento') ? 'has-error' : '' }}">
    <label for="procedimiento" class="control-label">{{ trans('ca_procedimientos.procedimiento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="procedimiento" type="text" id="procedimiento" value="{{ old('procedimiento', optional($caProcedimiento)->procedimiento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_procedimientos.procedimiento__placeholder') }}">
        {!! $errors->first('procedimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


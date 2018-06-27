
<div class="form-group col-md-4 {{ $errors->has('tpo_procedimiento') ? 'has-error' : '' }}">
    <label for="tpo_procedimiento" class="control-label">{{ trans('cs_tpo_procedimientos.tpo_procedimiento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_procedimiento" type="text" id="tpo_procedimiento" value="{{ old('tpo_procedimiento', optional($csTpoProcedimiento)->tpo_procedimiento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_tpo_procedimientos.tpo_procedimiento__placeholder') }}">
        {!! $errors->first('tpo_procedimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

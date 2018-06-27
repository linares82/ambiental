
<div class="form-group col-md-4 {{ $errors->has('clase_manto') ? 'has-error' : '' }}">
    <label for="clase_manto" class="control-label">{{ trans('m_clase_mantos.clase_manto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="clase_manto" type="text" id="clase_manto" value="{{ old('clase_manto', optional($mClaseManto)->clase_manto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_clase_mantos.clase_manto__placeholder') }}">
        {!! $errors->first('clase_manto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


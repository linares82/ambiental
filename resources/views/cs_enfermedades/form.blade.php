
<div class="form-group col-md-4 {{ $errors->has('enfermedad') ? 'has-error' : '' }}">
    <label for="enfermedad" class="control-label">{{ trans('cs_enfermedades.enfermedad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="enfermedad" type="text" id="enfermedad" value="{{ old('enfermedad', optional($csEnfermedade)->enfermedad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_enfermedades.enfermedad__placeholder') }}">
        {!! $errors->first('enfermedad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

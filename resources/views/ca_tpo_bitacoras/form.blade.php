
<div class="form-group col-md-4 {{ $errors->has('tpo_bitacora') ? 'has-error' : '' }}">
    <label for="tpo_bitacora" class="control-label">{{ trans('ca_tpo_bitacoras.tpo_bitacora') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_bitacora" type="text" id="tpo_bitacora" value="{{ old('tpo_bitacora', optional($caTpoBitacora)->tpo_bitacora) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_tpo_bitacoras.tpo_bitacora__placeholder') }}">
        {!! $errors->first('tpo_bitacora', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

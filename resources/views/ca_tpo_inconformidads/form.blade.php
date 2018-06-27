
<div class="form-group col-md-4 {{ $errors->has('tpo_inconformidad') ? 'has-error' : '' }}">
    <label for="tpo_inconformidad" class="control-label">{{ trans('ca_tpo_inconformidads.tpo_inconformidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_inconformidad" type="text" id="tpo_inconformidad" value="{{ old('tpo_inconformidad', optional($caTpoInconformidad)->tpo_inconformidad) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_tpo_inconformidads.tpo_inconformidad__placeholder') }}">
        {!! $errors->first('tpo_inconformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


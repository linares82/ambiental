
<div class="form-group col-md-4 {{ $errors->has('tpo_manto') ? 'has-error' : '' }}">
    <label for="tpo_manto" class="control-label">{{ trans('m_tpo_mantos.tpo_manto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_manto" type="text" id="tpo_manto" value="{{ old('tpo_manto', optional($mTpoManto)->tpo_manto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_tpo_mantos.tpo_manto__placeholder') }}">
        {!! $errors->first('tpo_manto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


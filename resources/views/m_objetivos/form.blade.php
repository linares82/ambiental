
<div class="form-group col-md-4 {{ $errors->has('objetivo') ? 'has-error' : '' }}">
    <label for="objetivo" class="control-label">{{ trans('m_objetivos.objetivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="objetivo" type="text" id="objetivo" value="{{ old('objetivo', optional($mObjetivo)->objetivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_objetivos.objetivo__placeholder') }}">
        {!! $errors->first('objetivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

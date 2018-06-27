
<div class="form-group col-md-4 {{ $errors->has('caracteristica') ? 'has-error' : '' }}">
    <label for="caracteristica" class="col-md-2 control-label">{{ trans('caracteristicas.caracteristica') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="caracteristica" type="text" id="caracteristica" value="{{ old('caracteristica', optional($caracteristica)->caracteristica) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('caracteristicas.caracteristica__placeholder') }}">
        {!! $errors->first('caracteristica', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


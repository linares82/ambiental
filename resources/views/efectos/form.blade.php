
<div class="form-group col-md-4 {{ $errors->has('efecto') ? 'has-error' : '' }}">
    <label for="efecto" class="control-label">{{ trans('efectos.efecto') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="efecto" type="text" id="efecto" value="{{ old('efecto', optional($efecto)->efecto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('efectos.efecto__placeholder') }}">
        {!! $errors->first('efecto', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('efectos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($efecto)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('efectos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


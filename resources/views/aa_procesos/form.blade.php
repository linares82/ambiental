
<div class="form-group col-md-4 {{ $errors->has('proceso') ? 'has-error' : '' }}">
    <label for="proceso" class="control-label">{{ trans('aa_procesos.proceso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="proceso" type="text" id="proceso" value="{{ old('proceso', optional($aaProceso)->proceso) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_procesos.proceso__placeholder') }}">
        {!! $errors->first('proceso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('detalle') ? 'has-error' : '' }}">
    <label for="detalle" class="control-label">{{ trans('aa_procesos.detalle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="detalle" type="text" id="detalle" value="{{ old('detalle', optional($aaProceso)->detalle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('aa_procesos.detalle__placeholder') }}">
        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


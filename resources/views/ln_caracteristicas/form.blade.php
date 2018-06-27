
    <div class="form-group col-md-12 {{ $errors->has('efecto_id') ? 'has-error' : '' }}">
        <label for="efecto_id" class="control-label">{{ trans('ln_caracteristicas.efecto_id') }}</label>
        <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="efecto_id" name="efecto_id" required="true" style="width:100%;">
            <option value="" style="display: none;" {{ old('efecto_id', optional($lnCaracteristica)->efecto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.efecto_id__placeholder') }}</option>
            @foreach ($efectos as $key => $efecto)
            <option value="{{ $key }}" {{ old('efecto_id', optional($lnCaracteristica)->efecto_id) == $key ? 'selected' : '' }}>
                    {{ $efecto }}
        </option>
        @endforeach
    </select>

    {!! $errors->first('efecto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('ln_caracteristicas.descripcion') }}</label>
    <!--<div class="col-md-10">-->
    <textArea class="form-control input-sm " rows="3" name="descripcion" type="text" id="descripcion">
                                    {{ old('descripcion', optional($lnCaracteristica)->descripcion) }}
                                </textArea>
                                {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('resarcion') ? 'has-error' : '' }}">
                                <label for="resarcion" class="control-label">{{ trans('ln_caracteristicas.resarcion') }}</label>
                                <!--<div class="col-md-10">-->
                                <textarea class="form-control input-sm " name="resarcion" type="text" id="resarcion" rows="3">
                                    {{ old('resarcion', optional($lnCaracteristica)->resarcion) }}
                                </textarea>
                                {!! $errors->first('resarcion', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('emision_efecto_id') ? 'has-error' : '' }}">
                                <label for="emision_efecto_id" class="control-label">{{ trans('ln_caracteristicas.emision_efecto_id') }}</label>
                                <!--<div class="col-md-10">-->
                                <select class="form-control chosen" id="emision_efecto_id" name="emision_efecto_id" required="true">
                                    <option value="" style="display: none;" {{ old('emision_efecto_id', optional($lnCaracteristica)->emision_efecto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.emision_efecto_id__placeholder') }}</option>
                                    @foreach ($emisionEfectos as $key => $emisionEfecto)
                                    <option value="{{ $key }}" {{ old('emision_efecto_id', optional($lnCaracteristica)->emision_efecto_id) == $key ? 'selected' : '' }}>
                                            {{ $emisionEfecto }}
                                </option>
                                @endforeach
                            </select>

                                {!! $errors->first('emision_efecto_id', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('duracion_accion_id') ? 'has-error' : '' }}">
                                    <label for="duracion_accion_id" class="control-label">{{ trans('ln_caracteristicas.duracion_accion_id') }}</label>
                                    <!--<div class="col-md-10">-->
                                    <select class="form-control chosen" id="duracion_accion_id" name="duracion_accion_id" required="true">
                                        <option value="" style="display: none;" {{ old('duracion_accion_id', optional($lnCaracteristica)->duracion_accion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.duracion_accion_id__placeholder') }}</option>
                                        @foreach ($duracionAccions as $key => $duracionAccion)
                                        <option value="{{ $key }}" {{ old('duracion_accion_id', optional($lnCaracteristica)->duracion_accion_id) == $key ? 'selected' : '' }}>
                                                {{ $duracionAccion }}
                                    </option>
                                    @endforeach
                                </select>

                                {!! $errors->first('duracion_accion_id', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('continuidad_efecto_id') ? 'has-error' : '' }}">
                                <label for="continuidad_efecto_id" class="control-label">{{ trans('ln_caracteristicas.continuidad_efecto_id') }}</label>
                                <!--<div class="col-md-10">-->
                                <select class="form-control chosen" id="continuidad_efecto_id" name="continuidad_efecto_id" required="true">
                                    <option value="" style="display: none;" {{ old('continuidad_efecto_id', optional($lnCaracteristica)->continuidad_efecto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.continuidad_efecto_id__placeholder') }}</option>
                                    @foreach ($continuidadEfectos as $key => $continuidadEfecto)
                                    <option value="{{ $key }}" {{ old('continuidad_efecto_id', optional($lnCaracteristica)->continuidad_efecto_id) == $key ? 'selected' : '' }}>
                                            {{ $continuidadEfecto }}
                                </option>
                                @endforeach
                            </select>

                                {!! $errors->first('continuidad_efecto_id', '<p class="help-block">:message</p>') !!}
                                <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('reversibilidad_id') ? 'has-error' : '' }}">
                                <label for="reversibilidad_id" class="control-label">{{ trans('ln_caracteristicas.reversibilidad_id') }}</label>
                                <!--<div class="col-md-10">-->
                                <select class="form-control chosen" id="reversibilidad_id" name="reversibilidad_id" required="true">
                                    <option value="" style="display: none;" {{ old('reversibilidad_id', optional($lnCaracteristica)->reversibilidad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.reversibilidad_id__placeholder') }}</option>
                                    @foreach ($reversibilidads as $key => $reversibilidad)
                                    <option value="{{ $key }}" {{ old('reversibilidad_id', optional($lnCaracteristica)->reversibilidad_id) == $key ? 'selected' : '' }}>
                                            {{ $reversibilidad }}
                                </option>
                                @endforeach
                            </select>

                            {!! $errors->first('reversibilidad_id', '<p class="help-block">:message</p>') !!}
                            <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('probabilidad_id') ? 'has-error' : '' }}">
                                <label for="probabilidad_id" class="control-label">{{ trans('ln_caracteristicas.probabilidad_id') }}</label>
                                <!--<div class="col-md-10">-->
                                <select class="form-control chosen" id="probabilidad_id" name="probabilidad_id" required="true">
                                    <option value="" style="display: none;" {{ old('probabilidad_id', optional($lnCaracteristica)->probabilidad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.probabilidad_id__placeholder') }}</option>
                                    @foreach ($probabilidads as $key => $probabilidad)
                                    <option value="{{ $key }}" {{ old('probabilidad_id', optional($lnCaracteristica)->probabilidad_id) == $key ? 'selected' : '' }}>
                                            {{ $probabilidad }}
                                </option>
                                @endforeach
                            </select>

                            {!! $errors->first('probabilidad_id', '<p class="help-block">:message</p>') !!}
                            <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('mitigacion_id') ? 'has-error' : '' }}">
                                <label for="mitigacion_id" class="control-label">{{ trans('ln_caracteristicas.mitigacion_id') }}</label>
                                <!--<div class="col-md-10">-->
                                <select class="form-control chosen" id="mitigacion_id" name="mitigacion_id" required="true">
                                    <option value="" style="display: none;" {{ old('mitigacion_id', optional($lnCaracteristica)->mitigacion_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.mitigacion_id__placeholder') }}</option>
                                    @foreach ($mitigacions as $key => $mitigacion)
                                    <option value="{{ $key }}" {{ old('mitigacion_id', optional($lnCaracteristica)->mitigacion_id) == $key ? 'selected' : '' }}>
                                            {{ $mitigacion }}
                                </option>
                                @endforeach
                            </select>

                            {!! $errors->first('mitigacion_id', '<p class="help-block">:message</p>') !!}
                            <!--</div>-->
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('intensidad_impacto_id') ? 'has-error' : '' }}">
                                <label for="intensidad_impacto_id" class="control-label">{{ trans('ln_caracteristicas.intensidad_impacto_id') }}</label>
                                <!--<div class="col-md-10">-->
                                <select class="form-control chosen" id="intensidad_impacto_id" name="intensidad_impacto_id" required="true">
                                    <option value="" style="display: none;" {{ old('intensidad_impacto_id', optional($lnCaracteristica)->intensidad_impacto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ln_caracteristicas.intensidad_impacto_id__placeholder') }}</option>
                                    @foreach ($intensidadImpactos as $key => $intensidadImpacto)
                                    <option value="{{ $key }}" {{ old('intensidad_impacto_id', optional($lnCaracteristica)->intensidad_impacto_id) == $key ? 'selected' : '' }}>
                                            {{ $intensidadImpacto }}
                                </option>
                                @endforeach
                            </select>

                            {!! $errors->first('intensidad_impacto_id', '<p class="help-block">:message</p>') !!}
                            <!--</div>-->
                            </div>


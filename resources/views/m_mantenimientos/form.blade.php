
<div class="form-group col-md-4 {{ $errors->has('no_orden') ? 'has-error' : '' }}">
    <label for="no_orden" class="control-label">{{ trans('m_mantenimientos.no_orden') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="no_orden" type="text" id="no_orden" value="{{ old('no_orden', optional($mMantenimiento)->no_orden) }}" maxlength="255" placeholder="{{ trans('m_mantenimientos.no_orden__placeholder') }}">
        {!! $errors->first('no_orden', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('m_tpo_manto_id') ? 'has-error' : '' }}">
    <label for="m_tpo_manto_id" class="control-label">{{ trans('m_mantenimientos.m_tpo_manto_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="m_tpo_manto_id" name="m_tpo_manto_id" required="true">
        	    <option value="" style="display: none;" {{ old('m_tpo_manto_id', optional($mMantenimiento)->m_tpo_manto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.m_tpo_manto_id__placeholder') }}</option>
        	@foreach ($mTpoMantos as $key => $mTpoManto)
			    <option value="{{ $key }}" {{ old('m_tpo_manto_id', optional($mMantenimiento)->m_tpo_manto_id) == $key ? 'selected' : '' }}>
			    	{{ $mTpoManto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('m_tpo_manto_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('objetivo_id') ? 'has-error' : '' }}">
    <label for="objetivo_id" class="control-label">{{ trans('m_mantenimientos.objetivo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="objetivo_id" name="objetivo_id" required="true">
        	    <option value="" style="display: none;" {{ old('objetivo_id', optional($mMantenimiento)->objetivo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.objetivo_id__placeholder') }}</option>
        	@foreach ($mObjetivos as $key => $mObjetivo)
			    <option value="{{ $key }}" {{ old('objetivo_id', optional($mMantenimiento)->objetivo_id) == $key ? 'selected' : '' }}>
			    	{{ $mObjetivo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('objetivo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('subequipo_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="subequipo_id" class="control-label">{{ trans('m_mantenimientos.subequipo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="subequipo_id" name="subequipo_id" required="true">
        	    <option value="" style="display: none;" {{ old('subequipo_id', optional($mMantenimiento)->subequipo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.subequipo_id__placeholder') }}</option>
        	@foreach ($subequipos as $key => $subequipo)
			    <option value="{{ $key }}" {{ old('subequipo_id', optional($mMantenimiento)->subequipo_id) == $key ? 'selected' : '' }}>
			    	{{ $subequipo }}
			    </option>
			@endforeach
        </select>
        <div class="row_1"><div id='loading1' style='display: none'><img src="{{ asset('img/ajax-loader.gif') }}" title="Loading" /></div> </div>
        {!! $errors->first('subequipo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('detalle_s') ? 'has-error' : '' }}">
    
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm" name="detalle_s" type="text" id="detalle_s" value="" placeholder="">
        
    <!--</div>-->
</div>

<div class="row"></div>

<div class="form-group col-md-4 {{ $errors->has('solicitante_id') ? 'has-error' : '' }}">
    <label for="solicitante_id" class="control-label">{{ trans('m_mantenimientos.solicitante_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="solicitante_id" name="solicitante_id" required="true">
        	    <option value="" style="display: none;" {{ old('solicitante_id', optional($mMantenimiento)->solicitante_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.solicitante_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('solicitante_id', optional($mMantenimiento)->solicitante_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('solicitante_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_planeada') ? 'has-error' : '' }}">
    <label for="fec_planeada" class="control-label">{{ trans('m_mantenimientos.fec_planeada') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_planeada" type="text" id="fec_planeada" value="{{ old('fec_planeada', optional($mMantenimiento)->fec_planeada) }}" required="true" placeholder="{{ trans('m_mantenimientos.fec_planeada__placeholder') }}">
        {!! $errors->first('fec_planeada', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso_bnd') ? 'has-error' : '' }}">
    <label for="aviso_bnd" class="control-label">{{ trans('m_mantenimientos.aviso_bnd') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso_bnd" name="aviso_bnd" required="true">
        	    <option value="" style="display: none;" {{ old('aviso_bnd', optional($mMantenimiento)->aviso_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.aviso_bnd__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso_bnd', optional($mMantenimiento)->aviso_bnd) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso_bnd', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}" style="clear:left;">
    <label for="dias_aviso" class="control-label">{{ trans('m_mantenimientos.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($mMantenimiento)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('m_mantenimientos.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_inicio') ? 'has-error' : '' }}">
    <label for="fec_inicio" class="control-label">{{ trans('m_mantenimientos.fec_inicio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_inicio" type="text" id="fec_inicio" value="{{ old('fec_inicio', optional($mMantenimiento)->fec_inicio) }}" minlength="1" required="true" placeholder="{{ trans('m_mantenimientos.fec_inicio__placeholder') }}">
        {!! $errors->first('fec_inicio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('m_mantenimientos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($mMantenimiento)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_mantenimientos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('lugar') ? 'has-error' : '' }}">
    <label for="lugar" class="control-label">{{ trans('m_mantenimientos.lugar') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="lugar" type="text" id="lugar" value="{{ old('lugar', optional($mMantenimiento)->lugar) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_mantenimientos.lugar__placeholder') }}">
        {!! $errors->first('lugar', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('ejecutor_id') ? 'has-error' : '' }}">
    <label for="ejecutor_id" class="control-label">{{ trans('m_mantenimientos.ejecutor_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="ejecutor_id" name="ejecutor_id" required="true">
        	    <option value="" style="display: none;" {{ old('ejecutor_id', optional($mMantenimiento)->ejecutor_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.ejecutor_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('ejecutor_id', optional($mMantenimiento)->ejecutor_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('ejecutor_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('m_mantenimientos.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($mMantenimiento)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($mMantenimiento)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('recomendaciones') ? 'has-error' : '' }}">
    <label for="recomendaciones" class="control-label">{{ trans('m_mantenimientos.recomendaciones') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="recomendaciones" type="text" id="recomendaciones" value="{{ old('recomendaciones', optional($mMantenimiento)->recomendaciones) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_mantenimientos.recomendaciones__placeholder') }}">
        {!! $errors->first('recomendaciones', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('materiales') ? 'has-error' : '' }}">
    <label for="materiales" class="control-label">{{ trans('m_mantenimientos.materiales') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="materiales" type="text" id="materiales" value="{{ old('materiales', optional($mMantenimiento)->materiales) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('m_mantenimientos.materiales__placeholder') }}">
        {!! $errors->first('materiales', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('horas_inv') ? 'has-error' : '' }}">
    <label for="horas_inv" class="control-label">{{ trans('m_mantenimientos.horas_inv') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="horas_inv" type="number" id="horas_inv" value="{{ old('horas_inv', optional($mMantenimiento)->horas_inv) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('m_mantenimientos.horas_inv__placeholder') }}" step="any">
        {!! $errors->first('horas_inv', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo') ? 'has-error' : '' }}">
    <label for="costo" class="control-label">{{ trans('m_mantenimientos.costo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo" type="number" id="costo" value="{{ old('costo', optional($mMantenimiento)->costo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('m_mantenimientos.costo__placeholder') }}" step="any">
        {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="row"></div>
<div class="page-header"></div>

<div class="form-group col-md-4 {{ $errors->has('tpp_bnd') ? 'has-error' : '' }}">
    <label for="tpp_bnd" class="control-label">{{ trans('m_mantenimientos.tpp_bnd') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpp_bnd" name="tpp_bnd" required="true">
        	    <option value="" style="display: none;" {{ old('tpp_bnd', optional($mMantenimiento)->tpp_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.tpp_bnd__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('tpp_bnd', optional($mMantenimiento)->tpp_bnd) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpp_bnd', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div id="seccion_tpp">
    <div class="form-group col-md-4 row_1 {{ $errors->has('riesgos') ? 'has-error' : '' }}">
        <label for="riesgos" class="control-label">{{ trans('m_mantenimientos.riesgos') }}</label>
        <!--<div class="col-md-10">-->
            <input class="form-control input-sm " name="riesgos" type="text" id="riesgos" value="{{ old('riesgos', optional($mMantenimiento)->riesgos) }}" minlength="1" maxlength="255" placeholder="{{ trans('m_mantenimientos.riesgos__placeholder') }}">
            {!! $errors->first('riesgos', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 row_1 {{ $errors->has('supervision_bnd') ? 'has-error' : '' }}">
        <label for="supervision_bnd" class="control-label">{{ trans('m_mantenimientos.supervision_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="supervision_bnd" name="supervision_bnd" required="true">
                        <option value="" style="display: none;" {{ old('supervision_bnd', optional($mMantenimiento)->supervision_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.supervision_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('supervision_bnd', optional($mMantenimiento)->supervision_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('supervision_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 row_1 {{ $errors->has('conoce_procedimiento_bnd') ? 'has-error' : '' }}" style="clear:left;">
        <label for="conoce_procedimiento_bnd" class="control-label">{{ trans('m_mantenimientos.conoce_procedimiento_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="conoce_procedimiento_bnd" name="conoce_procedimiento_bnd" required="true">
                        <option value="" style="display: none;" {{ old('conoce_procedimiento_bnd', optional($mMantenimiento)->conoce_procedimiento_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.conoce_procedimiento_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('conoce_procedimiento_bnd', optional($mMantenimiento)->conoce_procedimiento_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('conoce_procedimiento_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 row_1 {{ $errors->has('lleva_equipo_bnd') ? 'has-error' : '' }}">
        <label for="lleva_equipo_bnd" class="control-label">{{ trans('m_mantenimientos.lleva_equipo_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="lleva_equipo_bnd" name="lleva_equipo_bnd" required="true">
                        <option value="" style="display: none;" {{ old('lleva_equipo_bnd', optional($mMantenimiento)->lleva_equipo_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.lleva_equipo_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('lleva_equipo_bnd', optional($mMantenimiento)->lleva_equipo_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('lleva_equipo_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 row_1 {{ $errors->has('cumple_puntos_bnd') ? 'has-error' : '' }}">
        <label for="cumple_puntos_bnd" class="control-label">{{ trans('m_mantenimientos.cumple_puntos_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="cumple_puntos_bnd" name="cumple_puntos_bnd" required="true">
                        <option value="" style="display: none;" {{ old('cumple_puntos_bnd', optional($mMantenimiento)->cumple_puntos_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.cumple_puntos_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('cumple_puntos_bnd', optional($mMantenimiento)->cumple_puntos_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('cumple_puntos_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>
</div>
<div class="row"></div>
<div class="page-header"></div>

<div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
    <label for="estatus_id" class="control-label">{{ trans('m_mantenimientos.estatus_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="estatus_id" name="estatus_id" required="true">
        	    <option value="" style="display: none;" {{ old('estatus_id', optional($mMantenimiento)->estatus_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.estatus_id__placeholder') }}</option>
        	@foreach ($mEstatuses as $key => $mEstatus)
			    <option value="{{ $key }}" {{ old('estatus_id', optional($mMantenimiento)->estatus_id) == $key ? 'selected' : '' }}>
			    	{{ $mEstatus }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div id="seccion_estatus">
    <div class="form-group col-md-4 {{ $errors->has('eventualidades_bnd') ? 'has-error' : '' }}">
        <label for="eventualidades_bnd" class="control-label">{{ trans('m_mantenimientos.eventualidades_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="eventualidades_bnd" name="eventualidades_bnd" required="true">
                        <option value="" style="display: none;" {{ old('eventualidades_bnd', optional($mMantenimiento)->eventualidades_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.eventualidades_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('eventualidades_bnd', optional($mMantenimiento)->eventualidades_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('eventualidades_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 {{ $errors->has('levantar_formato_bnd') ? 'has-error' : '' }}">
        <label for="levantar_formato_bnd" class="control-label">{{ trans('m_mantenimientos.levantar_formato_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="levantar_formato_bnd" name="levantar_formato_bnd" required="true">
                        <option value="" style="display: none;" {{ old('levantar_formato_bnd', optional($mMantenimiento)->levantar_formato_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.levantar_formato_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('levantar_formato_bnd', optional($mMantenimiento)->levantar_formato_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('levantar_formato_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 {{ $errors->has('registro_bitacora_bnd') ? 'has-error' : '' }}">
        <label for="registro_bitacora_bnd" class="control-label">{{ trans('m_mantenimientos.registro_bitacora_bnd') }}</label>
        <!--<div class="col-md-10">-->
            <select class="form-control chosen" id="registro_bitacora_bnd" name="registro_bitacora_bnd" required="true">
                        <option value="" style="display: none;" {{ old('registro_bitacora_bnd', optional($mMantenimiento)->registro_bitacora_bnd ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('m_mantenimientos.registro_bitacora_bnd__placeholder') }}</option>
                    @foreach ($bnds as $key => $bnd)
                                <option value="{{ $key }}" {{ old('registro_bitacora_bnd', optional($mMantenimiento)->registro_bitacora_bnd) == $key ? 'selected' : '' }}>
                                    {{ $bnd }}
                                </option>
                            @endforeach
            </select>

            {!! $errors->first('registro_bitacora_bnd', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 {{ $errors->has('accion') ? 'has-error' : '' }}">
        <label for="accion" class="control-label">{{ trans('m_mantenimientos.accion') }}</label>
        <!--<div class="col-md-10">-->
            <input class="form-control input-sm " name="accion" type="text" id="accion" value="{{ old('accion', optional($mMantenimiento)->accion) }}" minlength="1" maxlength="255" placeholder="{{ trans('m_mantenimientos.accion__placeholder') }}">
            {!! $errors->first('accion', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 {{ $errors->has('resultado') ? 'has-error' : '' }}">
        <label for="resultado" class="control-label">{{ trans('m_mantenimientos.resultado') }}</label>
        <!--<div class="col-md-10">-->
            <input class="form-control input-sm " name="resultado" type="text" id="resultado" value="{{ old('resultado', optional($mMantenimiento)->resultado) }}" minlength="1" maxlength="255" placeholder="{{ trans('m_mantenimientos.resultado__placeholder') }}">
            {!! $errors->first('resultado', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>

    <div class="form-group col-md-4 {{ $errors->has('fec_final') ? 'has-error' : '' }}">
        <label for="fec_final" class="control-label">{{ trans('m_mantenimientos.fec_final') }}</label>
        <!--<div class="col-md-10">-->
            <input class="form-control input-sm date-picker" name="fec_final" type="text" id="fec_final" value="{{ old('fec_final', optional($mMantenimiento)->fec_final) }}" minlength="1" placeholder="{{ trans('m_mantenimientos.fec_final__placeholder') }}">
            {!! $errors->first('fec_final', '<p class="help-block">:message</p>') !!}
        <!--</div>-->
    </div>
</div>
<div class="row"></div>
<div class="page-header"></div>

<div class="form-group col-md-12 {{ $errors->has('observaciones') ? 'has-error' : '' }}">
    <label for="observaciones" class="control-label">{{ trans('m_mantenimientos.observaciones') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="observaciones" type="text" id="observaciones" value="{{ old('observaciones', optional($mMantenimiento)->observaciones) }}" minlength="1" maxlength="255" placeholder="{{ trans('m_mantenimientos.observaciones__placeholder') }}">
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

@push('scripts')
<script type="text/javascript">
    
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });
    
    jQuery(document).ready(function () {
        var st = $("#estatus_id option:selected").val();
        if (st == 3) {
            //$("#row_1 :input").attr("disabled", true);
            $('.row_1').find('input, textarea, select').attr('disabled', 'disabled');
            $('.row').find('input, textarea, select').attr('disabled', 'disabled');
        }
        
        $("#riesgos").val('');
        $("#supervision_bnd").val('2');
        $("#conoce_procedimiento_bnd").val('2');
        $("#lleva_equipo_bnd").val('2');
        $("#cumple_puntos_bnd").val('2');

        //console.log($("#tpp_bnd option:selected").val());

        if ($("#tpp_bnd option:selected").val() == 1) {
            $("#seccion_tpp").show();
        } else {
            $("#seccion_tpp").hide();
        }
        if ($("#estatus_id option:selected").val() == 3) {
            $("#seccion_estatus").show();
        } else {
            $("#seccion_estatus").hide();
        }

        $("#supervision_bnd").val('2');
        $("#conoce_procedimiento_bnd").val('2');
        $("#lleva_equipo_bnd").val('2');
        $("#cumple_puntos_bnd").val('2');

        $("#eventualidades_bnd").val('2');
        $("#levantar_formato_bnd").val('2');
        $("#registro_bitacora_bnd").val('2');
        
        $("#tpp_bnd").change(function (event) {
            var r = $("#tpp_bnd option:selected").val();
            
            if (r == 2) {
                
                $("#seccion_tpp").hide();
    
            } else if (r == 1) {
                console.log(r);
                $("#seccion_tpp").show();
    
            }
        });

        $("#estatus_id").change(function (event) {
            var r = $("#estatus_id option:selected").val();
            if (r == 3) {
                $("#seccion_estatus").show();
                
            } else {
                
                $("#seccion_estatus").hide();
    
            }
        });
        
        function conEquipo() {
            var a = $('#m_mantenimiento_form').serialize();
            //console.log(a);
            $.ajax({
                url: "{{url('/m_mantenimientos/conEquipo')}}",
                type: 'GET',
                data: {
                    objetivo_id:$('#objetivo_id').val(),
                    subequipo_id:$('#subequipo_id').val()
                },
                dataType: 'json',
                beforeSend: function () {
                    $("#loading1").show();
                },
                complete: function () {
                    $("#loading1").hide();
                },
                success: function (ss) {
                    $('select#subequipo_id').empty();
                    //$('select#subequipo_id').append($('<option></option>').text('Seleccionar').val(''));
                    $.each(ss, function (i) {
                        $('select#subequipo_id').append("<option " + ss[i].selectec + " value=\"" + ss[i].id + "\">" + ss[i].subequipo + "<\/option>");
                    });
                    $("select#subequipo_id").trigger("chosen:updated");
                    /*$('#municipio_id-field').empty();
                                $.each(data, function(key, element) {
                                $('#municipio_id-field').append("<option value='" + key + "'>" + element + "</option>");
                                });
                    */
                   conSubequipo();
                }
            });
    
        }
        $("#objetivo_id").change(function (event) {
            
            conEquipo();
        });
        
        conSubequipo();

        function conSubequipo() {
            var id = $("#subequipo_id option:selected").val();
            $.ajax({
                url: "{{url('/m_mantenimientos/conSubequipo')}}",
                type: 'GET',
                data: 'id=' + id,
                dataType: 'json',
                beforeSend: function () {
                    $("#loading1").show();
                },
                complete: function () {
                    $("#loading1").hide();
                },
                success: function (s) {

                    $('detalle_s').val('');
                    $.each(s, function (i) {
                        //alert(s[i].clase);
                        $('#detalle_s').val(s[i].clase + ", " + s[i].marca + ", " + s[i].modelo + ", " + s[i].no_serie + ", " + s[i].fecha_carga + ", " + s[i].area + ", " + s[i].ubicacion);
                    });
                }
            });
        }

        $("#subequipo_id").change(function (event) {
            conSubequipo();
        });
        
    });
</script>
@endpush    





<div class="form-group col-md-4 {{ $errors->has('pendiente') ? 'has-error' : '' }}">
    <label for="pendiente" class="control-label">{{ trans('bitacora_pendientes.pendiente') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="pendiente" type="text" id="pendiente" rows="3" maxlength="255">
        {{ old('pendiente', optional($bitacoraPendiente)->pendiente) }}
    </textarea>
        
        {!! $errors->first('pendiente', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('comentarios') ? 'has-error' : '' }}">
    <label for="comentarios" class="control-label">{{ trans('bitacora_pendientes.comentarios') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="comentarios" type="text" id="comentarios" rows="3" maxlength="255">
        {{ old('comentarios', optional($bitacoraPendiente)->comentarios) }}
    </textarea>
        
        {!! $errors->first('comentarios', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('solucion') ? 'has-error' : '' }}">
    <label for="solucion" class="control-label">{{ trans('bitacora_pendientes.solucion') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="solucion" type="text" id="solucion" rows="3" maxlength="255">
        {{ old('solucion', optional($bitacoraPendiente)->solucion) }}
    </textarea>
        {!! $errors->first('solucion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_planeada') ? 'has-error' : '' }}">
    <label for="fec_planeada" class="control-label">{{ trans('bitacora_pendientes.fec_planeada') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_planeada" type="text" id="fec_planeada" value="{{ old('fec_planeada', optional($bitacoraPendiente)->fec_planeada) }}" required="true" placeholder="{{ trans('bitacora_pendientes.fec_planeada__placeholder') }}">
        {!! $errors->first('fec_planeada', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin') ? 'has-error' : '' }}">
    <label for="fec_fin" class="control-label">{{ trans('bitacora_pendientes.fec_fin') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin" type="text" id="fec_fin" value="{{ old('fec_fin', optional($bitacoraPendiente)->fec_fin) }}" required="true" placeholder="{{ trans('bitacora_pendientes.fec_fin__placeholder') }}">
        {!! $errors->first('fec_fin', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('bitacora_pendientes.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($bitacoraPendiente)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_pendientes.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($bitacoraPendiente)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}" style="clear:left;">
    <label for="aviso" class="control-label">{{ trans('bitacora_pendientes.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($bitacoraPendiente)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('bitacora_pendientes.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($bitacoraPendiente)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('bitacora_pendientes.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($bitacoraPendiente)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('bitacora_pendientes.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-12 {{ $errors->has('observaciones') ? 'has-error' : '' }}">
    <label for="observaciones" class="control-label">{{ trans('bitacora_pendientes.observaciones') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="observaciones" type="text" id="observaciones" rows="2" maxlength="255">
        {{ old('observaciones', optional($bitacoraPendiente)->observaciones) }}
    </textarea>
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
</script>
@endpush    
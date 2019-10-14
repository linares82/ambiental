
<div class="form-group col-md-4 {{ $errors->has('procedimiento_id') ? 'has-error' : '' }}">
    <label for="procedimiento_id" class="control-label">{{ trans('a_procedimientos.procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="procedimiento_id" name="procedimiento_id" required="true">
        	    <option value="" style="display: none;" {{ old('procedimiento_id', optional($aProcedimiento)->procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_procedimientos.procedimiento_id__placeholder') }}</option>
        	@foreach ($caProcedimientos as $key => $caProcedimiento)
			    <option value="{{ $key }}" {{ old('procedimiento_id', optional($aProcedimiento)->procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $caProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('a_procedimientos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($aProcedimiento)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_procedimientos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_ini_vigencia') ? 'has-error' : '' }}">
    <label for="fec_ini_vigencia" class="control-label">{{ trans('a_procedimientos.fec_ini_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_ini_vigencia" type="text" id="fec_ini_vigencia" value="{{ old('fec_ini_vigencia', optional($aProcedimiento)->fec_ini_vigencia) }}" required="true" placeholder="{{ trans('a_procedimientos.fec_ini_vigencia__placeholder') }}">
        {!! $errors->first('fec_ini_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('a_procedimientos.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($aProcedimiento)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('a_procedimientos.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('a_procedimientos.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($aProcedimiento)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_procedimientos.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($aProcedimiento)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}" style="clear:left">
    <label for="dias_aviso" class="control-label">{{ trans('a_procedimientos.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($aProcedimiento)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('a_procedimientos.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('a_procedimientos.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($aProcedimiento)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_procedimientos.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($aProcedimiento)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="control-label">{{ trans('a_procedimientos.obs') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="obs" type="text" id="obs" value="{{ old('obs', optional($aProcedimiento)->obs) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_procedimientos.obs__placeholder') }}">
        {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
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
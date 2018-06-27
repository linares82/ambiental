
<div class="form-group col-md-6 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
    <label for="documento_id" class="control-label">{{ trans('a_archivos.documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="documento_id" name="documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('documento_id', optional($aArchivo)->documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_archivos.documento_id__placeholder') }}</option>
        	@foreach ($caCaDocs as $key => $caCaDoc)
			    <option value="{{ $key }}" {{ old('documento_id', optional($aArchivo)->documento_id) == $key ? 'selected' : '' }}>
			    	{{ $caCaDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('a_archivos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($aArchivo)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_archivos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



<div class="form-group col-md-4 {{ $errors->has('fec_ini_vigencia') ? 'has-error' : '' }}">
    <label for="fec_ini_vigencia" class="control-label">{{ trans('a_archivos.fec_ini_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_ini_vigencia" type="text" id="fec_ini_vigencia" value="{{ old('fec_ini_vigencia', optional($aArchivo)->fec_ini_vigencia) }}" required="true" placeholder="{{ trans('a_archivos.fec_ini_vigencia__placeholder') }}">
        {!! $errors->first('fec_ini_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('a_archivos.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($aArchivo)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('a_archivos.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('a_archivos.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($aArchivo)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_archivos.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('a_archivos.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($aArchivo)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_archivos.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($aArchivo)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('a_archivos.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($aArchivo)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('a_archivos.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('a_archivos.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($aArchivo)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_archivos.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($aArchivo)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('obs') ? 'has-error' : '' }}">
    <label for="obs" class="control-label">{{ trans('a_archivos.obs') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="obs" type="text" id="obs" value="{{ old('obs', optional($aArchivo)->obs) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_archivos.obs__placeholder') }}">
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

<div class="form-group col-md-4 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
    <label for="documento_id" class="control-label">{{ trans('s_documentos.documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="documento_id" name="documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('documento_id', optional($sDocumento)->documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_documentos.documento_id__placeholder') }}</option>
        	@foreach ($csCatDocs as $key => $csCatDoc)
			    <option value="{{ $key }}" {{ old('documento_id', optional($sDocumento)->documento_id) == $key ? 'selected' : '' }}>
			    	{{ $csCatDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('s_documentos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($sDocumento)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_documentos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_ini_vigencia') ? 'has-error' : '' }}">
    <label for="fec_ini_vigencia" class="control-label">{{ trans('s_documentos.fec_ini_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_ini_vigencia" type="text" id="fec_ini_vigencia" value="{{ old('fec_ini_vigencia', optional($sDocumento)->fec_ini_vigencia) }}" required="true" placeholder="{{ trans('s_documentos.fec_ini_vigencia__placeholder') }}">
        {!! $errors->first('fec_ini_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('s_documentos.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($sDocumento)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('s_documentos.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('s_documentos.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($sDocumento)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_documentos.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($sDocumento)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}" style="clear:left">
    <label for="dias_aviso" class="control-label">{{ trans('s_documentos.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($sDocumento)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('s_documentos.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('s_documentos.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($sDocumento)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_documentos.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($sDocumento)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('s_documentos.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($sDocumento)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_documentos.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('observaciones') ? 'has-error' : '' }}">
    <label for="observaciones" class="control-label">{{ trans('s_documentos.observaciones') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="observaciones" type="text" id="observaciones" value="{{ old('observaciones', optional($sDocumento)->observaciones) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_documentos.observaciones__placeholder') }}">
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


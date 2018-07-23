
<div class="form-group col-md-4 {{ $errors->has('tpo_procedimiento_id') ? 'has-error' : '' }}">
    <label for="tpo_procedimiento_id" class="control-label">{{ trans('s_procedimientos.tpo_procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_procedimiento_id" name="tpo_procedimiento_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_procedimiento_id', optional($sProcedimiento)->tpo_procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_procedimientos.tpo_procedimiento_id__placeholder') }}</option>
        	@foreach ($csTpoProcedimientos as $key => $csTpoProcedimiento)
			    <option value="{{ $key }}" {{ old('tpo_procedimiento_id', optional($sProcedimiento)->tpo_procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_doc_id') ? 'has-error' : '' }}">
    <label for="tpo_doc_id" class="control-label">{{ trans('s_procedimientos.tpo_doc_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_doc_id" name="tpo_doc_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_doc_id', optional($sProcedimiento)->tpo_doc_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_procedimientos.tpo_doc_id__placeholder') }}</option>
        	@foreach ($csTpoDocs as $key => $csTpoDoc)
			    <option value="{{ $key }}" {{ old('tpo_doc_id', optional($sProcedimiento)->tpo_doc_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_doc_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('s_procedimientos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($sProcedimiento)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_procedimientos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('s_procedimientos.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($sProcedimiento)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_procedimientos.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($sProcedimiento)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('s_procedimientos.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($sProcedimiento)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('s_procedimientos.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('s_procedimientos.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($sProcedimiento)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('s_procedimientos.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('s_procedimientos.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($sProcedimiento)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_procedimientos.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($sProcedimiento)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>





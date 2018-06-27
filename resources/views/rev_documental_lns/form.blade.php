
<div class="form-group col-md-6 {{ $errors->has('tpo_documento_id') ? 'has-error' : '' }}">
    <label for="tpo_documento_id" class="control-label">{{ trans('rev_documental_lns.tpo_documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_documento_id" name="tpo_documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_documento_id', optional($revDocumentalLn)->tpo_documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.tpo_documento_id__placeholder') }}</option>
        	@foreach ($tpoDocs as $key => $tpoDoc)
			    <option value="{{ $key }}" {{ old('tpo_documento_id', optional($revDocumentalLn)->tpo_documento_id) == $key ? 'selected' : '' }}>
			    	{{ $tpoDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-6 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
    <label for="documento_id" class="control-label">{{ trans('rev_documental_lns.documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="documento_id" name="documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('documento_id', optional($revDocumentalLn)->documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.documento_id__placeholder') }}</option>
        	@foreach ($rDocumentos as $key => $rDocumento)
			    <option value="{{ $key }}" {{ old('documento_id', optional($revDocumentalLn)->documento_id) == $key ? 'selected' : '' }}>
			    	{{ $rDocumento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('grupo_norma_id') ? 'has-error' : '' }}">
    <label for="grupo_norma_id" class="control-label">{{ trans('rev_documental_lns.grupo_norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="grupo_norma_id" name="grupo_norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('grupo_norma_id', optional($revDocumentalLn)->grupo_norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.grupo_norma_id__placeholder') }}</option>
        	@foreach ($csGrupoNormas as $key => $csGrupoNorma)
			    <option value="{{ $key }}" {{ old('grupo_norma_id', optional($revDocumentalLn)->grupo_norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csGrupoNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('grupo_norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-8 {{ $errors->has('norma_id') ? 'has-error' : '' }}">
    <label for="norma_id" class="control-label">{{ trans('rev_documental_lns.norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="norma_id" name="norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('norma_id', optional($revDocumentalLn)->norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.norma_id__placeholder') }}</option>
        	@foreach ($csNormas as $key => $csNorma)
			    <option value="{{ $key }}" {{ old('norma_id', optional($revDocumentalLn)->norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
    <label for="estatus_id" class="control-label">{{ trans('rev_documental_lns.estatus_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="estatus_id" name="estatus_id" required="true">
        	    <option value="" style="display: none;" {{ old('estatus_id', optional($revDocumentalLn)->estatus_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.estatus_id__placeholder') }}</option>
        	@foreach ($estatusRequisitos as $key => $estatusRequisito)
			    <option value="{{ $key }}" {{ old('estatus_id', optional($revDocumentalLn)->estatus_id) == $key ? 'selected' : '' }}>
			    	{{ $estatusRequisito }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('importancia_id') ? 'has-error' : '' }}">
    <label for="importancia_id" class="control-label">{{ trans('rev_documental_lns.importancia_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="importancia_id" name="importancia_id" required="true">
        	    <option value="" style="display: none;" {{ old('importancia_id', optional($revDocumentalLn)->importancia_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.importancia_id__placeholder') }}</option>
        	@foreach ($importancia as $key => $importancium)
			    <option value="{{ $key }}" {{ old('importancia_id', optional($revDocumentalLn)->importancia_id) == $key ? 'selected' : '' }}>
			    	{{ $importancium }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('importancia_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('rev_documental_lns.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($revDocumentalLn)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_documental_lns.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($revDocumentalLn)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_advertencia1') ? 'has-error' : '' }}">
    <label for="dias_advertencia1" class="control-label">{{ trans('rev_documental_lns.dias_advertencia1') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_advertencia1" type="number" id="dias_advertencia1" value="{{ old('dias_advertencia1', optional($revDocumentalLn)->dias_advertencia1) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_documental_lns.dias_advertencia1__placeholder') }}">
        {!! $errors->first('dias_advertencia1', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_advertencia2') ? 'has-error' : '' }}">
    <label for="dias_advertencia2" class="control-label">{{ trans('rev_documental_lns.dias_advertencia2') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_advertencia2" type="number" id="dias_advertencia2" value="{{ old('dias_advertencia2', optional($revDocumentalLn)->dias_advertencia2) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_documental_lns.dias_advertencia2__placeholder') }}">
        {!! $errors->first('dias_advertencia2', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_advertencia3') ? 'has-error' : '' }}">
    <label for="dias_advertencia3" class="control-label">{{ trans('rev_documental_lns.dias_advertencia3') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_advertencia3" type="number" id="dias_advertencia3" value="{{ old('dias_advertencia3', optional($revDocumentalLn)->dias_advertencia3) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_documental_lns.dias_advertencia3__placeholder') }}">
        {!! $errors->first('dias_advertencia3', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_cumplimiento') ? 'has-error' : '' }}">
    <label for="fec_cumplimiento" class="control-label">{{ trans('rev_documental_lns.fec_cumplimiento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_cumplimiento" type="text" id="fec_cumplimiento" value="{{ old('fec_cumplimiento', optional($revDocumentalLn)->fec_cumplimiento) }}" required="true" placeholder="{{ trans('rev_documental_lns.fec_cumplimiento__placeholder') }}">
        {!! $errors->first('fec_cumplimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_vencimiento') ? 'has-error' : '' }}">
    <label for="fec_vencimiento" class="control-label">{{ trans('rev_documental_lns.fec_vencimiento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_vencimiento" type="text" id="fec_vencimiento" value="{{ old('fec_vencimiento', optional($revDocumentalLn)->fec_vencimiento) }}" required="true" placeholder="{{ trans('rev_documental_lns.fec_vencimiento__placeholder') }}">
        {!! $errors->first('fec_vencimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('rev_documental_lns.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($revDocumentalLn)->archivo) }}" minlength="1" maxlength="255" placeholder="{{ trans('rev_documental_lns.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-12 {{ $errors->has('observaciones') ? 'has-error' : '' }}">
    <label for="observaciones" class="control-label">{{ trans('rev_documental_lns.observaciones') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="observaciones" type="text" id="observaciones" value="{{ old('observaciones', optional($revDocumentalLn)->observaciones) }}" minlength="1" maxlength="255" placeholder="{{ trans('rev_documental_lns.observaciones__placeholder') }}">
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
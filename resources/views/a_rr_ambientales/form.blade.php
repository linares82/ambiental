
<div class="form-group col-md-4 {{ $errors->has('material_id') ? 'has-error' : '' }}">
    <label for="material_id" class="control-label">{{ trans('a_rr_ambientales.material_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="material_id" name="material_id" required="true">
        	    <option value="" style="display: none;" {{ old('material_id', optional($aRrAmbientale)->material_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.material_id__placeholder') }}</option>
        	@foreach ($caMaterials as $key => $caMaterial)
			    <option value="{{ $key }}" {{ old('material_id', optional($aRrAmbientale)->material_id) == $key ? 'selected' : '' }}>
			    	{{ $caMaterial }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('categoria_id') ? 'has-error' : '' }}">
    <label for="categoria_id" class="control-label">{{ trans('a_rr_ambientales.categoria_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="categoria_id" name="categoria_id" required="true">
        	    <option value="" style="display: none;" {{ old('categoria_id', optional($aRrAmbientale)->categoria_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.categoria_id__placeholder') }}</option>
        	@foreach ($caCategorias as $key => $caCategorium)
			    <option value="{{ $key }}" {{ old('categoria_id', optional($aRrAmbientale)->categoria_id) == $key ? 'selected' : '' }}>
			    	{{ $caCategorium }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('documento_id') ? 'has-error' : '' }}">
    <label for="documento_id" class="control-label">{{ trans('a_rr_ambientales.documento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="documento_id" name="documento_id" required="true">
        	    <option value="" style="display: none;" {{ old('documento_id', optional($aRrAmbientale)->documento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.documento_id__placeholder') }}</option>
        	@foreach ($caAaDocs as $key => $caAaDoc)
			    <option value="{{ $key }}" {{ old('documento_id', optional($aRrAmbientale)->documento_id) == $key ? 'selected' : '' }}>
			    	{{ $caAaDoc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('documento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('a_rr_ambientales.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($aRrAmbientale)->descripcion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_rr_ambientales.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_fin_vigencia') ? 'has-error' : '' }}">
    <label for="fec_fin_vigencia" class="control-label">{{ trans('a_rr_ambientales.fec_fin_vigencia') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_fin_vigencia" type="text" id="fec_fin_vigencia" value="{{ old('fec_fin_vigencia', optional($aRrAmbientale)->fec_fin_vigencia) }}" required="true" placeholder="{{ trans('a_rr_ambientales.fec_fin_vigencia__placeholder') }}">
        {!! $errors->first('fec_fin_vigencia', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('a_rr_ambientales.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($aRrAmbientale)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_rr_ambientales.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('aviso') ? 'has-error' : '' }}">
    <label for="aviso" class="control-label">{{ trans('a_rr_ambientales.aviso') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="aviso" name="aviso" required="true">
        	    <option value="" style="display: none;" {{ old('aviso', optional($aRrAmbientale)->aviso ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.aviso__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('aviso', optional($aRrAmbientale)->aviso) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('dias_aviso') ? 'has-error' : '' }}">
    <label for="dias_aviso" class="control-label">{{ trans('a_rr_ambientales.dias_aviso') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="dias_aviso" type="number" id="dias_aviso" value="{{ old('dias_aviso', optional($aRrAmbientale)->dias_aviso) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('a_rr_ambientales.dias_aviso__placeholder') }}">
        {!! $errors->first('dias_aviso', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable_id') ? 'has-error' : '' }}">
    <label for="responsable_id" class="control-label">{{ trans('a_rr_ambientales.responsable_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="responsable_id" name="responsable_id" required="true">
        	    <option value="" style="display: none;" {{ old('responsable_id', optional($aRrAmbientale)->responsable_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_rr_ambientales.responsable_id__placeholder') }}</option>
        	@foreach ($empleados as $key => $empleado)
			    <option value="{{ $key }}" {{ old('responsable_id', optional($aRrAmbientale)->responsable_id) == $key ? 'selected' : '' }}>
			    	{{ $empleado }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('responsable_id', '<p class="help-block">:message</p>') !!}
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
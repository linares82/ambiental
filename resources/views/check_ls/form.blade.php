<div class='row'></div>
<div class='page-header'>
<h3>Datos Iniciales</h3>
</div>
<div class="form-group col-md-4 {{ $errors->has('a_check_id') ? 'has-error' : '' }}">
    <label for="a_check_id" class="control-label">{{ trans('check_ls.a_check_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="a_check_id" name="a_check_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_check_id', optional($checkL)->a_check_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('check_ls.a_check_id__placeholder') }}</option>
        	@foreach ($aChecks as $key => $aCheck)
			    <option value="{{ $key }}" {{ old('a_check_id', optional($checkL)->a_check_id) == $key ? 'selected' : '' }}>
			    	{{ $aCheck }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_check_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('norma_id') ? 'has-error' : '' }}">
    <label for="norma_id" class="control-label">{{ trans('check_ls.norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="norma_id" name="norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('norma_id', optional($checkL)->norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('check_ls.norma_id__placeholder') }}</option>
        	@foreach ($normas as $key => $norma)
			    <option value="{{ $key }}" {{ old('norma_id', optional($checkL)->norma_id) == $key ? 'selected' : '' }}>
			    	{{ $norma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="row"></div>

<div class="form-group col-md-4 {{ $errors->has('no_conformidad') ? 'has-error' : '' }}">
    <label for="no_conformidad" class="control-label">{{ trans('check_ls.no_conformidad') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="no_conformidad" type="text" id="no_conformidad" rows="3" maxlength="500">
    {{ old('no_conformidad', optional($checkL)->no_conformidad) }}
    </textarea>
        {!! $errors->first('no_conformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('especifico') ? 'has-error' : '' }}">
    <label for="especifico" class="control-label">{{ trans('check_ls.especifico') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="especifico" type="text" id="especifico" rows="3" maxlength="500">
        {{ old('especifico', optional($checkL)->especifico) }}
    </textarea>
        {!! $errors->first('especifico', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('requisito') ? 'has-error' : '' }}">
    <label for="requisito" class="control-label">{{ trans('check_ls.requisito') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="requisito" type="text" id="requisito" rows="3" maxlength="500">
        {{ old('requisito', optional($checkL)->requisito) }}
    </textarea>
        {!! $errors->first('requisito', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rnc') ? 'has-error' : '' }}">
    <label for="rnc" class="control-label">{{ trans('check_ls.rnc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rnc" type="text" id="rnc" value="{{ old('rnc', optional($checkL)->rnc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('check_ls.rnc__placeholder') }}">
        {!! $errors->first('rnc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('minimo_vsm') ? 'has-error' : '' }}">
    <label for="minimo_vsm" class="control-label">{{ trans('check_ls.minimo_vsm') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="minimo_vsm" type="number" id="minimo_vsm" value="{{ old('minimo_vsm', optional($checkL)->minimo_vsm) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('check_ls.minimo_vsm__placeholder') }}" step="any">
        {!! $errors->first('minimo_vsm', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('maximo_vsm') ? 'has-error' : '' }}">
    <label for="maximo_vsm" class="control-label">{{ trans('check_ls.maximo_vsm') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="maximo_vsm" type="number" id="maximo_vsm" value="{{ old('maximo_vsm', optional($checkL)->maximo_vsm) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('check_ls.maximo_vsm__placeholder') }}" step="any">
        {!! $errors->first('maximo_vsm', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('cumplimiento') ? 'has-error' : '' }}">
    <label for="cumplimiento" class="control-label">{{ trans('check_ls.cumplimiento') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="cumplimiento" name="cumplimiento" required="true">
        	    <option value="" style="display: none;" {{ old('cumplimiento', optional($checkL)->cumplimiento ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('check_ls.cumplimiento__placeholder') }}</option>
        	@foreach ($cumplimientos as $key => $cumplimiento)
			    <option value="{{ $key }}" {{ old('cumplimiento', optional($checkL)->cumplimiento) == $key ? 'selected' : '' }}>
			    	{{ $cumplimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('cumplimiento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class='row'></div>
<div class='page-header'>
<h3>Datos de la verificacion</h3>
</div>

<div class="form-group col-md-4 {{ $errors->has('monto_min') ? 'has-error' : '' }}">
    <label for="monto_min" class="control-label">{{ trans('check_ls.monto_min') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="monto_min" type="number" id="monto_min" value="{{ old('monto_min', optional($checkL)->monto_min) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('check_ls.monto_min__placeholder') }}" step="any">
        {!! $errors->first('monto_min', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('monto_medio') ? 'has-error' : '' }}">
    <label for="monto_medio" class="control-label">{{ trans('check_ls.monto_medio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="monto_medio" type="number" id="monto_medio" value="{{ old('monto_medio', optional($checkL)->monto_medio) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('check_ls.monto_medio__placeholder') }}" step="any">
        {!! $errors->first('monto_medio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('monto_max') ? 'has-error' : '' }}">
    <label for="monto_max" class="control-label">{{ trans('check_ls.monto_max') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="monto_max" type="number" id="monto_max" value="{{ old('monto_max', optional($checkL)->monto_max) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('check_ls.monto_max__placeholder') }}" step="any">
        {!! $errors->first('monto_max', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('correccion') ? 'has-error' : '' }}">
    <label for="correccion" class="control-label">{{ trans('check_ls.correccion') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="correccion" type="text" id="correccion" rows="3" maxlength="500">
        {{ old('correccion', optional($checkL)->correccion) }}
    </textarea>    
        {!! $errors->first('correccion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('correccion_detallada') ? 'has-error' : '' }}">
    <label for="correccion_detallada" class="control-label">{{ trans('check_ls.correccion_detallada') }}</label>
    <!--<div class="col-md-10">-->
    <textarea class="form-control input-sm " name="correccion_detallada" type="text" id="correccion_detallada" rows="3" maxlength="500">
        {{ old('correccion_detallada', optional($checkL)->correccion_detallada) }}
    </textarea>
        {!! $errors->first('correccion_detallada', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('t_semanas') ? 'has-error' : '' }}">
    <label for="t_semanas" class="control-label">{{ trans('check_ls.t_semanas') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="t_semanas" type="number" id="t_semanas" value="{{ old('t_semanas', optional($checkL)->t_semanas) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('check_ls.t_semanas__placeholder') }}">
        {!! $errors->first('t_semanas', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('responsable') ? 'has-error' : '' }}">
    <label for="responsable" class="control-label">{{ trans('check_ls.responsable') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="responsable" type="text" id="responsable" value="{{ old('responsable', optional($checkL)->responsable) }}" minlength="1" maxlength="255" placeholder="{{ trans('check_ls.responsable__placeholder') }}">
        {!! $errors->first('responsable', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('monto_estimado') ? 'has-error' : '' }}">
    <label for="monto_estimado" class="control-label">{{ trans('check_ls.monto_estimado') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="monto_estimado" type="number" id="monto_estimado" value="{{ old('monto_estimado', optional($checkL)->monto_estimado) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('check_ls.monto_estimado__placeholder') }}" step="any">
        {!! $errors->first('monto_estimado', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


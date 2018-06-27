
<div class="form-group col-md-4 {{ $errors->has('ca_material_id') ? 'has-error' : '' }}">
    <label for="ca_material_id" class="control-label">{{ trans('ca_categorias.ca_material_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="ca_material_id" name="ca_material_id" required="true">
        	    <option value="" style="display: none;" {{ old('ca_material_id', optional($caCategoria)->ca_material_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_categorias.ca_material_id__placeholder') }}</option>
        	@foreach ($caMaterials as $key => $caMaterial)
			    <option value="{{ $key }}" {{ old('ca_material_id', optional($caCategoria)->ca_material_id) == $key ? 'selected' : '' }}>
			    	{{ $caMaterial }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('ca_material_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('categoria') ? 'has-error' : '' }}">
    <label for="categoria" class="control-label">{{ trans('ca_categorias.categoria') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="categoria" type="text" id="categoria" value="{{ old('categoria', optional($caCategoria)->categoria) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_categorias.categoria__placeholder') }}">
        {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


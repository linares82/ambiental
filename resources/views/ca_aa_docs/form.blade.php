
<div class="form-group col-md-4 {{ $errors->has('material_id') ? 'has-error' : '' }}">
    <label for="material_id" class="control-label">{{ trans('ca_aa_docs.material_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="material_id" name="material_id" required="true">
        	    <option value="" style="display: none;" {{ old('material_id', optional($caAaDoc)->material_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_aa_docs.material_id__placeholder') }}</option>
        	@foreach ($caMaterials as $key => $caMaterial)
			    <option value="{{ $key }}" {{ old('material_id', optional($caAaDoc)->material_id) == $key ? 'selected' : '' }}>
			    	{{ $caMaterial }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('material_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('categoria_id') ? 'has-error' : '' }}">
    <label for="categoria_id" class="control-label">{{ trans('ca_aa_docs.categoria_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="categoria_id" name="categoria_id" required="true">
        	    <option value="" style="display: none;" {{ old('categoria_id', optional($caAaDoc)->categoria_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('ca_aa_docs.categoria_id__placeholder') }}</option>
        	@foreach ($caCategorias as $key => $caCategorium)
			    <option value="{{ $key }}" {{ old('categoria_id', optional($caAaDoc)->categoria_id) == $key ? 'selected' : '' }}>
			    	{{ $caCategorium }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('categoria_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('doc') ? 'has-error' : '' }}">
    <label for="doc" class="control-label">{{ trans('ca_aa_docs.doc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="doc" type="text" id="doc" value="{{ old('doc', optional($caAaDoc)->doc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_aa_docs.doc__placeholder') }}">
        {!! $errors->first('doc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

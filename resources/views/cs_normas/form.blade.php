
<div class="form-group col-md-4 {{ $errors->has('grupo_norma_id') ? 'has-error' : '' }}">
    <label for="grupo_norma_id" class="control-label">{{ trans('cs_normas.grupo_norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="grupo_norma_id" name="grupo_norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('grupo_norma_id', optional($csNorma)->grupo_norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_normas.grupo_norma_id__placeholder') }}</option>
        	@foreach ($csGrupoNormas as $key => $csGrupoNorma)
			    <option value="{{ $key }}" {{ old('grupo_norma_id', optional($csNorma)->grupo_norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csGrupoNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('grupo_norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('norma') ? 'has-error' : '' }}">
    <label for="norma" class="control-label">{{ trans('cs_normas.norma') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="norma" type="text" id="norma" value="{{ old('norma', optional($csNorma)->norma) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_normas.norma__placeholder') }}">
        {!! $errors->first('norma', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



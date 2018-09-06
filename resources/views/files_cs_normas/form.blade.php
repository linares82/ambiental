
<div class="form-group col-md-4 {{ $errors->has('cs_norma_id') ? 'has-error' : '' }}">
    <label for="cs_norma_id" class="control-label">{{ trans('files_cs_normas.cs_norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="cs_norma_id" name="cs_norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('cs_norma_id', optional($filesCsNorma)->cs_norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_cs_normas.cs_norma_id__placeholder') }}</option>
        	@foreach ($csNormas as $key => $csNorma)
			    <option value="{{ $key }}" {{ old('cs_norma_id', optional($filesCsNorma)->cs_norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('cs_norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('documento') ? 'has-error' : '' }}">
    <label for="documento" class="control-label">{{ trans('files_cs_normas.documento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="documento" type="text" id="documento" value="{{ old('documento', optional($filesCsNorma)->documento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_cs_normas.documento__placeholder') }}">
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('archivo') ? 'has-error' : '' }}">
    <label for="archivo" class="control-label">{{ trans('files_cs_normas.archivo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="archivo" type="text" id="archivo" value="{{ old('archivo', optional($filesCsNorma)->archivo) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_cs_normas.archivo__placeholder') }}">
        {!! $errors->first('archivo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('files_cs_normas.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($filesCsNorma)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_cs_normas.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($filesCsNorma)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('files_cs_normas.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($filesCsNorma)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_cs_normas.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($filesCsNorma)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


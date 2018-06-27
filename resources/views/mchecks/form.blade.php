
<div class="form-group col-md-4 {{ $errors->has('a_chequeo') ? 'has-error' : '' }}">
    <label for="a_chequeo" class="control-label">{{ trans('mchecks.a_chequeo') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="a_chequeo" name="a_chequeo" required="true">
        	    <option value="" style="display: none;" {{ old('a_chequeo', optional($mcheck)->a_chequeo ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('mchecks.a_chequeo__placeholder') }}</option>
        	@foreach ($achecks as $key => $acheck)
			    <option value="{{ $key }}" {{ old('a_chequeo', optional($mcheck)->a_chequeo) == $key ? 'selected' : '' }}>
			    	{{ $acheck }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_chequeo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('norma_id') ? 'has-error' : '' }}">
    <label for="norma_id" class="control-label">{{ trans('mchecks.norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="norma_id" name="norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('norma_id', optional($mcheck)->norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('mchecks.norma_id__placeholder') }}</option>
        	@foreach ($normas as $key => $norma)
			    <option value="{{ $key }}" {{ old('norma_id', optional($mcheck)->norma_id) == $key ? 'selected' : '' }}>
			    	{{ $norma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('no_conformidad') ? 'has-error' : '' }}">
    <label for="no_conformidad" class="control-label">{{ trans('mchecks.no_conformidad') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="no_conformidad" type="text" id="no_conformidad" value="{{ old('no_conformidad', optional($mcheck)->no_conformidad) }}" minlength="1" maxlength="500" required="true" placeholder="{{ trans('mchecks.no_conformidad__placeholder') }}">
        {!! $errors->first('no_conformidad', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('correccion') ? 'has-error' : '' }}">
    <label for="correccion" class="control-label">{{ trans('mchecks.correccion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="correccion" type="text" id="correccion" value="{{ old('correccion', optional($mcheck)->correccion) }}" minlength="1" maxlength="500" required="true" placeholder="{{ trans('mchecks.correccion__placeholder') }}">
        {!! $errors->first('correccion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('requisito') ? 'has-error' : '' }}">
    <label for="requisito" class="control-label">{{ trans('mchecks.requisito') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="requisito" type="text" id="requisito" value="{{ old('requisito', optional($mcheck)->requisito) }}" minlength="1" maxlength="500" required="true" placeholder="{{ trans('mchecks.requisito__placeholder') }}">
        {!! $errors->first('requisito', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('rnc') ? 'has-error' : '' }}">
    <label for="rnc" class="control-label">{{ trans('mchecks.rnc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="rnc" type="text" id="rnc" value="{{ old('rnc', optional($mcheck)->rnc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('mchecks.rnc__placeholder') }}">
        {!! $errors->first('rnc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('minimo_vsm') ? 'has-error' : '' }}">
    <label for="minimo_vsm" class="control-label">{{ trans('mchecks.minimo_vsm') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="minimo_vsm" type="number" id="minimo_vsm" value="{{ old('minimo_vsm', optional($mcheck)->minimo_vsm) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('mchecks.minimo_vsm__placeholder') }}" step="any">
        {!! $errors->first('minimo_vsm', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('maximo_vsm') ? 'has-error' : '' }}">
    <label for="maximo_vsm" class="control-label">{{ trans('mchecks.maximo_vsm') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="maximo_vsm" type="number" id="maximo_vsm" value="{{ old('maximo_vsm', optional($mcheck)->maximo_vsm) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('mchecks.maximo_vsm__placeholder') }}" step="any">
        {!! $errors->first('maximo_vsm', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('orden') ? 'has-error' : '' }}">
    <label for="orden" class="control-label">{{ trans('mchecks.orden') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="orden" type="number" id="orden" value="{{ old('orden', optional($mcheck)->orden) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('mchecks.orden__placeholder') }}">
        {!! $errors->first('orden', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

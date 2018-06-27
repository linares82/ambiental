
<div class="form-group col-md-4 {{ $errors->has('bitacora_seguridad_id') ? 'has-error' : '' }}">
    <label for="bitacora_seguridad_id" class="control-label">{{ trans('comentarios_bs.bitacora_seguridad_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="bitacora_seguridad_id" name="bitacora_seguridad_id" required="true">
        	    <option value="" style="display: none;" {{ old('bitacora_seguridad_id', optional($comentariosB)->bitacora_seguridad_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('comentarios_bs.bitacora_seguridad_id__placeholder') }}</option>
        	@foreach ($bitacoraSeguridads as $key => $bitacoraSeguridad)
			    <option value="{{ $key }}" {{ old('bitacora_seguridad_id', optional($comentariosB)->bitacora_seguridad_id) == $key ? 'selected' : '' }}>
			    	{{ $bitacoraSeguridad }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('bitacora_seguridad_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('comentario') ? 'has-error' : '' }}">
    <label for="comentario" class="control-label">{{ trans('comentarios_bs.comentario') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="{{ old('comentario', optional($comentariosB)->comentario) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('comentarios_bs.comentario__placeholder') }}">
        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('costo') ? 'has-error' : '' }}">
    <label for="costo" class="control-label">{{ trans('comentarios_bs.costo') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="costo" type="number" id="costo" value="{{ old('costo', optional($comentariosB)->costo) }}" min="-999999" max="999999" required="true" placeholder="{{ trans('comentarios_bs.costo__placeholder') }}" step="any">
        {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
    <label for="estatus_id" class="control-label">{{ trans('comentarios_bs.estatus_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="estatus_id" name="estatus_id" required="true">
        	    <option value="" style="display: none;" {{ old('estatus_id', optional($comentariosB)->estatus_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('comentarios_bs.estatus_id__placeholder') }}</option>
        	@foreach ($sStBs as $key => $sStB)
			    <option value="{{ $key }}" {{ old('estatus_id', optional($comentariosB)->estatus_id) == $key ? 'selected' : '' }}>
			    	{{ $sStB }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('comentarios_bs.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($comentariosB)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('comentarios_bs.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($comentariosB)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('comentarios_bs.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($comentariosB)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('comentarios_bs.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($comentariosB)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


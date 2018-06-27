
<div class="form-group col-md-4 {{ $errors->has('a_archivo_id') ? 'has-error' : '' }}">
    <label for="a_archivo_id" class="control-label">{{ trans('a_comentarios_archivos.a_archivo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_archivo_id" name="a_archivo_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_archivo_id', optional($aComentariosArchivo)->a_archivo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_archivos.a_archivo_id__placeholder') }}</option>
        	@foreach ($aArchivos as $key => $aArchivo)
			    <option value="{{ $key }}" {{ old('a_archivo_id', optional($aComentariosArchivo)->a_archivo_id) == $key ? 'selected' : '' }}>
			    	{{ $aArchivo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_archivo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('comentario') ? 'has-error' : '' }}">
    <label for="comentario" class="control-label">{{ trans('a_comentarios_archivos.comentario') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="{{ old('comentario', optional($aComentariosArchivo)->comentario) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_comentarios_archivos.comentario__placeholder') }}">
        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('a_st_archivo_id') ? 'has-error' : '' }}">
    <label for="a_st_archivo_id" class="control-label">{{ trans('a_comentarios_archivos.a_st_archivo_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_st_archivo_id" name="a_st_archivo_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_st_archivo_id', optional($aComentariosArchivo)->a_st_archivo_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_archivos.a_st_archivo_id__placeholder') }}</option>
        	@foreach ($aStArchivos as $key => $aStArchivo)
			    <option value="{{ $key }}" {{ old('a_st_archivo_id', optional($aComentariosArchivo)->a_st_archivo_id) == $key ? 'selected' : '' }}>
			    	{{ $aStArchivo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_st_archivo_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('a_comentarios_archivos.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($aComentariosArchivo)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_archivos.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($aComentariosArchivo)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('a_comentarios_archivos.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($aComentariosArchivo)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_archivos.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($aComentariosArchivo)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


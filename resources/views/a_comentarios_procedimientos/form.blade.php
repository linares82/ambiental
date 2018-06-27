
<div class="form-group col-md-4 {{ $errors->has('a_procedimiento_id') ? 'has-error' : '' }}">
    <label for="a_procedimiento_id" class="control-label">{{ trans('a_comentarios_procedimientos.a_procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_procedimiento_id" name="a_procedimiento_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_procedimiento_id', optional($aComentariosProcedimiento)->a_procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_procedimientos.a_procedimiento_id__placeholder') }}</option>
        	@foreach ($aProcedimientos as $key => $aProcedimiento)
			    <option value="{{ $key }}" {{ old('a_procedimiento_id', optional($aComentariosProcedimiento)->a_procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $aProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('comentario') ? 'has-error' : '' }}">
    <label for="comentario" class="control-label">{{ trans('a_comentarios_procedimientos.comentario') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="{{ old('comentario', optional($aComentariosProcedimiento)->comentario) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_comentarios_procedimientos.comentario__placeholder') }}">
        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('a_st_procedimiento_id') ? 'has-error' : '' }}">
    <label for="a_st_procedimiento_id" class="control-label">{{ trans('a_comentarios_procedimientos.a_st_procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_st_procedimiento_id" name="a_st_procedimiento_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_st_procedimiento_id', optional($aComentariosProcedimiento)->a_st_procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_procedimientos.a_st_procedimiento_id__placeholder') }}</option>
        	@foreach ($aStArchivos as $key => $aStArchivo)
			    <option value="{{ $key }}" {{ old('a_st_procedimiento_id', optional($aComentariosProcedimiento)->a_st_procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $aStArchivo }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_st_procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('a_comentarios_procedimientos.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($aComentariosProcedimiento)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_procedimientos.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($aComentariosProcedimiento)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('a_comentarios_procedimientos.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($aComentariosProcedimiento)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_procedimientos.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($aComentariosProcedimiento)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


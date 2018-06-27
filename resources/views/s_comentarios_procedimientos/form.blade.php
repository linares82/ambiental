
<div class="form-group col-md-4 {{ $errors->has('s_procedimiento_id') ? 'has-error' : '' }}">
    <label for="s_procedimiento_id" class="control-label">{{ trans('s_comentarios_procedimientos.s_procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="s_procedimiento_id" name="s_procedimiento_id" required="true">
        	    <option value="" style="display: none;" {{ old('s_procedimiento_id', optional($sComentariosProcedimiento)->s_procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_comentarios_procedimientos.s_procedimiento_id__placeholder') }}</option>
        	@foreach ($sProcedimientos as $key => $sProcedimiento)
			    <option value="{{ $key }}" {{ old('s_procedimiento_id', optional($sComentariosProcedimiento)->s_procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $sProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('s_procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('comentario') ? 'has-error' : '' }}">
    <label for="comentario" class="control-label">{{ trans('s_comentarios_procedimientos.comentario') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="{{ old('comentario', optional($sComentariosProcedimiento)->comentario) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('s_comentarios_procedimientos.comentario__placeholder') }}">
        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('estatus_id') ? 'has-error' : '' }}">
    <label for="estatus_id" class="control-label">{{ trans('s_comentarios_procedimientos.estatus_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="estatus_id" name="estatus_id" required="true">
        	    <option value="" style="display: none;" {{ old('estatus_id', optional($sComentariosProcedimiento)->estatus_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_comentarios_procedimientos.estatus_id__placeholder') }}</option>
        	@foreach ($sEstatusProcedimientos as $key => $sEstatusProcedimiento)
			    <option value="{{ $key }}" {{ old('estatus_id', optional($sComentariosProcedimiento)->estatus_id) == $key ? 'selected' : '' }}>
			    	{{ $sEstatusProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('estatus_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('s_comentarios_procedimientos.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($sComentariosProcedimiento)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_comentarios_procedimientos.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($sComentariosProcedimiento)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('s_comentarios_procedimientos.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($sComentariosProcedimiento)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('s_comentarios_procedimientos.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($sComentariosProcedimiento)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>



<div class="form-group col-md-4 {{ $errors->has('a_rr_id') ? 'has-error' : '' }}">
    <label for="a_rr_id" class="control-label">{{ trans('a_comentarios_rrs.a_rr_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_rr_id" name="a_rr_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_rr_id', optional($aComentariosRrs)->a_rr_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_rrs.a_rr_id__placeholder') }}</option>
        	@foreach ($aRrAmbientales as $key => $aRrAmbientale)
			    <option value="{{ $key }}" {{ old('a_rr_id', optional($aComentariosRrs)->a_rr_id) == $key ? 'selected' : '' }}>
			    	{{ $aRrAmbientale }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_rr_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('comentario') ? 'has-error' : '' }}">
    <label for="comentario" class="control-label">{{ trans('a_comentarios_rrs.comentario') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="comentario" type="text" id="comentario" value="{{ old('comentario', optional($aComentariosRrs)->comentario) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('a_comentarios_rrs.comentario__placeholder') }}">
        {!! $errors->first('comentario', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('a_st_rr_id') ? 'has-error' : '' }}">
    <label for="a_st_rr_id" class="control-label">{{ trans('a_comentarios_rrs.a_st_rr_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_st_rr_id" name="a_st_rr_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_st_rr_id', optional($aComentariosRrs)->a_st_rr_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_rrs.a_st_rr_id__placeholder') }}</option>
        	@foreach ($aStRrs as $key => $aStRr)
			    <option value="{{ $key }}" {{ old('a_st_rr_id', optional($aComentariosRrs)->a_st_rr_id) == $key ? 'selected' : '' }}>
			    	{{ $aStRr }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_st_rr_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="control-label">{{ trans('a_comentarios_rrs.usu_alta_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($aComentariosRrs)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_rrs.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($aComentariosRrs)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="control-label">{{ trans('a_comentarios_rrs.usu_mod_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($aComentariosRrs)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('a_comentarios_rrs.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($aComentariosRrs)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


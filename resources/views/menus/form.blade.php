
<div class="form-group col-md-4 {{ $errors->has('item') ? 'has-error' : '' }}">
    <label for="item" class="col-md-2 control-label">{{ trans('menus.item') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="item" type="text" id="item" value="{{ old('item', optional($menu)->item) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('menus.item__placeholder') }}">
        {!! $errors->first('item', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('orden') ? 'has-error' : '' }}">
    <label for="orden" class="col-md-2 control-label">{{ trans('menus.orden') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="orden" type="number" id="orden" value="{{ old('orden', optional($menu)->orden) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('menus.orden__placeholder') }}">
        {!! $errors->first('orden', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('depende_de') ? 'has-error' : '' }}">
    <label for="depende_de" class="col-md-2 control-label">{{ trans('menus.depende_de') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="depende_de" type="number" id="depende_de" value="{{ old('depende_de', optional($menu)->depende_de) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('menus.depende_de__placeholder') }}">
        {!! $errors->first('depende_de', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('link') ? 'has-error' : '' }}">
    <label for="link" class="col-md-2 control-label">{{ trans('menus.link') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="link" type="text" id="link" value="{{ old('link', optional($menu)->link) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('menus.link__placeholder') }}">
        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('permiso_id') ? 'has-error' : '' }}">
    <label for="permiso_id" class="col-md-2 control-label">{{ trans('menus.permiso_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="permiso_id" name="permiso_id" required="true">
        	    <option value="" style="display: none;" {{ old('permiso_id', optional($menu)->permiso_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('menus.permiso_id__placeholder') }}</option>
        	@foreach ($permisos as $key => $permiso)
			    <option value="{{ $key }}" {{ old('permiso_id', optional($menu)->permiso_id) == $key ? 'selected' : '' }}>
			    	{{ $permiso }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('permiso_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('target') ? 'has-error' : '' }}">
    <label for="target" class="col-md-2 control-label">{{ trans('menus.target') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="target" type="text" id="target" value="{{ old('target', optional($menu)->target) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('menus.target__placeholder') }}">
        {!! $errors->first('target', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_alta_id') ? 'has-error' : '' }}">
    <label for="usu_alta_id" class="col-md-2 control-label">{{ trans('menus.usu_alta_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_alta_id" name="usu_alta_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_alta_id', optional($menu)->usu_alta_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('menus.usu_alta_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_alta_id', optional($menu)->usu_alta_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_alta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('usu_mod_id') ? 'has-error' : '' }}">
    <label for="usu_mod_id" class="col-md-2 control-label">{{ trans('menus.usu_mod_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="usu_mod_id" name="usu_mod_id" required="true">
        	    <option value="" style="display: none;" {{ old('usu_mod_id', optional($menu)->usu_mod_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('menus.usu_mod_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('usu_mod_id', optional($menu)->usu_mod_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('usu_mod_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('activo') ? 'has-error' : '' }}">
    <label for="activo" class="col-md-2 control-label">{{ trans('menus.activo') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="activo" type="number" id="activo" value="{{ old('activo', optional($menu)->activo) }}" min="-2147483648" max="2147483647" placeholder="{{ trans('menus.activo__placeholder') }}">
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('imagen') ? 'has-error' : '' }}">
    <label for="imagen" class="col-md-2 control-label">{{ trans('menus.imagen') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="imagen" type="text" id="imagen" value="{{ old('imagen', optional($menu)->imagen) }}" min="0" max="200" placeholder="{{ trans('menus.imagen__placeholder') }}">
        {!! $errors->first('imagen', '<p class="help-block">:message</p>') !!}
    </div>
</div>


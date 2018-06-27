
<div class="form-group col-md-4 {{ $errors->has('ctrl_interno') ? 'has-error' : '' }}">
    <label for="ctrl_interno" class="control-label">{{ trans('empleados.ctrl_interno') }}</label>
    
        <input class="form-control input-sm " name="ctrl_interno" type="text" id="ctrl_interno" value="{{ old('ctrl_interno', optional($empleado)->ctrl_interno) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('empleados.ctrl_interno__placeholder') }}">
        {!! $errors->first('ctrl_interno', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
    <label for="nombre" class="control-label">{{ trans('empleados.nombre') }}</label>
    
        <input class="form-control input-sm " name="nombre" type="text" id="nombre" value="{{ old('nombre', optional($empleado)->nombre) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('empleados.nombre__placeholder') }}">
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('direccion') ? 'has-error' : '' }}">
    <label for="direccion" class="control-label">{{ trans('empleados.direccion') }}</label>
    
        <input class="form-control input-sm " name="direccion" type="text" id="direccion" value="{{ old('direccion', optional($empleado)->direccion) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('empleados.direccion__placeholder') }}">
        {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('mail') ? 'has-error' : '' }}">
    <label for="mail" class="control-label">{{ trans('empleados.mail') }}</label>
    
        <input class="form-control input-sm " name="mail" type="text" id="mail" value="{{ old('mail', optional($empleado)->mail) }}" minlength="1" maxlength="250" required="true" placeholder="{{ trans('empleados.mail__placeholder') }}">
        {!! $errors->first('mail', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('contacto') ? 'has-error' : '' }}">
    <label for="contacto" class="control-label">{{ trans('empleados.contacto') }}</label>
    
        <input class="form-control input-sm " name="contacto" type="text" id="contacto" value="{{ old('contacto', optional($empleado)->contacto) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('empleados.contacto__placeholder') }}">
        {!! $errors->first('contacto', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('area_id') ? 'has-error' : '' }}">
    <label for="area_id" class="control-label">{{ trans('empleados.area_id') }}</label>
    
        <select class="form-control chosen" id="area_id" name="area_id" required="true">
        	    <option value="" style="display: none;" {{ old('area_id', optional($empleado)->area_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('empleados.area_id__placeholder') }}</option>
        	@foreach ($areas as $key => $area)
			    <option value="{{ $key }}" {{ old('area_id', optional($empleado)->area_id) == $key ? 'selected' : '' }}>
			    	{{ $area }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('area_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('puesto_id') ? 'has-error' : '' }}" style="clear:left;">
    <label for="puesto_id" class="control-label">{{ trans('empleados.puesto_id') }}</label>
    
        <select class="form-control chosen" id="puesto_id" name="puesto_id" required="true">
        	    <option value="" style="display: none;" {{ old('puesto_id', optional($empleado)->puesto_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('empleados.puesto_id__placeholder') }}</option>
        	@foreach ($puestos as $key => $puesto)
			    <option value="{{ $key }}" {{ old('puesto_id', optional($empleado)->puesto_id) == $key ? 'selected' : '' }}>
			    	{{ $puesto }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('puesto_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('bnd_subordinados') ? 'has-error' : '' }}">
    <label for="bnd_subordinados" class="control-label">{{ trans('empleados.bnd_subordinados') }}</label>
    
        <select class="form-control chosen" id="bnd_subordinados" name="bnd_subordinados" required="true">
        	    <option value="" style="display: none;" {{ old('bnd_subordinados', optional($empleado)->bnd_subordinados ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('empleados.bnd_subordinados__placeholder') }}</option>
        	@foreach ($bnds as $key => $bnd)
			    <option value="{{ $key }}" {{ old('bnd_subordinados', optional($empleado)->bnd_subordinados) == $key ? 'selected' : '' }}>
			    	{{ $bnd }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('bnd_subordinados', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('jefe_id') ? 'has-error' : '' }}">
    <label for="jefe_id" class="control-label">{{ trans('empleados.jefe_id') }}</label>
    
        <select class="form-control chosen" id="jefe_id" name="jefe_id" required="true">
        	    <option value="" style="display: none;" {{ old('jefe_id', optional($empleado)->jefe_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('empleados.jefe_id__placeholder') }}</option>
        	@foreach ($jeves as $key => $jefe)
			    <option value="{{ $key }}" {{ old('jefe_id', optional($empleado)->jefe_id) == $key ? 'selected' : '' }}>
			    	{{ $jefe }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('jefe_id', '<p class="help-block">:message</p>') !!}
    
</div>

<div class="form-group col-md-4 {{ $errors->has('user_id') ? 'has-error' : '' }}">
    <label for="user_id" class="control-label">{{ trans('empleados.user_id') }}</label>
    
        <select class="form-control chosen" id="user_id" name="user_id" required="true">
        	    <option value="" style="display: none;" {{ old('user_id', optional($empleado)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('empleados.user_id__placeholder') }}</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('user_id', optional($empleado)->user_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    
</div>

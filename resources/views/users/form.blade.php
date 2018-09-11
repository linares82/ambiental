
<div class="form-group col-md-6 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-3 control-label">{{ trans('users.name') }}</label>
    <div class="col-md-9">
        <input class="form-control input-sm " name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-3 control-label">{{ trans('users.email') }}</label>
    <div class="col-md-9">
        <input class="form-control input-sm " name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('users.email__placeholder') }}">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-3 control-label">Password</label>
    <div class="col-md-9">
        <input id="password" type="password" class="form-control" name="password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group col-md-6">
    <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>
    <div class="col-md-9">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
    </div>
</div>

@ifUserCan('users.user.multi_entidad')
<div class="form-group col-md-6 {{ $errors->has('multi_entidad') ? 'has-error' : '' }}">
    <label for="multi_entidad" class="control-label">{{ trans('entities.multi_entidad') }}</label>
    
        <div class="checkbox">
            <label for="multi_entidad_1">
            	<input id="multi_entidad_1" class="" name="multi_entidad" type="checkbox" value="1" {{ old('multi_entidad', optional($user)->multi_entidad) == '1' ? 'checked' : '' }}>
                Si
            </label>
        </div>

        {!! $errors->first('multi_entidad', '<p class="help-block">:message</p>') !!}
    
</div>
@endif


<div class="form-group col-md-6 col-xs-12 {{ $errors->has('entity_id') ? 'has-error' : '' }}">
    <label for="entity_id" class="control-label">{{ trans('users.entity_id') }}</label>
    
        <select class="form-control chosen" id="estado_id" name="entity_id" required="true" style='width:100%;'>
        	    <option value="" style="display: none;" {{ old('entity_id', optional($user)->entity_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('users.entity_id__placeholder') }}</option>
        	@foreach ($entities as $key => $entity)
			    <option value="{{ $key }}" {{ old('entity_id', optional($user)->entity_id) == $key ? 'selected' : '' }}>
			    	{{ $entity }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('entity_id', '<p class="help-block">:message</p>') !!}
    
</div>

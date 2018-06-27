
<div class="form-group col-md-4 {{ $errors->has('slug') ? 'has-error' : '' }}">
    <label for="slug" class="col-md-2 control-label">{{ trans('permissions.slug') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="slug" type="text" id="slug" value="{{ old('slug', optional($permission)->slug) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('permissions.slug__placeholder') }}">
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('permissions.name') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="name" type="text" id="name" value="{{ old('name', optional($permission)->name) }}" maxlength="255" placeholder="{{ trans('permissions.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>


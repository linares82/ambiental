
<div class="form-group col-md-4 {{ $errors->has('bnd') ? 'has-error' : '' }}">
    <label for="bnd" class="col-md-2 control-label">{{ trans('bnds.bnd') }}</label>
    <div class="col-md-10">
        <input class="form-control input-sm " name="bnd" type="text" id="bnd" value="{{ old('bnd', optional($bnd)->bnd) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('bnds.bnd__placeholder') }}">
        {!! $errors->first('bnd', '<p class="help-block">:message</p>') !!}
    </div>
</div>


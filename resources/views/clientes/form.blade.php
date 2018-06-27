
<div class="form-group col-md-4 {{ $errors->has('cliente') ? 'has-error' : '' }}">
    <label for="cliente" class=" control-label">{{ trans('clientes.cliente') }}</label>

        <input class="form-control input-sm " name="cliente" type="text" id="cliente" value="{{ old('cliente', optional($cliente)->cliente) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('clientes.cliente__placeholder') }}">
        {!! $errors->first('cliente', '<p class="help-block">:message</p>') !!}

</div>



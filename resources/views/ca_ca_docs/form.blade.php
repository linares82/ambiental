
<div class="form-group col-md-4 {{ $errors->has('doc') ? 'has-error' : '' }}">
    <label for="doc" class="control-label">{{ trans('ca_ca_docs.doc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="doc" type="text" id="doc" value="{{ old('doc', optional($caCaDoc)->doc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('ca_ca_docs.doc__placeholder') }}">
        {!! $errors->first('doc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


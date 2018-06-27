
<div class="form-group col-md-4 {{ $errors->has('tpo_doc') ? 'has-error' : '' }}">
    <label for="tpo_doc" class="control-label">{{ trans('tpo_docs.tpo_doc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_doc" type="text" id="tpo_doc" value="{{ old('tpo_doc', optional($tpoDoc)->tpo_doc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('tpo_docs.tpo_doc__placeholder') }}">
        {!! $errors->first('tpo_doc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


<div class="form-group col-md-4 {{ $errors->has('cat_doc') ? 'has-error' : '' }}">
    <label for="cat_doc" class="control-label">{{ trans('cs_cat_docs.cat_doc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="cat_doc" type="text" id="cat_doc" value="{{ old('cat_doc', optional($csCatDoc)->cat_doc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_cat_docs.cat_doc__placeholder') }}">
        {!! $errors->first('cat_doc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


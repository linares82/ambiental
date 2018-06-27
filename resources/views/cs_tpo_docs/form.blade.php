
<div class="form-group col-md-4 {{ $errors->has('tpo_procedimiento_id') ? 'has-error' : '' }}">
    <label for="tpo_procedimiento_id" class="control-label">{{ trans('cs_tpo_docs.tpo_procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="tpo_procedimiento_id" name="tpo_procedimiento_id" required="true">
        	    <option value="" style="display: none;" {{ old('tpo_procedimiento_id', optional($csTpoDoc)->tpo_procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_tpo_docs.tpo_procedimiento_id__placeholder') }}</option>
        	@foreach ($csTpoProcedimientos as $key => $csTpoProcedimiento)
			    <option value="{{ $key }}" {{ old('tpo_procedimiento_id', optional($csTpoDoc)->tpo_procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $csTpoProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tpo_procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('tpo_doc') ? 'has-error' : '' }}">
    <label for="tpo_doc" class="control-label">{{ trans('cs_tpo_docs.tpo_doc') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="tpo_doc" type="text" id="tpo_doc" value="{{ old('tpo_doc', optional($csTpoDoc)->tpo_doc) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_tpo_docs.tpo_doc__placeholder') }}">
        {!! $errors->first('tpo_doc', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


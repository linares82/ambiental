

<div class="form-group col-md-4 {{ $errors->has('anio') ? 'has-error' : '' }}">
    <label for="anio" class="control-label">{{ trans('rev_requisitos.anio') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="anio" type="number" id="anio" value="{{ old('anio', optional($revRequisito)->anio) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('rev_requisitos.anio__placeholder') }}">
        {!! $errors->first('anio', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('mes_id') ? 'has-error' : '' }}">
    <label for="mes_id" class="control-label">{{ trans('rev_requisitos.mes_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="mes_id" name="mes_id" required="true">
        	    <option value="" style="display: none;" {{ old('mes_id', optional($revRequisito)->mes_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rev_requisitos.mes_id__placeholder') }}</option>
        	@foreach ($mese as $key => $mese)
			    <option value="{{ $key }}" {{ old('mes_id', optional($revRequisito)->mes_id) == $key ? 'selected' : '' }}>
			    	{{ $mese }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('mes_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


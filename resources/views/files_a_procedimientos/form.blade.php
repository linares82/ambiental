
<div class="form-group col-md-4 {{ $errors->has('file_path') ? 'has-error' : '' }}">
    <label for="file_path" class="control-label">{{ trans('files_a_procedimientos.file_path') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="file_path" type="text" id="file_path" value="{{ old('file_path', optional($filesAProcedimiento)->file_path) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('files_a_procedimientos.file_path__placeholder') }}">
        {!! $errors->first('file_path', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
    <label for="descripcion" class="control-label">{{ trans('files_a_procedimientos.descripcion') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="descripcion" type="text" id="descripcion" value="{{ old('descripcion', optional($filesAProcedimiento)->descripcion) }}" maxlength="255" placeholder="{{ trans('files_a_procedimientos.descripcion__placeholder') }}">
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('a_procedimiento_id') ? 'has-error' : '' }}">
    <label for="a_procedimiento_id" class="control-label">{{ trans('files_a_procedimientos.a_procedimiento_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control" id="a_procedimiento_id" name="a_procedimiento_id">
        	    <option value="" style="display: none;" {{ old('a_procedimiento_id', optional($filesAProcedimiento)->a_procedimiento_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('files_a_procedimientos.a_procedimiento_id__placeholder') }}</option>
        	@foreach ($aProcedimientos as $key => $aProcedimiento)
			    <option value="{{ $key }}" {{ old('a_procedimiento_id', optional($filesAProcedimiento)->a_procedimiento_id) == $key ? 'selected' : '' }}>
			    	{{ $aProcedimiento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_procedimiento_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>


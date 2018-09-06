
<div class="form-group col-md-4 {{ $errors->has('grupo_norma_id') ? 'has-error' : '' }}">
    <label for="grupo_norma_id" class="control-label">{{ trans('cs_elementos_inspeccions.grupo_norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="grupo_norma_id" name="grupo_norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('grupo_norma_id', optional($csElementosInspeccion)->grupo_norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_elementos_inspeccions.grupo_norma_id__placeholder') }}</option>
        	@foreach ($csGrupoNormas as $key => $csGrupoNorma)
			    <option value="{{ $key }}" {{ old('grupo_norma_id', optional($csElementosInspeccion)->grupo_norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csGrupoNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('grupo_norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('norma_id') ? 'has-error' : '' }}">
    <label for="norma_id" class="control-label">{{ trans('cs_elementos_inspeccions.norma_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="norma_id" name="norma_id" required="true">
        	    <option value="" style="display: none;" {{ old('norma_id', optional($csElementosInspeccion)->norma_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('cs_elementos_inspeccions.norma_id__placeholder') }}</option>
        	@foreach ($csNormas as $key => $csNorma)
			    <option value="{{ $key }}" {{ old('norma_id', optional($csElementosInspeccion)->norma_id) == $key ? 'selected' : '' }}>
			    	{{ $csNorma }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('norma_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('elemento') ? 'has-error' : '' }}">
    <label for="elemento" class="control-label">{{ trans('cs_elementos_inspeccions.elemento') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="elemento" type="text" id="elemento" value="{{ old('elemento', optional($csElementosInspeccion)->elemento) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('cs_elementos_inspeccions.elemento__placeholder') }}">
        {!! $errors->first('elemento', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

@push('scripts')
<script type="text/javascript">
    
    jQuery(document).ready(function () {
        
        function cmbNormas() {
            var a = $('#cs_elementos_inspeccion_form').serialize();
            $.ajax({
                url: "{{url('cs_normas/cmbNormas')}}",
                type: 'GET',
                data: a,
                dataType: 'json',
                beforeSend: function () {
                    $("#loading1").show();
                },
                complete: function () {
                    $("#loading1").hide();
                },
                success: function (s) {

                    $('select#norma_id').empty();
                    $.each(s, function (i) {
                        $('select#norma_id').append("<option " + s[i].selectec + " value=\"" + s[i].id + "\">" + s[i].norma + "<\/option>");
                    });
                    $("select#norma_id").trigger("chosen:updated");
                }
            });
        }

        $("#grupo_norma_id").change(function (event) {
            cmbNormas();
        });
        
    });
</script>
@endpush    

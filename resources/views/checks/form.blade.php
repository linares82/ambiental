
<div class="form-group col-md-4 {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
    <label for="cliente" class="control-label">{{ trans('checks.cliente') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen" id="cliente" name="cliente_id" required="true">
        	    <option value="" style="display: none;" {{ old('cliente_id', optional($check)->cliente_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('checks.cliente__placeholder') }}</option>
        	@foreach ($clientes as $key => $cliente)
			    <option value="{{ $key }}" {{ old('cliente', optional($check)->cliente_id) == $key ? 'selected' : '' }}>
			    	{{ $cliente }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('cliente_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('a_check_id') ? 'has-error' : '' }}">
    <label for="a_check_id" class="control-label">{{ trans('checks.a_check_id') }}</label>
    <!--<div class="col-md-10">-->
        <select class="form-control chosen " id="a_check_id" name="a_check_id" required="true">
        	    <option value="" style="display: none;" {{ old('a_check_id', optional($check)->a_check_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('checks.a_check_id__placeholder') }}</option>
        	@foreach ($aChecks as $key => $aCheck)
			    <option value="{{ $key }}" {{ old('a_check_id', optional($check)->a_check_id) == $key ? 'selected' : '' }}>
			    	{{ $aCheck }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('a_check_id', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('solicitud') ? 'has-error' : '' }}">
    <label for="solicitud" class="control-label">{{ trans('checks.solicitud') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="solicitud" type="text" id="solicitud" value="{{ old('solicitud', optional($check)->solicitud) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('checks.solicitud__placeholder') }}">
        {!! $errors->first('solicitud', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('detalle') ? 'has-error' : '' }}">
    <label for="detalle" class="control-label">{{ trans('checks.detalle') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm " name="detalle" type="text" id="detalle" value="{{ old('detalle', optional($check)->detalle) }}" minlength="1" maxlength="255" required="true" placeholder="{{ trans('checks.detalle__placeholder') }}">
        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_apertura') ? 'has-error' : '' }}">
    <label for="fec_apertura" class="control-label">{{ trans('checks.fec_apertura') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_apertura" type="text" id="fec_apertura" value="{{ old('fec_apertura', optional($check)->fec_apertura) }}" required="true" placeholder="{{ trans('checks.fec_apertura__placeholder') }}">
        {!! $errors->first('fec_apertura', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

<div class="form-group col-md-4 {{ $errors->has('fec_cierre') ? 'has-error' : '' }}">
    <label for="fec_cierre" class="control-label">{{ trans('checks.fec_cierre') }}</label>
    <!--<div class="col-md-10">-->
        <input class="form-control input-sm date-picker" name="fec_cierre" type="text" id="fec_cierre" value="{{ old('fec_cierre', optional($check)->fec_cierre) }}" required="true" placeholder="{{ trans('checks.fec_cierre__placeholder') }}">
        {!! $errors->first('fec_cierre', '<p class="help-block">:message</p>') !!}
    <!--</div>-->
</div>

@if(isset($check))
<div class="row"> <strong>Normas relacionadas</strong> </div>
<div class="row_normas_relacionados">
    
<div class="col-xs-5">
    {!! Form::select("select-norma_id", $normas, null, array("class" => "form-control select-multiple", "id" => "select-normas_from", "name"=>"from[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
</div>

<div class="col-xs-2">
    <!--<button type="button" id="right_All_1" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
    <button type="button" id="right_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
    <button type="button" id="left_Selected_1" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
    <!--<button type="button" id="left_All_1" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
</div>

<div class="col-xs-5">
    {!! Form::select("select-norma_id", $normasRelacionados, null, array("class" => "form-control select-multiple", "id" => "select-normas_to", "name"=>"to[]", 'multiple'=>'multiple', 'style'=>'height:200px;')) !!}
</div>
</div>
@endif

@push('scripts')
<link href="{{ asset('ace-master/assets/css/jquery.loading.css') }}" rel="stylesheet">
<script src="{{ asset('ace-master/assets/js/multiselect.js') }}"></script>
<script src="{{ asset('ace-master/assets/js/jquery.loading.js') }}"></script>

<script type="text/javascript">
    
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });

    jQuery(document).ready(function($) {
        @if(isset($check))
        $('#select-normas_from').multiselect({
            right: '#select-normas_to',
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
            },
            fireSearch: function(value) {
                return value.length > 3;
            },
            rightAll: '#right_All_1',
            rightSelected: '#right_Selected_1',
            leftSelected: '#left_Selected_1',
            leftAll: '#left_All_1',
            beforeMoveToLeft: function($left, $right, $options) { 
                var norma=$( "select#select-normas_to option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.lessNorma") }}',
                    type: 'GET',
                    data: "check={{$check->id}}&norma=" + norma + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_normas_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_normas_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
            },
            beforeMoveToRight: function($left, $right, $options) { 
                var norma=$( "select#select-normas_from option:selected" ).val();
                $.ajax({
                    url: '{{ route("roles.role.addNorma") }}',
                    type: 'GET',
                    data: "check={{$check->id}}&norma=" + norma + "",
                    dataType: 'json',
                    beforeSend : function(){ $('.row_normas_relacionados').loading({
                                                theme: 'dark',
                                                message: 'Procesando..',
                                                }); 
                                            },
                    complete : function(){ $('.row_normas_relacionados').loading('stop'); },
                    success: function(data){
                        
                    }
                });
                return true;
                
            },
        });
        @endif
    });

</script>
@endpush
@extends('layouts.master1')

@section('content')
	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<a href="{{route('home')}}">
				<i class="ace-icon fa fa-home home-icon"></i>
				</a>
			</li>

			<li>
				<a href="{{ route('condiciones.condicione.index') }}">{{ trans('condiciones.model_plural') }}</a>
			</li>
			<li class="active">Crear</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('condiciones.create') }}</h4>
            </span>
            @ifUserCan('condiciones.condicione.index')
            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('condiciones.condicione.index') }}" class="btn btn-primary" title="{{ trans('condiciones.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
            </div>
            @endif
        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        <form method="POST" action="{{ route('consultas.consulta.postReqReg') }}" accept-charset="UTF-8" id="create_condicione_form" name="create_condicione_form" class="">
            {{ csrf_field() }}

        <div class="form-group col-md-6 {{ $errors->has('entity_f') ? 'has-error' : '' }}">
            <label for="entity_f" class="control-label">Entidad de:</label>
            <!--<div class="col-md-10">-->
                <select class="form-control chosen" id="entity_f" name="entity_f" required="true">
                            <option value="" style="display: none;"  disabled selected>Seleccionar</option>
                                @foreach ($entities as $key => $entity)
                                    <option value="{{ $key }}">
                                        {{ $entity }}
                                    </option>
                                @endforeach
                </select>

                {!! $errors->first('impacto_id', '<p class="help-block">:message</p>') !!}
            <!--</div>-->
        </div>    
        
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('condiciones.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
    })
    //show datepicker when clicking on the icon
    .next().on(ace.click_event, function(){
            $(this).prev().focus();
    });
</script>
@endpush    

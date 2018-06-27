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
            <a href="{{ route('ln_impactos.ln_impacto.index') }}">{{ trans('ln_impactos.model_plural') }}</a>
        </li>
        <li class="active">Editar</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="panel panel-default">

    <div class="panel-heading clearfix">

        <div class="pull-left">
            <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('ln_impactos.model_plural') }}</h4>
        </div>
        <div class="btn-group btn-group-sm pull-right" role="group">
            @ifUserCan('ln_impactos.ln_impacto.index')
            <a href="{{ route('enc_impactos.enc_impacto.index') }}" class="btn btn-primary" title="{{ trans('ln_impactos.show_all') }}">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </a>
            @endif
            @ifUserCan('ln_impactos.ln_impacto.create')
<!--            <a href="{{ route('ln_impactos.ln_impacto.create') }}" class="btn btn-success" title="{{ trans('ln_impactos.create') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>-->
            @endif
        </div>
    </div>

    <div class="panel-body">

        @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('ln_impactos.ln_impacto.update', $lnImpacto->id) }}" id="edit_ln_impacto_form" name="edit_ln_impacto_form" accept-charset="UTF-8" class="">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('ln_impactos.form', [
            'lnImpacto' => $lnImpacto,
            ])

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input class="btn btn-primary" type="submit" value="{{ trans('ln_impactos.update') }}">
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>

                    <th>{{ trans('ln_caracteristicas.caracteristica_id') }}</th>
                    <th>{{ trans('ln_caracteristicas.efecto_id') }}</th>
                    <th>{{ trans('imp_potencials.imp_potencial') }}</th>
                    <th>{{ trans('imp_reals.imp_real') }}</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($lnImpacto->lnCaracteristicas as $lnCaracteristica)
                <tr>

                    <td>{{ optional($lnCaracteristica->caracteristica)->caracteristica }}</td>
                    <td>{{ optional($lnCaracteristica->efecto)->descripcion }}</td>
                    <td>{{ optional($lnCaracteristica->impPotencial)->imp_potencial }}</td>
                    <td>{{ optional($lnCaracteristica->impReal)->imp_real }}</td>
                    <td>

                        <form method="POST" action="{!! route('ln_caracteristicas.ln_caracteristica.destroy', $lnCaracteristica->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}

                            <div class="btn-group btn-group-xs pull-right" role="group">

                                @ifUserCan('ln_caracteristicas.ln_caracteristica.edit')
                                <a href="{{ route('ln_caracteristicas.ln_caracteristica.edit', $lnCaracteristica->id ) }}" class="btn btn-primary btn-xs" title="{{ trans('ln_caracteristicas.edit') }}">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                
                                @endif

                            </div>

                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>


<!--Fin Modal change customer-->

@endsection
@push('scripts')
<script>
    //editar nota
    $(".cerrarModal").click(function(){
        
        $("#editModal").modal('hide')
      });
    $(document).on('click', '#editar_caracteristica', function(){
        //alert('aler');
        $('#efecto_id').val($(this).data('efecto_id')).chosen().change();
        $('#descripcion').val($(this).data('descripcion'));
        $('#resarcion').val($(this).data('resarcion'));
        $('#emision_efecto_id').val($(this).data('emision_efecto_id')).change();
        $('#duracion_accion_id').val($(this).data('duracion_accion_id')).change();
        $('#continuidad_efecto_id').val($(this).data('continuidad_efecto_id')).change();
        $('#reversibilidad_id').val($(this).data('reversibilidad_id')).change();
        $('#probabilidad_id').val($(this).data('probabilidad_id')).change();
        $('#mitigacion_id').val($(this).data('mitigacion_id')).change();
        $('#intensidad_impacto_id').val($(this).data('intensidad_impacto_id'));
        
        //$('#actualizar_nota').attr('data-id', $(this).data('id'))
        $('#editModal').show();
    });
    /*
    $(document).on('click', '#actualizar_nota', function(){
        //alert($('#producto-buscar').val());
        $.ajax({
            type: 'POST',
            url: "{{ url('notes/note/').'/' }}"+$(this).data('id'),
            data: {
                '_token': $('input[name=_token]').val(),
                'oportunity_id':,
                'note': $('#note').val()
            },
            beforeSend : function(){$("#loading3").show(); },
            complete : function(){$("#loading3").hide(); },
            success: function(data) { 
                toastr.success('Operacion realizada', 'Mensaje', {timeOut: 5000});
                $('#ln_nota' + data.id).replaceWith("<tr id='ln_nota"+data.id+"'><td>" + 
                                        data.note + "</td><td>" + data.created_at + 
                                        "</td><td> <button type='button' class='btn btn-warning btn-minier' id='editar_nota' data-id='" + data.id + 
                                        "' data-note='"+ data.note +
                                        "'> "+ "{{ trans('notes.edit') }}" +
                                        " <i class='glyphicon glyphicon-edit'></i> </button> <button type='button' class='btn btn-danger btn-minier' id='borrar_nota' data-id='"+
                                        data.id + "'>"+ "{{ trans('notes.delete') }}"+"<i class='glyphicon glyphicon-trash'></i></button> </td>"); 
                                
                $('#actualizar_nota').hide();
                $('#guardar_nota').show();
                $('#note').val("");
                
            }
        });
        
    });*/
</script>
@endpush
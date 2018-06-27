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
				<a href="{{ route('rev_documental_lns.rev_documental_ln.index') }}">{{ trans('rev_documental_lns.model_plural') }}</a>
			</li>
			<li class="active">Editar</li>
		</ul><!-- /.breadcrumb -->
	</div>
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : trans('rev_documental_lns.model_plural')  }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">
                @ifUserCan('rev_documental_lns.rev_documental_ln.index')
                <a href="{{ route('rev_documental_lns.rev_documental_ln.index') }}" class="btn btn-primary" title="{{ trans('rev_documental_lns.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>
                @endif
                @ifUserCan('rev_documental_lns.rev_documental_ln.create')
                <a href="{{ route('rev_documental_lns.rev_documental_ln.create') }}" class="btn btn-success" title="{{ trans('rev_documental_lns.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
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

            <form method="POST" action="{{ route('rev_documental_lns.rev_documental_ln.update', $revDocumentalLn->id) }}" id="edit_rev_documental_ln_form" name="edit_rev_documental_ln_form" accept-charset="UTF-8" class="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('rev_documental_lns.form', [
                                        'revDocumentalLn' => $revDocumentalLn,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('rev_documental_lns.update') }}">
                    </div>
                </div>
            </form>
            @if(isset($revDocumentalLn))
            <form method="DELETE" action="{{ route('rev_documental_lns.rev_documental_ln.update', $revDocumentalLn->id) }}" id="edit_rev_documental_ln_form2" name="edit_rev_documental_ln_form2" accept-charset="UTF-8" class="" enctype="multipart/form-data">
            
            <input type="hidden" name="rev_documental_ln" id="rev_documental_ln"  value="{{$revDocumentalLn->id}}"> 
            <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
            <div class="form-group col-md-6">
                <label for="descripcion" class="control-label">Descripción</label><br>
                <input type="text" name="descripcion" id="descripcion"  value="" placeholder="Descripción" class="form-control input-sm"> 
            </div>
            <div class="form-group col-md-6">
                <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Adjuntar Archivo
                    <input type="file"  id="file" name="file" class="email_archivo" >
                    <input type="hidden"  id="file_hidden" name="file_hidden" >
                </div>
                <p class="help-block"  >Max. 20MB</p>
                <div id="texto_notificacion">
                </div>
            </div>
            </form>
            <table class="table table-striped table-bordered table-hover">
                <th>
                <td>Descripcion</td>
                <td>Archivo</td>
                <td></td>
                </th>
                @foreach($revDocumentalLn->files as $file)
                
                <tr>
                    <td>{{$file->descripcion}}</td>
                    <td><a href="{{asset('/storage/files_rev_documental_ln/'.$file->file_path)}}" target="_blank"> {{$file->file_path}} </a></td>
                    <td>
                        <form method="POST" action="{!! route('files_rev_documental_lns.files_rev_documental_ln.destroy', $file->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-xs" title="{{ trans('files_rev_documental_lns.delete') }}" onclick="return confirm(&quot;{{ trans('files_rev_documental_lns.confirm_delete') }}&quot;)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </table>
        @endif
        </div>
    </div>

@endsection
@push('scripts')
<script type="text/javascript">
    
    
    
    @if(isset($revDocumentalLn))
    $(document).on("change", ".email_archivo", function (e) {
        var miurl = "{{route('files_rev_documental_lns.files_rev_documental_ln.cargaArchivo')}}";
        // var fileup=$("#file").val();
        var divresul = "texto_notificacion";

        var data = new FormData();
        data.append('file', $('#file')[0].files[0]);
        data.append('files_rev_documental_ln', $('#rev_documental_ln').val());
        data.append('descripcion', $('#descripcion').val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#_token').val()
            }
        });
        $.ajax({
            url: miurl,
            type: 'POST',

            // Form data
            //datos del formulario
            data: data,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                $("#" + divresul + "").html($("#cargador_empresa").html());
            },
            //una vez finalizado correctamente
            success: function (data) {
                location.reload();
            },
            //si ha ocurrido un error
            error: function (data) {
                

            }
        });
    })
@endif
</script>
@endpush    
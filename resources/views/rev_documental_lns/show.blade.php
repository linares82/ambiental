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
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('rev_documental_lns.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('rev_documental_lns.rev_documental_ln.destroy', $revDocumentalLn->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
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
                    @ifUserCan('rev_documental_lns.rev_documental_ln.edit')
                    <a href="{{ route('rev_documental_lns.rev_documental_ln.edit', $revDocumentalLn->id ) }}" class="btn btn-primary" title="{{ trans('rev_documental_lns.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_documental_lns.rev_documental_ln.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('rev_documental_lns.delete') }}" onclick="return confirm(&quot;{{ trans('rev_documental_lns.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('rev_documental_lns.rev_documental_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->revDocumental)->anio }}</dd>
            <dt>{{ trans('rev_documental_lns.tpo_documento_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->tpoDoc)->tpo_doc }}</dd>
            <dt>{{ trans('rev_documental_lns.documento_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->rDocumento)->r_documento }}</dd>
            <dt>{{ trans('rev_documental_lns.grupo_norma_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->csGrupoNorma)->grupo_norma }}</dd>
            <dt>{{ trans('rev_documental_lns.norma_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->csNorma)->norma }}</dd>
            <dt>{{ trans('rev_documental_lns.estatus_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->estatusRequisito)->id }}</dd>
            <dt>{{ trans('rev_documental_lns.importancia_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->importancium)->importancia }}</dd>
            <dt>{{ trans('rev_documental_lns.responsable_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('rev_documental_lns.dias_advertencia1') }}</dt>
            <dd>{{ $revDocumentalLn->dias_advertencia1 }}</dd>
            <dt>{{ trans('rev_documental_lns.dias_advertencia2') }}</dt>
            <dd>{{ $revDocumentalLn->dias_advertencia2 }}</dd>
            <dt>{{ trans('rev_documental_lns.dias_advertencia3') }}</dt>
            <dd>{{ $revDocumentalLn->dias_advertencia3 }}</dd>
            <dt>{{ trans('rev_documental_lns.fec_cumplimiento') }}</dt>
            <dd>{{ $revDocumentalLn->fec_cumplimiento }}</dd>
            <dt>{{ trans('rev_documental_lns.fec_vencimiento') }}</dt>
            <dd>{{ $revDocumentalLn->fec_vencimiento }}</dd>
            <dt>{{ trans('rev_documental_lns.archivo') }}</dt>
            <dd>{{ $revDocumentalLn->archivo }}</dd>
            <dt>{{ trans('rev_documental_lns.observaciones') }}</dt>
            <dd>{{ $revDocumentalLn->observaciones }}</dd>
            <dt>{{ trans('rev_documental_lns.usu_alta_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->user)->name }}</dd>
            <dt>{{ trans('rev_documental_lns.usu_mod_id') }}</dt>
            <dd>{{ optional($revDocumentalLn->user)->name }}</dd>
            <dt>{{ trans('rev_documental_lns.created_at') }}</dt>
            <dd>{{ $revDocumentalLn->created_at }}</dd>
            <dt>{{ trans('rev_documental_lns.updated_at') }}</dt>
            <dd>{{ $revDocumentalLn->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection
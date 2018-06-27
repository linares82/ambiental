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
				<a href="{{ route('a_rr_ambientales.a_rr_ambientale.index') }}">{{ trans('a_rr_ambientales.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('a_rr_ambientales.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_rr_ambientales.a_rr_ambientale.destroy', $aRrAmbientale->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_rr_ambientales.a_rr_ambientale.index')
                    <a href="{{ route('a_rr_ambientales.a_rr_ambientale.index') }}" class="btn btn-primary" title="{{ trans('a_rr_ambientales.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_rr_ambientales.a_rr_ambientale.create')
                    <a href="{{ route('a_rr_ambientales.a_rr_ambientale.create') }}" class="btn btn-success" title="{{ trans('a_rr_ambientales.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_rr_ambientales.a_rr_ambientale.edit')
                    <a href="{{ route('a_rr_ambientales.a_rr_ambientale.edit', $aRrAmbientale->id ) }}" class="btn btn-primary" title="{{ trans('a_rr_ambientales.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_rr_ambientales.a_rr_ambientale.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_rr_ambientales.delete') }}" onclick="return confirm(&quot;{{ trans('a_rr_ambientales.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_rr_ambientales.material_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->caMaterial)->material }}</dd>
            <dt>{{ trans('a_rr_ambientales.categoria_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->caCategoria)->categoria }}</dd>
            <dt>{{ trans('a_rr_ambientales.documento_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->caAaDoc)->doc }}</dd>
            <dt>{{ trans('a_rr_ambientales.descripcion') }}</dt>
            <dd>{{ $aRrAmbientale->descripcion }}</dd>
            <dt>{{ trans('a_rr_ambientales.fec_fin_vigencia') }}</dt>
            <dd>{{ $aRrAmbientale->fec_fin_vigencia }}</dd>
            <dt>{{ trans('a_rr_ambientales.archivo') }}</dt>
            <dd>{{ $aRrAmbientale->archivo }}</dd>
            <dt>{{ trans('a_rr_ambientales.aviso') }}</dt>
            <dd>{{ optional($aRrAmbientale->bnd)->bnd }}</dd>
            <dt>{{ trans('a_rr_ambientales.dias_aviso') }}</dt>
            <dd>{{ $aRrAmbientale->dias_aviso }}</dd>
            <dt>{{ trans('a_rr_ambientales.responsable_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->empleado)->ctrl_interno }}</dd>
            <dt>{{ trans('a_rr_ambientales.st_archivo_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->aStArchivo)->estatus }}</dd>
            <dt>{{ trans('a_rr_ambientales.entity_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->entity)->rzon_social }}</dd>
            <dt>{{ trans('a_rr_ambientales.usu_alta_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->user)->name }}</dd>
            <dt>{{ trans('a_rr_ambientales.usu_mod_id') }}</dt>
            <dd>{{ optional($aRrAmbientale->user)->name }}</dd>
            <dt>{{ trans('a_rr_ambientales.created_at') }}</dt>
            <dd>{{ $aRrAmbientale->created_at }}</dd>
            <dt>{{ trans('a_rr_ambientales.updated_at') }}</dt>
            <dd>{{ $aRrAmbientale->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection
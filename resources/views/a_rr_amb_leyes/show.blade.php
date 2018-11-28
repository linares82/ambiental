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
				<a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.index') }}">{{ trans('a_rr_amb_leyes.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('a_rr_amb_leyes.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('a_rr_amb_leyes.a_rr_amb_leye.destroy', $aRrAmbLeye->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.index')
                    <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.index') }}" class="btn btn-primary" title="{{ trans('a_rr_amb_leyes.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.create')
                    <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.create') }}" class="btn btn-success" title="{{ trans('a_rr_amb_leyes.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.edit')
                    <a href="{{ route('a_rr_amb_leyes.a_rr_amb_leye.edit', $aRrAmbLeye->id ) }}" class="btn btn-primary" title="{{ trans('a_rr_amb_leyes.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('a_rr_amb_leyes.a_rr_amb_leye.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('a_rr_amb_leyes.delete') }}" onclick="return confirm(&quot;{{ trans('a_rr_amb_leyes.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('a_rr_amb_leyes.material_id') }}</dt>
            <dd>{{ optional($aRrAmbLeye->caMaterial)->material }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.categoria_id') }}</dt>
            <dd>{{ optional($aRrAmbLeye->caCategoria)->categoria }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.documento_id') }}</dt>
            <dd>{{ optional($aRrAmbLeye->caAaDoc)->doc }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.descripcion') }}</dt>
            <dd>{{ $aRrAmbLeye->descripcion }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.fec_fin_vigencia') }}</dt>
            <dd>{{ $aRrAmbLeye->fec_fin_vigencia }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.aviso') }}</dt>
            <dd>{{ optional($aRrAmbLeye->bnd)->bnd }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.dias_aviso') }}</dt>
            <dd>{{ $aRrAmbLeye->dias_aviso }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.entity_id') }}</dt>
            <dd>{{ optional($aRrAmbLeye->entity)->rzon_social }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.activo') }}</dt>
            <dd>{{ $aRrAmbLeye->activo }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.usu_alta_id') }}</dt>
            <dd>{{ optional($aRrAmbLeye->user)->name }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.usu_mod_id') }}</dt>
            <dd>{{ optional($aRrAmbLeye->user)->name }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.created_at') }}</dt>
            <dd>{{ $aRrAmbLeye->created_at }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.updated_at') }}</dt>
            <dd>{{ $aRrAmbLeye->updated_at }}</dd>
            <dt>{{ trans('a_rr_amb_leyes.deleted_at') }}</dt>
            <dd>{{ $aRrAmbLeye->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection
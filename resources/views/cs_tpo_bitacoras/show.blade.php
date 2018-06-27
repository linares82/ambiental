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
				<a href="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.index') }}">{{ trans('cs_tpo_bitacoras.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_tpo_bitacoras.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_tpo_bitacoras.cs_tpo_bitacora.destroy', $csTpoBitacora->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_tpo_bitacoras.cs_tpo_bitacora.index')
                    <a href="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.index') }}" class="btn btn-primary" title="{{ trans('cs_tpo_bitacoras.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_bitacoras.cs_tpo_bitacora.create')
                    <a href="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.create') }}" class="btn btn-success" title="{{ trans('cs_tpo_bitacoras.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_bitacoras.cs_tpo_bitacora.edit')
                    <a href="{{ route('cs_tpo_bitacoras.cs_tpo_bitacora.edit', $csTpoBitacora->id ) }}" class="btn btn-primary" title="{{ trans('cs_tpo_bitacoras.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_bitacoras.cs_tpo_bitacora.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_tpo_bitacoras.delete') }}" onclick="return confirm(&quot;{{ trans('cs_tpo_bitacoras.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_tpo_bitacoras.tpo_bitacora') }}</dt>
            <dd>{{ $csTpoBitacora->tpo_bitacora }}</dd>
            <dt>{{ trans('cs_tpo_bitacoras.usu_alta_id') }}</dt>
            <dd>{{ optional($csTpoBitacora->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_bitacoras.usu_mod_id') }}</dt>
            <dd>{{ optional($csTpoBitacora->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_bitacoras.created_at') }}</dt>
            <dd>{{ $csTpoBitacora->created_at }}</dd>
            <dt>{{ trans('cs_tpo_bitacoras.updated_at') }}</dt>
            <dd>{{ $csTpoBitacora->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection
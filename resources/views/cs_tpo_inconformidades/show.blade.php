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
				<a href="{{ route('cs_tpo_inconformidades.cs_tpo_inconformidade.index') }}">{{ trans('cs_tpo_inconformidades.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('cs_tpo_inconformidades.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('cs_tpo_inconformidades.cs_tpo_inconformidade.destroy', $csTpoInconformidade->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('cs_tpo_inconformidades.cs_tpo_inconformidade.index')
                    <a href="{{ route('cs_tpo_inconformidades.cs_tpo_inconformidade.index') }}" class="btn btn-primary" title="{{ trans('cs_tpo_inconformidades.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_inconformidades.cs_tpo_inconformidade.create')
                    <a href="{{ route('cs_tpo_inconformidades.cs_tpo_inconformidade.create') }}" class="btn btn-success" title="{{ trans('cs_tpo_inconformidades.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_inconformidades.cs_tpo_inconformidade.edit')
                    <a href="{{ route('cs_tpo_inconformidades.cs_tpo_inconformidade.edit', $csTpoInconformidade->id ) }}" class="btn btn-primary" title="{{ trans('cs_tpo_inconformidades.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('cs_tpo_inconformidades.cs_tpo_inconformidade.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('cs_tpo_inconformidades.delete') }}" onclick="return confirm(&quot;{{ trans('cs_tpo_inconformidades.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('cs_tpo_inconformidades.tpo_bitacora_id') }}</dt>
            <dd>{{ optional($csTpoInconformidade->csTpoBitacora)->tpo_bitacora }}</dd>
            <dt>{{ trans('cs_tpo_inconformidades.tpo_inconformidad') }}</dt>
            <dd>{{ $csTpoInconformidade->tpo_inconformidad }}</dd>
            <dt>{{ trans('cs_tpo_inconformidades.usu_alta_id') }}</dt>
            <dd>{{ optional($csTpoInconformidade->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_inconformidades.usu_mod_id') }}</dt>
            <dd>{{ optional($csTpoInconformidade->user)->name }}</dd>
            <dt>{{ trans('cs_tpo_inconformidades.created_at') }}</dt>
            <dd>{{ $csTpoInconformidade->created_at }}</dd>
            <dt>{{ trans('cs_tpo_inconformidades.updated_at') }}</dt>
            <dd>{{ $csTpoInconformidade->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection
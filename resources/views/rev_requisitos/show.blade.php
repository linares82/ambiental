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
				<a href="{{ route('rev_requisitos.rev_requisito.index') }}">{{ trans('rev_requisitos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('rev_requisitos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('rev_requisitos.rev_requisito.destroy', $revRequisito->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('rev_requisitos.rev_requisito.index')
                    <a href="{{ route('rev_requisitos.rev_requisito.index') }}" class="btn btn-primary" title="{{ trans('rev_requisitos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_requisitos.rev_requisito.create')
                    <a href="{{ route('rev_requisitos.rev_requisito.create') }}" class="btn btn-success" title="{{ trans('rev_requisitos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_requisitos.rev_requisito.edit')
                    <a href="{{ route('rev_requisitos.rev_requisito.edit', $revRequisito->id ) }}" class="btn btn-primary" title="{{ trans('rev_requisitos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_requisitos.rev_requisito.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('rev_requisitos.delete') }}" onclick="return confirm(&quot;{{ trans('rev_requisitos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('rev_requisitos.cia_id') }}</dt>
            <dd>{{ optional($revRequisito->entity)->rzon_social }}</dd>
            <dt>{{ trans('rev_requisitos.anio') }}</dt>
            <dd>{{ $revRequisito->anio }}</dd>
            <dt>{{ trans('rev_requisitos.mes_id') }}</dt>
            <dd>{{ optional($revRequisito->mese)->id }}</dd>
            <dt>{{ trans('rev_requisitos.usu_alta_id') }}</dt>
            <dd>{{ optional($revRequisito->user)->name }}</dd>
            <dt>{{ trans('rev_requisitos.usu_mod_id') }}</dt>
            <dd>{{ optional($revRequisito->user)->name }}</dd>
            <dt>{{ trans('rev_requisitos.created_at') }}</dt>
            <dd>{{ $revRequisito->created_at }}</dd>
            <dt>{{ trans('rev_requisitos.updated_at') }}</dt>
            <dd>{{ $revRequisito->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection
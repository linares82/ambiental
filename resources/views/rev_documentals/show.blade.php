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
				<a href="{{ route('rev_documentals.rev_documental.index') }}">{{ trans('rev_documentals.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('rev_documentals.model_plural')  }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('rev_documentals.rev_documental.destroy', $revDocumental->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('rev_documentals.rev_documental.index')
                    <a href="{{ route('rev_documentals.rev_documental.index') }}" class="btn btn-primary" title="{{ trans('rev_documentals.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_documentals.rev_documental.create')
                    <a href="{{ route('rev_documentals.rev_documental.create') }}" class="btn btn-success" title="{{ trans('rev_documentals.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_documentals.rev_documental.edit')
                    <a href="{{ route('rev_documentals.rev_documental.edit', $revDocumental->id ) }}" class="btn btn-primary" title="{{ trans('rev_documentals.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('rev_documentals.rev_documental.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('rev_documentals.delete') }}" onclick="return confirm(&quot;{{ trans('rev_documentals.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('rev_documentals.entity_id') }}</dt>
            <dd>{{ optional($revDocumental->entity)->rzon_social }}</dd>
            <dt>{{ trans('rev_documentals.anio') }}</dt>
            <dd>{{ $revDocumental->anio }}</dd>
            <dt>{{ trans('rev_documentals.mes_id') }}</dt>
            <dd>{{ optional($revDocumental->mese)->mes }}</dd>
            <dt>{{ trans('rev_documentals.usu_alta_id') }}</dt>
            <dd>{{ optional($revDocumental->user)->name }}</dd>
            <dt>{{ trans('rev_documentals.usu_mod_id') }}</dt>
            <dd>{{ optional($revDocumental->user)->name }}</dd>
            <dt>{{ trans('rev_documentals.created_at') }}</dt>
            <dd>{{ $revDocumental->created_at }}</dd>
            <dt>{{ trans('rev_documentals.updated_at') }}</dt>
            <dd>{{ $revDocumental->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection
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
				<a href="{{ route('normas.norma.index') }}">{{ trans('normas.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Norma' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('normas.norma.destroy', $norma->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('normas.norma.index')
                    <a href="{{ route('normas.norma.index') }}" class="btn btn-primary" title="{{ trans('normas.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('normas.norma.create')
                    <a href="{{ route('normas.norma.create') }}" class="btn btn-success" title="{{ trans('normas.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('normas.norma.edit')
                    <a href="{{ route('normas.norma.edit', $norma->id ) }}" class="btn btn-primary" title="{{ trans('normas.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('normas.norma.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('normas.delete') }}" onclick="return confirm(&quot;{{ trans('normas.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('normas.norma') }}</dt>
            <dd>{{ $norma->norma }}</dd>
            <dt>{{ trans('normas.usu_alta_id') }}</dt>
            <dd>{{ optional($norma->user)->name }}</dd>
            <dt>{{ trans('normas.usu_mod_id') }}</dt>
            <dd>{{ optional($norma->user)->name }}</dd>
            <dt>{{ trans('normas.created_at') }}</dt>
            <dd>{{ $norma->created_at }}</dd>
            <dt>{{ trans('normas.updated_at') }}</dt>
            <dd>{{ $norma->updated_at }}</dd>
            
        </dl>

    </div>
</div>

@endsection
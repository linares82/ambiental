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
				<a href="{{ route('especificos.especifico.index') }}">{{ trans('especificos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Especifico' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('especificos.especifico.destroy', $especifico->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('especificos.especifico.index')
                    <a href="{{ route('especificos.especifico.index') }}" class="btn btn-primary" title="{{ trans('especificos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('especificos.especifico.create')
                    <a href="{{ route('especificos.especifico.create') }}" class="btn btn-success" title="{{ trans('especificos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('especificos.especifico.edit')
                    <a href="{{ route('especificos.especifico.edit', $especifico->id ) }}" class="btn btn-primary" title="{{ trans('especificos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('especificos.especifico.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('especificos.delete') }}" onclick="return confirm(&quot;{{ trans('especificos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('especificos.especifico') }}</dt>
            <dd>{{ $especifico->especifico }}</dd>
            <dt>{{ trans('especificos.usu_alta_id') }}</dt>
            <dd>{{ optional($especifico->user)->name }}</dd>
            <dt>{{ trans('especificos.usu_mod_id') }}</dt>
            <dd>{{ optional($especifico->user)->name }}</dd>
            <dt>{{ trans('especificos.created_at') }}</dt>
            <dd>{{ $especifico->created_at }}</dd>
            <dt>{{ trans('especificos.updated_at') }}</dt>
            <dd>{{ $especifico->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
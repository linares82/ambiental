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
				<a href="{{ route('imp_reals.imp_real.index') }}">{{ trans('imp_reals.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : '{{ trans('imp_reals.model_plural') }}' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('imp_reals.imp_real.destroy', $impReal->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('imp_reals.imp_real.index')
                    <a href="{{ route('imp_reals.imp_real.index') }}" class="btn btn-primary" title="{{ trans('imp_reals.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('imp_reals.imp_real.create')
                    <a href="{{ route('imp_reals.imp_real.create') }}" class="btn btn-success" title="{{ trans('imp_reals.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('imp_reals.imp_real.edit')
                    <a href="{{ route('imp_reals.imp_real.edit', $impReal->id ) }}" class="btn btn-primary" title="{{ trans('imp_reals.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('imp_reals.imp_real.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('imp_reals.delete') }}" onclick="return confirm(&quot;{{ trans('imp_reals.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('imp_reals.imp_real') }}</dt>
            <dd>{{ $impReal->imp_real }}</dd>
            <dt>{{ trans('imp_reals.descripcion') }}</dt>
            <dd>{{ $impReal->descripcion }}</dd>
            <dt>{{ trans('imp_reals.usu_alta_id') }}</dt>
            <dd>{{ optional($impReal->user)->name }}</dd>
            <dt>{{ trans('imp_reals.usu_mod_id') }}</dt>
            <dd>{{ optional($impReal->user)->name }}</dd>
            <dt>{{ trans('imp_reals.created_at') }}</dt>
            <dd>{{ $impReal->created_at }}</dd>
            <dt>{{ trans('imp_reals.updated_at') }}</dt>
            <dd>{{ $impReal->updated_at }}</dd>
            <dt>{{ trans('imp_reals.deleted_at') }}</dt>
            <dd>{{ $impReal->deleted_at }}</dd>

        </dl>

    </div>
</div>

@endsection
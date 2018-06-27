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
				<a href="{{ route('efectos.efecto.index') }}">{{ trans('efectos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Efecto' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('efectos.efecto.destroy', $efecto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('efectos.efecto.index')
                    <a href="{{ route('efectos.efecto.index') }}" class="btn btn-primary" title="{{ trans('efectos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('efectos.efecto.create')
                    <a href="{{ route('efectos.efecto.create') }}" class="btn btn-success" title="{{ trans('efectos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('efectos.efecto.edit')
                    <a href="{{ route('efectos.efecto.edit', $efecto->id ) }}" class="btn btn-primary" title="{{ trans('efectos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('efectos.efecto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('efectos.delete') }}" onclick="return confirm(&quot;{{ trans('efectos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('efectos.efecto') }}</dt>
            <dd>{{ $efecto->efecto }}</dd>
            <dt>{{ trans('efectos.descripcion') }}</dt>
            <dd>{{ $efecto->descripcion }}</dd>
            <dt>{{ trans('efectos.usu_alta_id') }}</dt>
            <dd>{{ optional($efecto->user)->name }}</dd>
            <dt>{{ trans('efectos.usu_mod_id') }}</dt>
            <dd>{{ optional($efecto->user)->name }}</dd>
            <dt>{{ trans('efectos.created_at') }}</dt>
            <dd>{{ $efecto->created_at }}</dd>
            <dt>{{ trans('efectos.updated_at') }}</dt>
            <dd>{{ $efecto->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection
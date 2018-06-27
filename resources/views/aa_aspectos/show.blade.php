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
				<a href="{{ route('aa_aspectos.aa_aspecto.index') }}">{{ trans('aa_aspectos.model_plural') }}</a>
			</li>
			<li class="active">Mostrar</li>
		</ul><!-- /.breadcrumb -->
	</div>
<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : trans('aa_aspectos.model_plural') }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('aa_aspectos.aa_aspecto.destroy', $aaAspecto->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @ifUserCan('aa_aspectos.aa_aspecto.index')
                    <a href="{{ route('aa_aspectos.aa_aspecto.index') }}" class="btn btn-primary" title="{{ trans('aa_aspectos.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_aspectos.aa_aspecto.create')
                    <a href="{{ route('aa_aspectos.aa_aspecto.create') }}" class="btn btn-success" title="{{ trans('aa_aspectos.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_aspectos.aa_aspecto.edit')
                    <a href="{{ route('aa_aspectos.aa_aspecto.edit', $aaAspecto->id ) }}" class="btn btn-primary" title="{{ trans('aa_aspectos.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endif
                    @ifUserCan('aa_aspectos.aa_aspecto.destroy')
                    <button type="submit" class="btn btn-danger" title="{{ trans('aa_aspectos.delete') }}" onclick="return confirm(&quot;{{ trans('aa_aspectos.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                    @endif
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('aa_aspectos.aspectos') }}</dt>
            <dd>{{ $aaAspecto->aspectos }}</dd>
            <dt>{{ trans('aa_aspectos.detalle') }}</dt>
            <dd>{{ $aaAspecto->detalle }}</dd>
            <dt>{{ trans('aa_aspectos.usu_alta_id') }}</dt>
            <dd>{{ optional($aaAspecto->user)->name }}</dd>
            <dt>{{ trans('aa_aspectos.usu_mod_id') }}</dt>
            <dd>{{ optional($aaAspecto->user)->name }}</dd>
            <dt>{{ trans('aa_aspectos.created_at') }}</dt>
            <dd>{{ $aaAspecto->created_at }}</dd>
            <dt>{{ trans('aa_aspectos.updated_at') }}</dt>
            <dd>{{ $aaAspecto->updated_at }}</dd>
           
        </dl>

    </div>
</div>

@endsection
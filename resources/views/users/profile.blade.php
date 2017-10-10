@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes')

@section('content_header')
    <h1>Perfil de usuário <small>{{ Auth::user()->name }}</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Perfil de usuário</a>
        </li>
    </ol>
@stop

@section('content')

    @if ( session('msg') !== null )
        @if ( session('status') === 'success')
            <div class="alert alert-success alert-dismissible">
                <button  class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                {{ session('msg') }}
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <button  class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                {{ session('msg') }}
            </div>
        @endif
    @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box box-solid">
                <div class="box-body">
                    <form action="{{ route( 'user.profile.store' ) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="user-name">Nome</label>
                                    <input id="user-name" type="text" name="name" class="form-control" value="{{ $user->name }}"
                                           placeholder="{{ trans('adminlte::adminlte.full_name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="user-email">Email</label>
                                    <input id="user-email" type="email" name="email" class="form-control" value="{{ $user->email }}"
                                           placeholder="{{ trans('adminlte::adminlte.email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="report-file">Avatar</label>
                                    <input type="file" class="form-control" id="user-avatar" name="file" placeholder="arquivo" required>
                                    <p class="help-block">
                                        Tamanho máximo 4mb<br/>
                                    </p>
                                </div>

                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="user-password">Senha</label>
                                    <input id="user-password" type="password" name="password" class="form-control"
                                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label for="user-password_confirmation">Confirme a senha</label>
                                    <input id="user-password_confirmation" type="password" name="password_confirmation" class="form-control"
                                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="text-left">
                            <button type="button" class="btn btn-danger btn-flat" onclick="window.location.href='/'"><i class="fa fa-fw fa-arrow-circle-left"></i>Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">Editar perfil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

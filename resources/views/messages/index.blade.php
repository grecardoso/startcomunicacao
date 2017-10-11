@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes - Mensagens')

@section('content_header')
    <h1>Listas de mensagens <small>Listagem geral</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Listas de mensages</a>
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
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Mensagens no sistema</h3>
                </div>
                <div class="box-body">              
                    <button  class="btn btn-primary" data-toggle="modal" data-target="#message-add-form-modal" style="margin-bottom: 12px;">
                        <i class="fa fa-fw fa-plus"></i> Cadastrar mensagem
                    </button>
                    <table id="messages-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Status</td>
                                <td>Titulo</td>
                                <td>De:</td>
                                <td>Para:</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $messages as $message )
                                <tr>
                                    <td>
                                        @if( $message->status )
                                            <a role="button" class="btn btn-sm btn-success">
                                            <i class="fa fa-fw fa-envelope"></i> novo</a>
                                        @endif
                                    </td>
                                    <td>{{ $message->title }}</td>
                                    <td>{{ $message->from()->name }}</td>
                                    <td>{{ $message->to()->name }}</td>
                                    <td class="text-right">
                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                            <button type"button" class="btn btn-warning" 
                                            data-toggle="collapse" data-target="#message-{{ $message->id }}" 
                                            aria-expanded="false" aria-controls="message-{{ $message->id }}">
                                                <i class="fa fa-fw fa-plus"></i>exibir
                                            </button>
                                        </div>
            
                                        <button type"button" class="btn btn-xs btn-danger" onclick="deleteMessage({{ $message->id }})">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Mensagens Globais</h3>
                </div>
                <div class="box-body">
                    <button  class="btn btn-warning" data-toggle="modal" data-target="#global-message-add-form-modal" style="margin-bottom: 12px;">
                        <i class="fa fa-fw fa-globe"></i> Mensagem Global
                    </button>
                    <table id="global-messages-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td>Titulo</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach( $global as $message )
                                <tr>
                                    <td>{{ $message->title }}</td>

                                    <td class="text-right">
                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                            <button type"button" class="btn btn-warning"
                                            data-toggle="collapse" data-target="#message-{{ $message->id }}"
                                            aria-expanded="false" aria-controls="#message-{{ $message->id }}">
                                            <i class="fa fa-fw fa-plus"></i>exibir
                                            </button>
                                        </div>

                                        <button type"button" class="btn btn-xs btn-danger" onclick="deleteGlobalMessage({{ $message->id }})">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <form id="delete-message-form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    @include('messages.includes.add_form')
    @include('messages.includes.add_global_form')

@stop

@section('js')
<script src="//cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>
<script>
  $(function () {
    $('#messages-table').DataTable({
      'language': {
        'url': '//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json'
      },

      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

      $('#global-messages-table').DataTable({
          'language': {
              'url': '//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json'
          },

          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
      })
  })

  // Replace the <textarea id="editor1"> with a CKEditor
  // instance, using default configuration.
  CKEDITOR.replace( 'message-content' );
  CKEDITOR.replace( 'global-message-content' );
</script>
<script src="{{ asset('js/app.js') }}"></script>
@stop
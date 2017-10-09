@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes -Pagina incial')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count( $campaigns ) }}</h3>

                    <p>Abertas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-information-circled"></i>
                </div>
                <a href="/campaigns/list?filter%5BW%5D=on" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $campaigns_started }}</h3>

                    <p>Iniciadas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-checkmark-circled"></i>
                </div>
                <a href="/campaigns/list?filter%5BS%5D=on" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $campaigns_denied }}</h3>

                    <p>Negadas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-close-circled"></i>
                </div>
                <a href="/campaigns/list?filter%5BD%5D=on" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->
        @if( Auth::user()->category === 'ADMIN')
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count( $customers )  }}</h3>

                    <p>Novos Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.col -->
        @endif
    </div><!-- Info boxes -->
    <!-- /.row -->

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Ultimas Campanhas Criadas</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        @if( count($campaigns) )
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Cliente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campaigns as $campaign)
                                    <tr>
                                        <td>
                                            @if( (Auth::user()->category === 'ADMIN') )
                                                @if( $campaign->status === 'W')
                                                    <button type="button" class="btn btn-xs btn-danger" onclick="denieCampaign({{ $campaign->id }})">
                                                    <i class="fa fa-fw fa-ban"></i> negar
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-success" onclick="approveCampaign({{ $campaign->id }})">
                                                    <i class="fa fa-fw fa-check"></i> aprovar
                                                    </button>
                                                @elseif( $campaign->status === 'S' )
                                                    <button type="button" class="btn btn-xs btn-info" onclick="completeCampaign({{ $campaign->id }})">
                                                    <i class="fa fa-fw fa-check-square-o"></i> completar
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if( $campaign->status !== 'D')
                                                @if( $campaign->status == 'W')
                                                    AGUARDANDO APROVAÇÃO
                                                @elseif( $campaign->status == 'S')
                                                    INICIADO
                                                @else
                                                    COMPLETADO
                                                @endif
                                            @else
                                                NEGADO
                                            @endif
                                        </td>
                                        <td>{{ $campaign->name }}</td>
                                        <td>
                                            @if( $campaign->type == 'TXT')
                                                TEXTO
                                            @elseif( $campaign->type == 'ITXT' )
                                                IMAGEM + TEXTO
                                            @elseif( $campaign->type == 'VTXT' )
                                                VÍDEO + TEXTO
                                            @elseif( $campaign->type == 'PDF')
                                                PDF
                                            @elseif( $campaign->type == 'AUDIO')
                                                AUDIO
                                            @endif
                                        </td>
                                        <td> {{ (\DateTime::createFromFormat('Y-m-d', $campaign->date))->format('m-d-Y') }}</td>
                                        <td>{{ $campaign->user->name }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="text-center bg-warning">
                                <i>SEM CAMPANHAS ABERTAS ATÉ O MOMENTO</i>
                            </div>
                        @endif
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('campaigns.list') }}" class="btn btn-sm btn-default btn-flat pull-right">Exibir todas as campanhas</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop
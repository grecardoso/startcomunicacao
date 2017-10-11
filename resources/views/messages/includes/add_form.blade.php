<!-- Modal -->
<div class="modal fade" id="message-add-form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Criar mensagens de alerta</h4>
            </div>

            <div class="modal-body">
                <form id="message-add-form" action="{{ route('messages.store') }}" method="POST" >
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ Auth::user()->id}}" name="from">

                    <div class="form-group">
                        <label for="message-customers">Cliente</label>
                        <div class="input-group">
                            <select class="form-control" id="message-customers" name="to" required>
                                <option>SELECIONE UM CLIENTE</option>
                                @foreach( $customers as $list )
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message-title">Título</label>
                        <input id="message-title" class="form-control" name="title" placeholder="Título" required>
                    </div>

                    <div class="form-group">
                        <label for="message-content">Mensagem</label>
                        <textarea id="message-content" class="form-control" name="content" required></textarea>
                    </div>    

                    <hr />

                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"
                            onclick="$('#message-add-form').each(function(){this.reset();});">
                            <i class="fa fa-fw fa-arrow-circle-left"></i>Voltar
                        </button>

                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">
                            Criar mensagem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
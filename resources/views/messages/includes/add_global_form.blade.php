<!-- Modal -->
<div class="modal fade" id="global-message-add-form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensagem Global</h4>
            </div>

            <div class="modal-body">
                <form id="global-message-add-form" action="{{ route('global-messages.store') }}" method="POST" >
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ Auth::user()->id}}" name="from">

                    <div class="form-group">
                        <label for="global-message-title">Título</label>
                        <input id="global-message-title" class="form-control" name="title" placeholder="Título" required>
                    </div>

                    <div class="form-group">
                        <label for="global-message-content">Mensagem</label>
                        <textarea id="global-message-content" class="form-control" name="content" required></textarea>
                    </div>    

                    <hr />

                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"
                            onclick="$('#global-message-add-form').each(function(){this.reset();});">
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
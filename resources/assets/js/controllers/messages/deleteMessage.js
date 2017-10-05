function deleteMessage( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-message-form').attr('action', '/messages/'+id);
        $('#delete-message-form').submit();
    }
}
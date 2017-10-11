function deleteGlobalMessage( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-message-form').attr('action', '/global-messages/'+id);
        $('#delete-message-form').submit();
    }
}
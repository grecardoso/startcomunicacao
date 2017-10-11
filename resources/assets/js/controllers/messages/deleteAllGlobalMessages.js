function deleteAllGlobalMessages() {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-message-form').attr('action', '/global-messages');
        $('#delete-message-form').attr('method', 'POST');
        $('#delete-message-form').submit();
    }
}
function deleteAllGlobalMessages() {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-message-form').attr('action', '/global-messages');
        $('#delete-message-form').submit();
    }
    console.log();
}
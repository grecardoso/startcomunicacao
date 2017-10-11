$.getJSON('/api/messages', function ( response ) {
    var html_header = '';

    if ( response.length ) {
        html_header +=  (response.length > 1) ? 'Você tem ' + response.length + ' mensagens' : 'Você tem ' + response.length + ' mensagem';
        $('#msg-counter').html( response.length );

        // listando msgs
        var list = "<ul class='menu'>";
        for(cont = 0; cont < response.length; cont++) {
            list += '<li>' +'<a href="#"><div class="pull-left"><i class="fa fa-fw fa-envelope"></i></div><h4>'+ response[cont].title +'</h4></a>'+'</li>';
        }
        list += '</ul>';

        $('#msg-list').html(list);
    } else {
        html_header += 'Sem mensagens no momento';
    }

    $('#msg-header').html(html_header);

    console.log( response );
    console.log( response.length );
});
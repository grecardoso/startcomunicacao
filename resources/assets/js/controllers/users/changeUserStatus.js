function changeUserStatus( status, user_id ) {
    var form = document.querySelector('#changeStatus-users-form');

    if ( status ) {
        form.action = '/users/'+user_id+'/approve';
    } else {
        form.action = '/users/'+user_id+'/denie';
    }

    form.submit();

}
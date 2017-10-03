function deleteAllDates() {
    if (confirm('Você tem certeza dessa ação?')) {
        $('#delete-blacklist-form').attr('action', '/blacklist/remove-all-dates');
        $('#delete-blacklist-form').submit();
    }
}
function deleteDate(id) {
    if (confirm('Você tem certeza dessa ação?')) {
        $('#delete-blacklist-form').attr('action', '/blacklist/' + id);
        $('#delete-blacklist-form').submit();
    }
}
function approveCampaign(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url = "/api/campaigns/" + id + "/approve";

    $.post(url, function (response) {
        console.log(response.msg);
        location.reload();
    });
}
function completeCampaign(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url = "/api/campaigns/" + id + "/complete";

    $.post(url, function (response) {
        console.log(response.msg);
        location.reload();
    });
}
function deleteCampaign(id) {
    if (confirm('Você tem certeza dessa ação?')) {
        $('#delete-campaign-form').attr('action', '/campaigns/' + id);
        $('#delete-campaign-form').submit();
    }
}
function approveCampaign(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url = "/api/campaigns/" + id + "/denie";

    $.post(url, function (response) {
        console.log(response.msg);
        location.reload();
    });
}
$('#campaign-add-form #campaign-type').change(function (event) {
    var html;

    if (this.value == 'TXT') {
        html = "";
        html += "<div class='form-group'>";
        html += "<label for='campaign-text'>Mensagem</label>";
        html += "<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>";
        html += "</div>";
    }

    if (this.value == 'ITXT') {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign-file-name'>Nome da Imagem</label>";
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>";
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>Imagem</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";

        // texto
        html += "<div class='form-group'>";
        html += "<label for='campaign-text'>Mensagem</label>";
        html += "<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>";
        html += "</div>";
    }

    if (this.value == 'VTXT') {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign-file-name'>Nome do Vídeo</label>";
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>";
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>Video</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";

        // Texto
        html += "<div class='form-group'>";
        html += "<label for='campaign-text'>Mensagem</label>";
        html += "<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>";
        html += "</div>";
    }

    if (this.value == 'PDF') {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign-file-name'>Nome do PDF</label>";
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>";
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>PDF</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";
    }

    if (this.value == 'AUDIO') {
        html = "";
        // Nome do arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign-file-name'>Nome do Audio</label>";
        html += "<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>";
        html += "</div>";

        // Arquivo
        html += "<div class='form-group'>";
        html += "<label for='campaign'>AUDIO</label>";
        html += "<input type='file' id='campaign-file' name='file' required>";
        html += "<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>";
        html += "</div>";
    }

    $('#campaign-add-form #type-content').html(html);
});

$('#campaign-add-form #campaign-lauching-date').change(function (event) {
    var self = this;
    $.getJSON('/api/blacklist', function (response) {
        if ($.inArray(self.value, response) != -1) {
            alert('Data bloqueada pela administração');
            self.value = "";
        }
    });
});
function deleteNumberList(id) {
    if (confirm('Você tem certeza dessa ação?')) {
        $('#delete-number-lists-form').attr('action', '/campaigns/number-lists/' + id);
        $('#delete-number-lists-form').submit();
    }
}
function deleteReport(id) {
    if (confirm('Você tem certeza dessa ação?')) {
        $('#delete-report-form').attr('action', '/reports/' + id);
        $('#delete-report-form').submit();
    }
}
$('#reports-add-form #report-campaign-user').change(function (event) {
    var user_id = $('#reports-add-form #report-campaign-user').val();

    console.log(user_id);

    $.getJSON('/api/users/' + user_id + '/campaigns', function (response) {
        var select = document.querySelector('#reports-add-form #report-campaign');

        response.forEach(function (element) {
            var option = document.createElement('option');
            option.value = element.id;
            option.text = element.name;
            select.appendChild(option);
        }, this);

        console.log(response);
        console.log(response.length);
    });
});
function deleteUser(id) {
    if (confirm('Você tem certeza dessa ação?')) {
        $('#delete-users-form').attr('action', '/users/' + id);
        $('#delete-users-form').submit();
    }
}
function editUser(id) {
    $.getJSON('/api/users/' + id, function (response) {
        $('#users-form-modal .modal-title').html('Editando usuário <b><i>' + response.name + '</i></b>');

        var body = document.querySelector('#users-form-modal .modal-body');

        var form = document.createElement('form');
        form.id = "edit-form";
        form.method = "POST";
        form.action = "/users/" + id;

        var input_csrf = document.createElement('input');
        input_csrf.type = "hidden";
        input_csrf.name = "_token";
        input_csrf.value = $('meta[name="csrf-token"]').attr('content');

        var input_put = document.createElement('input');
        input_put.type = "hidden";
        input_put.name = "_method";
        input_put.value = "PUT";

        var div_status = document.createElement('div');
        div_status.className = "form-group has-feedback";

        var status = document.createElement('select');
        status.className = "form-control";
        status.name = "status";

        var option_w = document.createElement('option');
        option_w.setAttribute('value', 'W');
        if (response.status === 'W') option_w.setAttribute('selected', true);
        option_w.text = 'Aguardando aprovação';

        var option_a = document.createElement('option');
        option_a.setAttribute('value', 'A');
        if (response.status === 'A') option_a.setAttribute('selected', true);
        option_a.text = 'Aprovado';

        var option_d = document.createElement('option');
        option_d.setAttribute('value', 'D');
        if (response.status === 'D') option_d.setAttribute('selected', true);
        option_d.text = 'Negado';

        status.appendChild(option_w);
        status.appendChild(option_a);
        status.appendChild(option_d);

        div_status.appendChild(status);

        var div_category = document.createElement('div');
        div_category.className = "form-group has-feedback";

        var category = document.createElement('select');
        category.className = "form-control";
        category.name = "category";

        var option_admin = document.createElement('option');
        option_admin.setAttribute('value', 'ADMIN');
        if (response.category == 'ADMIN') option_admin.setAttribute('selected', true);
        option_admin.text = 'Administrador';

        var option_customer = document.createElement('option');
        option_customer.setAttribute('value', 'CUSTOMER');
        if (response.category == 'CUSTOMER') option_customer.setAttribute('selected', true);
        option_customer.text = 'Cliente';

        category.appendChild(option_admin);
        category.appendChild(option_customer);

        div_category.appendChild(category);

        var div_name = document.createElement('div');
        div_name.className = "form-group has-feedback";

        var name = document.createElement('input');
        name.className = "form-control";
        name.setAttribute('name', 'name');
        name.setAttribute('value', response.name);

        var span_name = document.createElement('span');
        span_name.className = "glyphicon glyphicon-user form-control-feedback";

        div_name.appendChild(name);
        div_name.appendChild(span_name);

        var div_email = document.createElement('div');
        div_email.className = "form-group has-feedback";

        var email = document.createElement('input');
        email.className = "form-control";
        email.setAttribute('name', 'email');
        email.setAttribute('type', 'email');
        email.setAttribute('value', response.email);

        var span_email = document.createElement('span');
        span_email.className = "glyphicon glyphicon-envelope form-control-feedback";

        div_email.appendChild(email);
        div_email.appendChild(span_email);

        var div_password = document.createElement('div');
        div_password.className = "form-group has-feedback";

        var password = document.createElement('input');
        password.className = "form-control";
        password.setAttribute('name', 'password');
        password.setAttribute('type', 'password');
        password.setAttribute('placeholder', 'Senha');

        var span_password = document.createElement('span');
        span_password.className = "glyphicon glyphicon-lock form-control-feedback";

        div_password.appendChild(password);
        div_password.appendChild(span_password);

        var div_password_confirmation = document.createElement('div');
        div_password_confirmation.className = "form-group has-feedback";

        var password_confirmation = document.createElement('input');
        password_confirmation.className = "form-control";
        password_confirmation.setAttribute('name', 'password_confirmation');
        password_confirmation.setAttribute('type', 'password');
        password_confirmation.setAttribute('placeholder', 'Repita a senha');

        var span_password_confirmation = document.createElement('span');
        span_password_confirmation.className = "glyphicon glyphicon-log-in form-control-feedback";

        div_password_confirmation.appendChild(password_confirmation);
        div_password_confirmation.appendChild(span_password_confirmation);

        /*var button_submit = document.createElement('button');
        button_submit.setAttribute('type', 'submit');
        button_submit.className = "btn btn-warning";
        button_submit.textContent = "Atualizar usuário";*/

        form.appendChild(input_csrf);
        form.appendChild(input_put);
        form.appendChild(div_status);
        form.appendChild(div_category);
        form.appendChild(div_name);
        form.appendChild(div_email);
        form.appendChild(div_password);
        form.appendChild(div_password_confirmation);
        //form.appendChild( button_submit );

        body.appendChild(form);

        var old = $('#edit-form').html();
        old += "<div class='text-right'><button type='button' class='btn btn-danger btn-flat' data-dismiss='modal'><i class='fa fa-fw fa-arrow-circle-left'></i>Cancelar</button>";
        old += "<button type='submit' class='btn btn-warning btn-flat' style='margin-left: 6px;'>Editar usuário</button></div>";
        $('#edit-form').html(old);

        console.log(body);

        $('#users-form-modal .modal-footer').html(' ');
        $('#users-form-modal').modal('show');
        console.log(response);
    });

    // Limpeza ao final
    $('#users-form-modal .modal-title').html(' ');
    $('#users-form-modal .modal-body').html(' ');
    $('#users-form-modal .modal-footer').html(' ');
}

function editUserCredits(user_id, id, total) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.getJSON('/api/users/' + user_id, function (response) {
        $('#users-form-modal .modal-title').html('Editando créditos <b><i>' + response.name + '</i></b>');
        $('#users-form-modal.modal .modal-dialog').addClass('modal-sm');

        var body = document.querySelector('#users-form-modal .modal-body');

        var div = document.createElement('div');
        div.className = "form-group";

        var label = document.createElement('label');
        label.setAttribute('for', 'total');
        label.textContent = "Total";

        var input = document.createElement('input');
        input.className = "form-control";
        input.type = "number";
        input.name = "total";
        input.id = "total";

        div.appendChild(label);
        div.appendChild(input);
        body.appendChild(div);

        $('input[name=total]').attr('value', total);

        var old = $('#users-form-modal .modal-body').html();
        old += "<div class='text-right'><button type='button' class='btn btn-danger btn-flat' data-dismiss='modal'><i class='fa fa-fw fa-arrow-circle-left'></i>Cancelar</button>";
        old += "<button id='edit-credit' type='button' class='btn btn-warning btn-flat' style='margin-left: 6px;'>Editar creditos</button></div>";
        $('#users-form-modal .modal-body').html(old);

        $('#edit-credit').click(function (event) {
            var url = '/api/users/credits/' + id;

            console.log(id);
            console.log(url);
            console.log('Editando valores');
            console.log($('input[name=total]').val());

            $.post(url, { user_id: user_id, id: id, total: $('input[name=total]').val() }, function (response) {
                console.log(response);
                location.reload();
            }).fail(function (error) {
                console.log(error);
            });
        });

        console.log(body);

        $('#users-form-modal .modal-footer').html(' ');
        $('#users-form-modal').modal('show');
        console.log(response);
    });

    // Limpeza ao final
    $('#users-form-modal .modal-title').html(' ');
    $('#users-form-modal .modal-body').html(' ');
    $('#users-form-modal .modal-footer').html(' ');
}

function enableUserCredits(id) {
    var url = '/api/users/credits';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(url, { user_id: id, total: 15 }, function (response) {
        console.log(response);
        location.reload();
    });
}
function showUser(id) {
    $.getJSON('/api/users/' + id, function (response) {
        $('#users-form-modal .modal-title').html('Exibindo usuário <b><i>' + response.name + '</i></b>');

        $('#users-form-modal').modal('show');
        console.log(response);
    });

    // Limpeza ao final
    $('#users-form-modal .modal-title').html(' ');
    $('#users-form-modal .modal-body').html(' ');
}
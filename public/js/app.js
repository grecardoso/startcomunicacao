function deleteAllDates(){confirm("Você tem certeza dessa ação?")&&($("#delete-blacklist-form").attr("action","/blacklist/remove-all-dates"),$("#delete-blacklist-form").submit())}function deleteDate(e){confirm("Você tem certeza dessa ação?")&&($("#delete-blacklist-form").attr("action","/blacklist/"+e),$("#delete-blacklist-form").submit())}function approveCampaign(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var a="/api/campaigns/"+e+"/approve";$.post(a,function(e){location.reload()})}function completeCampaign(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var a="/api/campaigns/"+e+"/complete";$.post(a,function(e){location.reload()})}function deleteCampaign(e){confirm("Você tem certeza dessa ação?")&&($("#delete-campaign-form").attr("action","/campaigns/"+e),$("#delete-campaign-form").submit())}function denieCampaign(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var a="/api/campaigns/"+e+"/denie";$.post(a,function(e){location.reload()})}function deleteAllGlobalMessages(){confirm("Você tem certeza dessa ação?")&&($("#delete-message-form").attr("action","/global-messages"),$("#delete-message-form").submit())}function deleteGlobalMessage(e){confirm("Você tem certeza dessa ação?")&&($("#delete-message-form").attr("action","/global-messages/"+e),$("#delete-message-form").submit())}function deleteMessage(e){confirm("Você tem certeza dessa ação?")&&($("#delete-message-form").attr("action","/messages/"+e),$("#delete-message-form").submit())}function deleteNumberList(e){confirm("Você tem certeza dessa ação?")&&($("#delete-number-lists-form").attr("action","/campaigns/number-lists/"+e),$("#delete-number-lists-form").submit())}function deleteReport(e){confirm("Você tem certeza dessa ação?")&&($("#delete-report-form").attr("action","/reports/"+e),$("#delete-report-form").submit())}function changeUserStatus(e,a){var t=document.querySelector("#changeStatus-users-form");t.action=e?"/users/"+a+"/approve":"/users/"+a+"/denie",t.submit()}function deleteUser(e){confirm("Você tem certeza dessa ação?")&&($("#delete-users-form").attr("action","/users/"+e),$("#delete-users-form").submit())}function editUser(e){$.getJSON("/api/users/"+e,function(a){$("#users-form-modal .modal-title").html("Editando usuário <b><i>"+a.name+"</i></b>");var t=document.querySelector("#users-form-modal .modal-body"),o=document.createElement("form");o.id="edit-form",o.method="POST",o.action="/users/"+e;var r=document.createElement("input");r.type="hidden",r.name="_token",r.value=$('meta[name="csrf-token"]').attr("content");var l=document.createElement("input");l.type="hidden",l.name="_method",l.value="PUT";var n=document.createElement("div");n.className="form-group has-feedback";var m=document.createElement("select");m.className="form-control",m.name="status";var i=document.createElement("option");i.setAttribute("value","W"),"W"===a.status&&i.setAttribute("selected",!0),i.text="Aguardando aprovação";var s=document.createElement("option");s.setAttribute("value","A"),"A"===a.status&&s.setAttribute("selected",!0),s.text="Aprovado";var d=document.createElement("option");d.setAttribute("value","D"),"D"===a.status&&d.setAttribute("selected",!0),d.text="Negado",m.appendChild(i),m.appendChild(s),m.appendChild(d),n.appendChild(m);var c=document.createElement("div");c.className="form-group has-feedback";var u=document.createElement("select");u.className="form-control",u.name="category";var p=document.createElement("option");p.setAttribute("value","ADMIN"),"ADMIN"==a.category&&p.setAttribute("selected",!0),p.text="Administrador";var f=document.createElement("option");f.setAttribute("value","CUSTOMER"),"CUSTOMER"==a.category&&f.setAttribute("selected",!0),f.text="Cliente",u.appendChild(p),u.appendChild(f),c.appendChild(u);var g=document.createElement("div");g.className="form-group has-feedback";var b=document.createElement("input");b.className="form-control",b.setAttribute("name","name"),b.setAttribute("value",a.name);var h=document.createElement("span");h.className="glyphicon glyphicon-user form-control-feedback",g.appendChild(b),g.appendChild(h);var v=document.createElement("div");v.className="form-group has-feedback";var C=document.createElement("input");C.className="form-control",C.setAttribute("name","email"),C.setAttribute("type","email"),C.setAttribute("value",a.email);var y=document.createElement("span");y.className="glyphicon glyphicon-envelope form-control-feedback",v.appendChild(C),v.appendChild(y);var E=document.createElement("div");E.className="form-group has-feedback";var N=document.createElement("input");N.className="form-control",N.setAttribute("name","password"),N.setAttribute("type","password"),N.setAttribute("placeholder","Senha");var x=document.createElement("span");x.className="glyphicon glyphicon-lock form-control-feedback",E.appendChild(N),E.appendChild(x);var A=document.createElement("div");A.className="form-group has-feedback";var k=document.createElement("input");k.className="form-control",k.setAttribute("name","password_confirmation"),k.setAttribute("type","password"),k.setAttribute("placeholder","Repita a senha");var S=document.createElement("span");S.className="glyphicon glyphicon-log-in form-control-feedback",A.appendChild(k),A.appendChild(S),o.appendChild(r),o.appendChild(l),o.appendChild(n),o.appendChild(c),o.appendChild(g),o.appendChild(v),o.appendChild(E),o.appendChild(A),t.appendChild(o);var q=$("#edit-form").html();q+="<div class='text-right'><button type='button' class='btn btn-danger btn-flat' data-dismiss='modal'><i class='fa fa-fw fa-arrow-circle-left'></i>Cancelar</button>",q+="<button type='submit' class='btn btn-warning btn-flat' style='margin-left: 6px;'>Editar usuário</button></div>",$("#edit-form").html(q),$("#users-form-modal .modal-footer").html(" "),$("#users-form-modal").modal("show")}),$("#users-form-modal .modal-title").html(" "),$("#users-form-modal .modal-body").html(" "),$("#users-form-modal .modal-footer").html(" ")}function editUserCredits(e,a,t){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.getJSON("/api/users/"+e,function(o){$("#users-form-modal .modal-title").html("Editando créditos <b><i>"+o.name+"</i></b>"),$("#users-form-modal.modal .modal-dialog").addClass("modal-sm");var r=document.querySelector("#users-form-modal .modal-body"),l=document.createElement("div");l.className="form-group";var n=document.createElement("label");n.setAttribute("for","total"),n.textContent="Total";var m=document.createElement("input");m.className="form-control",m.type="number",m.name="total",m.id="total",l.appendChild(n),l.appendChild(m),r.appendChild(l),$("input[name=total]").attr("value",t);var i=$("#users-form-modal .modal-body").html();i+="<div class='text-right'><button type='button' class='btn btn-danger btn-flat' data-dismiss='modal'><i class='fa fa-fw fa-arrow-circle-left'></i>Cancelar</button>",i+="<button id='edit-credit' type='button' class='btn btn-warning btn-flat' style='margin-left: 6px;'>Editar creditos</button></div>",$("#users-form-modal .modal-body").html(i),$("#edit-credit").click(function(t){var o="/api/users/credits/"+a;$.post(o,{user_id:e,id:a,total:$("input[name=total]").val()},function(e){location.reload()}).fail(function(e){})}),$("#users-form-modal .modal-footer").html(" "),$("#users-form-modal").modal("show")}),$("#users-form-modal .modal-title").html(" "),$("#users-form-modal .modal-body").html(" "),$("#users-form-modal .modal-footer").html(" ")}function enableUserCredits(e){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.post("/api/users/credits",{user_id:e,total:15},function(e){location.reload()})}function showUser(e){$.getJSON("/api/users/"+e,function(e){$("#users-form-modal .modal-title").html("Exibindo usuário <b><i>"+e.name+"</i></b>"),$("#users-form-modal").modal("show")}),$("#users-form-modal .modal-title").html(" "),$("#users-form-modal .modal-body").html(" ")}$.getJSON("/api/messages",function(e){var a="";if(e.length){a+=e.length>1?"Você tem "+e.length+" mensagens":"Você tem "+e.length+" mensagem",$("#msg-counter").html(e.length);var t="<ul class='menu'>";for(cont=0;cont<e.length;cont++)t+='<li><a href="#"><div class="pull-left"><i class="fa fa-fw fa-envelope"></i></div><h4>'+e[cont].title+"</h4></a></li>";t+="</ul>",$("#msg-list").html(t)}else a+="Sem mensagens no momento";$("#msg-header").html(a)}),$("#campaign-add-form #campaign-type").change(function(e){var a;"TXT"==this.value&&(a="",a+="<div class='form-group'>",a+="<label for='campaign-text'>Mensagem</label>",a+="<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>",a+="</div>"),"ITXT"==this.value&&(a="",a+="<div class='form-group'>",a+="<label for='campaign-file-name'>Nome da Imagem</label>",a+="<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>",a+="</div>",a+="<div class='form-group'>",a+="<label for='campaign'>Imagem</label>",a+="<input type='file' id='campaign-file' name='file' required>",a+="<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>",a+="</div>",a+="<div class='form-group'>",a+="<label for='campaign-text'>Mensagem</label>",a+="<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>",a+="</div>"),"VTXT"==this.value&&(a="",a+="<div class='form-group'>",a+="<label for='campaign-file-name'>Nome do Vídeo</label>",a+="<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>",a+="</div>",a+="<div class='form-group'>",a+="<label for='campaign'>Video</label>",a+="<input type='file' id='campaign-file' name='file' required>",a+="<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>",a+="</div>",a+="<div class='form-group'>",a+="<label for='campaign-text'>Mensagem</label>",a+="<textarea class='form-control' id='campaign-text' name='text' placeholder='Digite a mensagem' required></textarea>",a+="</div>"),"PDF"==this.value&&(a="",a+="<div class='form-group'>",a+="<label for='campaign-file-name'>Nome do PDF</label>",a+="<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>",a+="</div>",a+="<div class='form-group'>",a+="<label for='campaign'>PDF</label>",a+="<input type='file' id='campaign-file' name='file' required>",a+="<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>",a+="</div>"),"AUDIO"==this.value&&(a="",a+="<div class='form-group'>",a+="<label for='campaign-file-name'>Nome do Audio</label>",a+="<input class='form-control' id='campaign-file-name' name='file_name' placeholder='Digite um nome para o arquivo' required>",a+="</div>",a+="<div class='form-group'>",a+="<label for='campaign'>AUDIO</label>",a+="<input type='file' id='campaign-file' name='file' required>",a+="<p class='help-block'>Tamanho máximo 4mb<br/>Faça upload do arquivo seguindo as orientações.</p>",a+="</div>"),$("#campaign-add-form #type-content").html(a)}),$("#campaign-add-form #campaign-lauching-date").change(function(e){var a=this;$.getJSON("/api/blacklist",function(e){-1!=$.inArray(a.value,e)&&(alert("Data bloqueada pela administração"),a.value="")})}),$("#reports-add-form #report-campaign-user").change(function(e){var a=$("#reports-add-form #report-campaign-user").val();$.getJSON("/api/users/"+a+"/campaigns",function(e){var a=document.querySelector("#reports-add-form #report-campaign");e.forEach(function(e){var t=document.createElement("option");t.value=e.id,t.text=e.name,a.appendChild(t)},this)})});
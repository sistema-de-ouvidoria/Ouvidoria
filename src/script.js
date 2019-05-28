function funcaoDeBusca() {
    var input, filter, table, tr, assunto, descricao, i, txtValue, txtValue2;
    input = document.getElementById("input");
    filter = input.value.toUpperCase();
    table = document.getElementById("minhaTabela");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        assunto = tr[i].getElementsByTagName("td")[1];
        descricao = tr[i].getElementsByTagName("td")[5];
        if (assunto || descricao) {
            txtValue = assunto.textContent || assunto.innerText;
            txtValue2 = descricao.textContent || descricao.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function funcaoDeBuscaUsuario() {
    var inputUsuario, filter, table, tr, cpf, nome, i, txtValue, txtValue2;
    inputUsuario = document.getElementById("inputUsuario");
    filter = inputUsuario.value.toUpperCase();
    table = document.getElementById("minhaTabela");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        cpf = tr[i].getElementsByTagName("td")[0];
        nome = tr[i].getElementsByTagName("td")[1];
        if (cpf || nome) {
            txtValue = cpf.textContent || cpf.innerText;
            txtValue2 = nome.textContent || nome.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function funcaoDeBuscaProtocolo() {
    var input, filter, table, tr, protocolo, i, txtValue;
    input = document.getElementById("inputProtocolo");
    filter = input.value.toUpperCase();
    table = document.getElementById("minhaTabela");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        protocolo = tr[i].getElementsByTagName("td")[0];

        if (protocolo) {
            txtValue = protocolo.textContent || protocolo.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function somenteNumerosTel(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace
    // charCode 9 = tab
    if (charCode != 8 && charCode != 9) {
        // charCode 48 equivale a 0
        // charCode 57 equivale a 9
        var max = 11;
        var num = document.getElementById('telefone');

        if ((charCode < 48 || charCode > 57)||(telefone.value.length >= max)) {
            return false;
        }

    }
}

function somenteNumerosCPF(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace
    // charCode 9 = tab
    if (charCode != 8 && charCode != 9) {
        // charCode 48 equivale a 0
        // charCode 57 equivale a 9
        var max = 11;
        var num = document.getElementById('cpf');

        if ((charCode < 48 || charCode > 57)||(cpf.value.length >= max)) {
            return false;
        }

    }
}
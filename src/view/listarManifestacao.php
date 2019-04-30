<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sua Página</title>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>

<table id="minhaTabela">
    <thead>
    <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Ação</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Vinicius Moura</td>
        <td>viniciusmouramail@gmail.com</td>
        <td>49 12345-68791</td>
        <td><a href="">Deletar</a></td>
    </tr>
    <tr>
        <td>José Andrade</td>
        <td>joseandrade@gmail.com</td>
        <td>32 9875-68791</td>
        <td><a href="">Deletar</a></td>
    </tr>
    <tr>
        <td>Rodrigo Costa</td>
        <td>rodrigocosta@gmail.com</td>
        <td>32 4564-68791</td>
        <td><a href="">Deletar</a></td>
    </tr>
    </tbody>
</table>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#minhaTabela').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });
</script>

</body>
</html>
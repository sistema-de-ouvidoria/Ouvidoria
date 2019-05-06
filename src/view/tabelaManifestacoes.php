<table id="minhaTabela" class="table-hover table-striped table-bordered" data-searching="false">
    <thead>
    <tr>
        <th>Protocolo</th>
        <th>Assunto</th>
        <th>Data de criação</th>
        <th>Tipo da Manifestação</th>
        <th>Situação</th>
        <th>Detalhar</th>
        <th style="display:none;"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    if(!is_null($dados)) {
        for ($i = 0; $i < count($dados); $i++): ?>
            <tr>
                <td><?= $dados[$i][0] ?></td>
                <td><?= $dados[$i][1] ?></td>
                <td><?= date('d-m-Y', strtotime($dados[$i][2])) ?></td>
                <td><?= $dados[$i][3] ?></td>
                <td><?= $dados[$i][4] ?></td>
                <td style="display:none;"><?= $dados[$i][5] ?></td>
            <?php if($nvlAcesso == 2): ?>
                <td><a class="btn btn-warning" href="?function=detalharManifestacaoOuvidor&id=<?= $dados[$i][0] ?>">Detalhar</a></td>
            <?php elseif($nvlAcesso == 3): ?>
                <td><a class="btn btn-warning" href="?function=detalharManifestacaoAdmPublico&id=<?= $dados[$i][0] ?>">Detalhar</a></td>
            <?php endif; ?>
            </tr>
        <?php endfor;
    }?>
    </tbody>
</table>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#minhaTabela').DataTable({
            "language": {
                "lengthMenu": "",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "paginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });
</script>
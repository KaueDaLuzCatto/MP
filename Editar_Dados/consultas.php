<?php include_once 'includes/header.inc.php'?>
<?php include_once 'includes/menu.inc.php'?>

<div class="row container">
    <div class="col s12">
        <h5 class="light">Consultas</h5><hr>

        <table class="stripped">
            <thead>
                <tr>
                    <th>Código do Municipio</th>
                    <th>Data de Vigência</th>
                    <th>Código de Serviço</th>
                    <th>Descrição Aliquota</th>
                    <th>Percentual Aliquota</th>
                    <th>Data de Manutenção</th>
                    <th>Hora de Manutenção</th>
                    <th>Usuário de Manutenção</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once 'banco_de_dados/read.php';
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once 'includes/footer.inc.php'?>
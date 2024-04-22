<?php 
session_start();
include_once 'includes/header.inc.php';
include_once 'includes/menu.inc.php';
?>
<?php session_start() ?>

<div class="row container">
    <div class="col s12">
        <h5 class="light">Edição de Registros</h5><hr>
    </div>
</div>

<?php
include_once 'banco_de_dados/conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$_SESSION['id'] = $id;
$querySelect = $link->query("SELECT * FROM tb_aliquotas WHERE id='$id'");
/*$codigo_municipio = filter_input(INPUT_GET, 'codigo_municipio', FILTER_SANITIZE_NUMBER_INT);
$data_vigencia = filter_input(INPUT_GET, 'data_vigencia', FILTER_SANITIZE_NUMBER_INT);
$codigo_servico = filter_input(INPUT_GET, 'codigo_servico', FILTER_SANITIZE_NUMBER_INT);
$_SESSION['codigo_municipio'] = $codigo_municipio;
$_SESSION['data_vigencia'] = $data_vigencia;
$_SESSION['codigo_servico'] = $codigo_servico;*/

/*$querySelect = $link->query("SELECT * FROM tb_aliquotas WHERE codigo_municipio='$codigo_municipio' AND data_vigencia ='$data_vigencia'");*/

while($registros = $querySelect->fetch_assoc()):
    $codigo_municipio = $registros['codigo_municipio'];
    $data_vigencia = $registros['data_vigencia'];;
    $codigo_servico = $registros['codigo_servico'];
    $descricao_aliquota = $registros['descricao_aliquota'];
    $percentual_aliquota = $registros['percentual_aliquota'];
    $data_manutencao = $registros['data_manutencao'];
    $hora_manutencao = $registros['hora_manutencao'];
    $usuario_manutencao = $registros['usuario_manutencao'];
endwhile;
?>





<!--FORMULÁRIO DE CADASTRO-->
<div class="row container">
            <p>&nbsp;</p>
            <form action="banco_de_dados/update.php" method="post" class="col s12">
                <fieldset class="formulario" style="padding: 15px">
                    <legend><img src="imagens/boneco_aliquota.jpeg" alt="[imagem]" width="100" ></legend>
                    <h5 class="light center">Alteração</h5>

                    <!--CAMPO DESCRIÇÃO ALIQUOTA-->
                    <div class="input-field col s12">
                        <input type="text" name="descricao_aliquota" id="descricao_aliquota" value="<?php echo $descricao_aliquota ?>" maxlength="80" required autofocus>
                        <label for="descricao_aliquota">Descricao Aliquota</label>
                    </div>

                    <!--CAMPO PERCENTUAL ALIQUOTA-->
                    <div class="input-field col s12">
                    <input type="text" name="percentual_aliquota" id="percentual_aliquota" maxlength="5" pattern="\d+(\.\d{1,2})?" value="<?php echo $percentual_aliquota ?>" required autofocus>
                        <label for="percentual_aliquota">Percentual Aliquota</label>
                        <span class="helper-text" data-error="Formato inválido. Use um número inteiro ou até duas casas decimais (ex: 39,99 ou 40)"></span>
                    </div>


                    <!--CAMPO Data da Manutenção-->
                    <div class="input-field col s12">
                        <input type="date" name="data_manutencao" id="data_manutencao" value="<?php echo $data_manutencao ?>"maxlength="5">
                        <label for="data_manutencao">Data de Manutenção</label>
                    </div>

                    <!--CAMPO Hora da Manutenção-->
                    <div class="input-field col s12">
                        <input type="time" name="hora_manutencao" id="hora_manutencao" value="<?php echo $hora_manutencao ?>" maxlength="6">
                        <label for="hora_manutencao">Hora de Manutenção</label>
                    </div>

                    <!--CAMPO Usuario da Manutenção-->
                    <div class="input-field col s12">
                        <input type="text" name="usuario_manutencao" id="usuario_manutencao" value="<?php echo $usuario_manutencao ?>" maxlength="20">
                        <label for="usuario_manutencao">Usuario da Manutenção</label>
                    </div>

                    <!-- BOTÕES -->
                    <div class="input-field col s12">
                        <input type="submit" value="alterar" class="btn blue">
                        <a href="consultas.php" class="btn red">cancelar</a>
                    </div>
                </fieldset>
            </form>
        </div>

<?php include_once 'includes/footer.inc.php'?>
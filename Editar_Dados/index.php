<?php session_start() ?>

<?php include_once 'includes/header.inc.php' ?>

<?php include_once 'includes/menu.inc.php' ?>

<!--FORMULÁRIO DE CADASTRO-->
<div class="row container">
  <p>&nbsp;</p>
  <form action="banco_de_dados/create.php" method="post" class="col s12">
    <fieldset class="formulario" style="padding: 15px">
      <legend><img src="imagens/boneco_aliquota.jpeg" alt="[imagem]" width="100"></legend>
      <h5 class="light center">Cadastro de Aliquotas</h5>

      <?php
      if (isset($_SESSION['msg'])) :
        echo $_SESSION['msg'];
        session_unset();
      endif;
      ?>
      <!--CAMPO CODIGO MUNICIPIO-->
      <div class="input-field col s12">
        <!-- <i class="material-icons prefix">add_location</i> -->
        <input placeholder="Código Municipio" type="number" name="codigo_municipio" id="codigo_municipio" class="active" maxlength="8" required autofocus>
          <label for="codigo_municipio"></label>
      </div>

      <!--CAMPO DATA VIGENCIA-->
      <div class="input-field col s12">
        <input placeholder="Código Municipio" type="date" name="data_vigencia" id="data_vigencia" maxlength="8" required autofocus>
        <label for="data_vigencia">Data de Vigência</label>
      </div>

      <!--CAMPO CÓDIGO SERVIÇO-->
      <div class="input-field col s12">
        <input placeholder="Código de Serviço" type="number" name="codigo_servico" id="codigo_servico" maxlength="10" required autofocus>
        <label for="codigo_servico"></label>
      </div>

      <!--CAMPO DESCRIÇÃO ALIQUOTA-->
      <div class="input-field col s12">
        <input placeholder="Descricao Aliquota" type="text" name="descricao_aliquota" id="descricao_aliquota" maxlength="30" required autofocus>
        <label for="descricao_aliquota"></label>
      </div>

      <!--CAMPO PERCENTUAL ALIQUOTA-->
      <div class="input-field col s12">
        <input placeholder="Percentual Aliquota" type="number" name="percentual_aliquota" id="percentual_aliquota" maxlength="5" required autofocus>
        <label for="percentual_aliquota"></label>
      </div>


      <!--CAMPO Data da Manutenção-->
      <div class="input-field col s12">
        <input type="date" name="data_manutencao" id="data_manutencao" maxlength="5">
        <label for="data_manutencao">Data de Manutenção</label>
      </div>

      <!--CAMPO Hora da Manutenção-->
      <div class="input-field col s12">
        <input type="time" name="hora_manutencao" id="hora_manutencao" maxlength="6">
        <label for="hora_manutencao">Hora de Manutenção</label>
      </div>

      <!--CAMPO Usuario da Manutenção-->
      <div class="input-field col s12">
        <input placeholder="Usuario da Manuteção" type="text" name="usuario_manutencao" id="usuario_manutencao" maxlength="20">
        <label for="usuario_manutencao"></label>
      </div>

      <!-- BOTÕES -->
      <div class="input-field col s12">
        <input type="submit" value="cadastrar" class="btn blue">
        <input type="reset" value="limpar" class="btn red">
      </div>
    </fieldset>
  </form>
</div>

<?php include_once 'includes/footer.inc.php' ?>
<?php include_once 'includes/header.inc.php' ?>
<?php include_once 'includes/menu.inc.php' ?>

<div class="row container">
    <div class="col s12">
        <h5 class="light">Consultas</h5><hr>
        <!-- Formulário HTML para enviar o arquivo -->
        <form action="ler_txt.php" method="post" enctype="multipart/form-data">
            <div class="file-field input-field">
                <button class="btn waves-effect waves-light">
                    Selecione o arquivo TXT
                    <input type="file" name="fileToUpload" id="fileToUpload">
</button>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="submit">Importar arquivo</button>
            <?php
                    include_once 'ler_txt.php';
                ?>
        </form>
    </div>
    <div class="row container">
</div>


<?php
include_once 'banco_de_dados/conexao.php';

// Verificar se o formulário foi enviado
if(isset($_POST["submit"])) {
    // Verificar se o arquivo foi enviado sem erros
    if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        // Ler o conteúdo do arquivo
        $file_content = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        
        // Verificar se o conteúdo do arquivo corresponde à estrutura esperada
        $lines = explode("\n", $file_content);
        foreach($lines as $line) {
            $data = explode(";", $line);
            if(count($data) != 6) {
                echo "Erro: O arquivo não está na estrutura correta.";
                exit();
            }
        }

        // Processar os dados do arquivo e comparar com o banco de dados
        foreach($lines as $line) {
            $data = explode(";", $line);
            $codigo_municipio = $data[0];
            $data_servico = DateTime::createFromFormat('d/m/Y', trim($data[1]));
            if ($data_servico === false) {
                echo "Erro: Formato de data inválido.";
                exit();
            }
            $data_servico = $data_servico->format('Y-m-d');
            $conta = $data[2];
            $codigo_servico = $data[3];
            $valor_tributar = (double) $data[4];
            $usuario_manutencao = trim($data[5]); // Remove espaços em branco no início e no final

            // Verificar se os dados existem no banco de dados
            $query = "SELECT a.percentual_aliquota
                      FROM tb_conta c
                      LEFT JOIN tb_aliquotas a ON c.codigo_municipio = a.codigo_municipio 
                                                AND c.data_vigencia <= a.data_vigencia 
                                                AND c.codigo_servico = a.codigo_servico
                      WHERE c.codigo_municipio = $codigo_municipio 
                        AND c.data_vigencia <= '$data_servico' 
                        AND c.conta = $conta";
            $result = $link->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $percentual_aliquota = $row["percentual_aliquota"];
                $valor_imposto = ($valor_tributar * $percentual_aliquota) / 100;
                ?>
                <div class="card-panel teal lighten-5">
                    <p><strong>Código do Município:</strong> <?php echo $codigo_municipio; ?></p>
                    <p><strong>Data do Serviço:</strong> <?php echo $data_servico; ?></p>
                    <p><strong>Conta:</strong> <?php echo $conta; ?></p>
                    <p><strong>Valor a Tributar:</strong> <?php echo $valor_tributar; ?></p>
                    <p><strong>Descrição do Serviço:</strong> <?php echo $codigo_servico; ?></p>
                    <p><strong>Valor do Imposto:</strong> <?php echo $valor_imposto; ?></p>
                </div>
                <?php
            } else {
                ?>
                <div class="card-panel red lighten-5">
                    <p><strong>Código do Município:</strong> <?php echo $codigo_municipio; ?></p>
                    <p><strong>Data do Serviço:</strong> <?php echo $data_servico; ?></p>
                    <p><strong>Conta:</strong> <?php echo $conta; ?></p>
                    <p><strong>Valor a Tributar:</strong> <?php echo $valor_tributar; ?></p>
                    <p><strong>Descrição do Serviço:</strong> <?php echo $codigo_servico; ?></p>
                    <p><strong>Mensagem de Retorno:</strong> Os dados que você forneceu ao importar o arquivo não constam na base de dados</p>
                </div>
                
                <?php
            }
        }
    } else {
        echo "Erro ao carregar o arquivo.";
    }
}
?>






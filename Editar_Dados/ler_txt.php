<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar TXT</title>
</head>
<body>
    <form action="ler_txt.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".txt">
        <button type="submit" name="submit">Importar</button>
    </form>
</body>
</html>

<?php
// Oculta os warnings e fatal errors
error_reporting(E_ERROR | E_PARSE);
 
// Verifica se o arquivo foi enviado corretamente
if ($_FILES["file"]["error"] > 0) {
    echo "Erro ao enviar o arquivo: " . $_FILES["file"]["error"];
} else {
    // Define o caminho para salvar o arquivo temporariamente
    $caminho_temporario = $_FILES["file"]["tmp_name"];
 
    $codigo_municipio = filter_input(INPUT_POST, 'codigo_municipio', FILTER_SANITIZE_NUMBER_INT);
    $data_vigencia = filter_input(INPUT_POST, 'data_vigencia', FILTER_SANITIZE_NUMBER_INT);
    $codigo_servico = filter_input(INPUT_POST, 'codigo_servico', FILTER_SANITIZE_NUMBER_INT);
    $conta = filter_input(INPUT_POST, 'conta', FILTER_SANITIZE_NUMBER_INT);
    
    $data_manutencao = filter_input(INPUT_POST, 'data_manutencao', FILTER_SANITIZE_NUMBER_INT);
    $hora_manutencao = filter_input(INPUT_POST, 'hora_manutencao', FILTER_SANITIZE_NUMBER_INT);
    $usuario_manutencao = filter_input(INPUT_POST, 'usuario_manutencao', FILTER_SANITIZE_SPECIAL_CHARS);
    
    // Tratamento específico para campos de data e hora
    $data_vigencia = date("Y-m-d", strtotime($data_vigencia));
    //$data_manutencao = date("Y-m-d H:i:s", strtotime("$data_manutencao $hora_manutencao"));
    $data_manutencao = date("Y-m-d", strtotime($data_manutencao));
    $hora_manutencao = date("H:i:s", strtotime($hora_manutencao));

    // Verifica se o arquivo foi enviado com sucesso
    if (is_uploaded_file($caminho_temporario)) {
        // Abre o arquivo TXT para leitura
        if (($handle = fopen($caminho_temporario, "r")) !== FALSE) {
            // Conecta ao banco de dados
            include 'conexao.php';
 
            // Loop para processar cada linha do arquivo TXT
            while (($dados = fgetcsv($handle, 1000, ";")) !== FALSE) {
                // Os dados estão no array $dados, onde cada elemento corresponde a uma coluna no TXT
 
                $codigo_municipio = $dados[0];
                $data_servico = $dados[1];
                $conta = $dados[2];
                $codigo_servico = $dados[3];
                $valor_tributar = $dados[4];
                $descricao_servico = $dados[5];
 
                // Consulta a alíquota na tabela tab_aliquota usando prepared statements
                $sql_aliquota = "SELECT codigo_municipio, data_vigencia, codigo_servico, percentual_aliquota FROM tb_aliquotas WHERE codigo_municipio = ? AND data_vigencia <= ? AND codigo_servico = ?";
                $stmt = $conexao->prepare($sql_aliquota);
                $stmt->bind_param("iss", $codigo_municipio, $data_servico, $codigo_servico);
                $stmt->execute();
                $result_aliquota = $stmt->get_result();
 
                if ($result_aliquota) {
                    $row_aliquota = $result_aliquota->fetch_assoc();
                    if ($row_aliquota) {
                        $percentual_aliquota = $row_aliquota['percentual_aliquota'];
 
                        // Verifica se a conta está cadastrada na tabela conta
                        $sql_verifica_conta = "SELECT COUNT(*) AS num_contas FROM conta WHERE codigo_municipio = ? AND data_vigencia <= ? AND codigo_servico = ? AND conta = ?";
                        $stmt_conta = $conexao->prepare($sql_verifica_conta);
                        $stmt_conta->bind_param("issi", $codigo_municipio, $data_servico, $codigo_servico, $conta);
                        $stmt_conta->execute();
                        $result_verifica_conta = $stmt_conta->get_result();
                        $row_verifica_conta = $result_verifica_conta->fetch_assoc();
 
                        if ($row_verifica_conta['num_contas'] > 0) {
                            // Calcula o valor do imposto
                            $valor_imposto = $valor_tributar * $percentual_aliquota / 100;
 
                            // Exibe os resultados para cada linha do arquivo TXT
                            echo "Código Município: $codigo_municipio<br>";
                            echo "Data Serviço: $data_servico<br>";
                            echo "Conta: $conta<br>";
                            echo "Valor Tributar: $valor_tributar<br>";
                            echo "Descrição Serviço: $descricao_servico<br>";
                            echo "Percentual Alíquota: $percentual_aliquota<br>";
                            echo "Valor Imposto: $valor_imposto<br>";
                            echo "<hr>";
                        } else {
                            echo "A conta $conta não está cadastrada para o código de município $codigo_municipio, data de vigência $data_servico e código de serviço $codigo_servico <br>";
                        }
                    } else {
                        echo "Alíquota não encontrada para o código de município $codigo_municipio, data de vigência $data_servico e código de serviço $codigo_servico<br>";
                    }
                } else {
                    echo "Erro na consulta SQL: " . $conexao->error;
                }
            }
            fclose($handle); // Fecha o arquivo TXT
        } else {
            echo "Erro ao abrir o arquivo TXT";
        }
    } else {
        echo "Erro ao receber o arquivo enviado";
    }
}
?>

<?php 
session_start(); 
include_once 'conexao.php';

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


// Verificação se já existe o serviço cadastrado
$querySelect = $link->query("SELECT codigo_municipio, data_vigencia, codigo_servico, conta FROM tb_conta");
$array_servicos = [];

while($servicos = $querySelect->fetch_assoc()) {
    $servico_existe = [
        'codigo_municipio' => $servicos['codigo_municipio'],
        'data_vigencia' => $servicos['data_vigencia'],
        'codigo_servico' => $servicos['codigo_servico'],
        'conta' => $servicos['conta']
    ];
    array_push($array_servicos, $servico_existe);
}

foreach($array_servicos as $servico) {
    if($servico['codigo_municipio'] == $codigo_municipio && $servico['data_vigencia'] == $data_vigencia && $servico['codigo_servico'] == $codigo_servico && $servico['conta'] == $conta) {
        $_SESSION['msg'] = "<p class='center red-text'>Já existe um serviço cadastrado com esses dados</p>";
        header("Location:../");
        exit();
    }
}

// Verifica se data_vigencia é maior que data_manutencao
if (strtotime($data_vigencia) <= strtotime($data_manutencao)) {
    $_SESSION['msg'] = "<p class='center red-text'>A data de vigência deve ser maior que a data de manutenção</p>";
    header("Location:../");
    exit();
}


// Se não existir, realiza o cadastro
$queryInsert = $link->query("INSERT INTO tb_conta (codigo_municipio, data_vigencia, codigo_servico, conta, data_manutencao, hora_manutencao, usuario_manutencao) VALUES ('$codigo_municipio','$data_vigencia','$codigo_servico','$conta','$data_manutencao','$hora_manutencao','$usuario_manutencao')");
$affected_rows = mysqli_affected_rows($link);

if($affected_rows > 0) {
    $_SESSION['msg'] = "<p class='center green-text'>Cadastro efetuado com sucesso!!!</p>";
    header("Location:../");
    exit();
} else {
    $_SESSION['msg'] = "<p class='center red-text'>Erro ao cadastrar o serviço</p>";
    header("Location:../");
    exit();
}

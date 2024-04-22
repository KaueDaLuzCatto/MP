<?php 

include_once 'conexao.php';

$querySelect = $link->query("SELECT * FROM tb_aliquotas");

while($registros = $querySelect->fetch_assoc()):
    $id = $registros['id'];
    $codigo_municipio = $registros['codigo_municipio'];
    $data_vigencia = $registros['data_vigencia'];
    $codigo_servico = $registros['codigo_servico'];
    $descricao_aliquota = $registros['descricao_aliquota'];
    $percentual_aliquota = $registros['percentual_aliquota'];
    $data_manutencao = $registros['data_manutencao'];
    $hora_manutencao = $registros['hora_manutencao'];
    $usuario_manutencao = $registros['usuario_manutencao'];

    echo"<tr>";
    echo"<td>$codigo_municipio</td><td>$data_vigencia</td><td>$codigo_servico</td><td>$descricao_aliquota</td><td>$percentual_aliquota</td><td>$data_manutencao</td><td>$hora_manutencao</td><td>$usuario_manutencao</td><td><a href='editar.php?id=$id'>
    <i class='material-icons'>edit</i></td><td><a href='banco_de_dados/delete.php?id=$id'><i class='material-icons'>delete</i></td>";
    echo"</tr>";

endwhile;
<?php 
session_start(); 
include_once 'conexao.php';
$id = $_SESSION['id'];

$descricao_aliquota = filter_input(INPUT_POST, 'descricao_aliquota', FILTER_SANITIZE_SPECIAL_CHARS);
$percentual_aliquota = filter_input(INPUT_POST, 'percentual_aliquota', FILTER_SANITIZE_NUMBER_FLOAT);
$data_manutencao = filter_input(INPUT_POST, 'data_manutencao', FILTER_SANITIZE_NUMBER_INT);
$hora_manutencao = filter_input(INPUT_POST, 'hora_manutencao', FILTER_SANITIZE_NUMBER_INT);
$usuario_manutencao = filter_input(INPUT_POST, 'usuario_manutencao', FILTER_SANITIZE_SPECIAL_CHARS);


//$data_manutencao = date("Y-m-d H:i:s", strtotime("$data_manutencao $hora_manutencao"));
$data_manutencao = date("Y-m-d", strtotime($data_manutencao));
$hora_manutencao = date("H:i:s", strtotime($hora_manutencao));

$queryUpdate = $link->query("UPDATE tb_aliquotas SET descricao_aliquota='$descricao_aliquota', percentual_aliquota='$percentual_aliquota', data_manutencao='$data_manutencao', hora_manutencao='$hora_manutencao', usuario_manutencao='$usuario_manutencao' WHERE id='$id'");

if(mysqli_affected_rows($link)> 0):
    header("Location:../consultas.php");
endif;

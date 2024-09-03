<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_GET['id'])) {

    $id_fornecedor = $_GET['id'];

    //inserir no banco.
    $sql = "DELETE FROM fornecedores WHERE id='$id_fornecedor'";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)) {
        echo "Falha ao deletar fornecedor!";
    } else {
        $_SESSION['fornecedor_deletado'] = true;
        header('Location:../view/lista_fornecedores.php');
        exit();
    }
} else {
    echo "<script> alert('Não foi possível excluir fornecedor');</script>";
}

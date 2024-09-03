<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_GET['id'])) {

    $id_produto = $_GET['id'];

    //inserir no banco.
    $sql = "DELETE FROM produto WHERE codigo='$id_produto'";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)) {
        echo "Falha ao deletar produto!";
    } else {
        $_SESSION['produto_deletado'] = true;
        header('Location:../view/lista_produtos.php');
        exit();
    }
} else {
    echo "<script> alert('Não foi possível excluir produto');</script>";
}

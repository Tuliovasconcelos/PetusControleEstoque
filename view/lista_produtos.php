<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

$sql_lista = "SELECT p.codigo,p.descricao,p.tipo,p.unidade,p.data_cadastro,p.quantidade,p.fornecedor,p.valor_unidade,
f.nome,f.id
FROM produto AS p
INNER JOIN fornecedores as f
ON p.fornecedor=f.id";
$result_lista = mysqli_query($conexao, $sql_lista);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Lista de Produtos</title>

  <script src="../js/sweetalert.min.js"></script>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style>
    .img {
      margin-top: 10%;
      margin-left: 10%;
      width: 20%;
    }

    .preload {
      position: fixed;
      z-index: 99999;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.50;
      -moz-opacity: 0.50;
      filter: alpha(opacity=50);
      background: black;
      background-image: url('../imagens/loader.gif');
      background-size: 60px 60px;
      background-position: center;
      background-repeat: no-repeat;
      overflow: hidden;

      .canto {

        position: fixed;

        right: 0pt;

      }
    }
  </style>

</head>

<body id="page-top">
  <div id="preload" class="preload"></div>
  <?php
  include_once "nav.php";
  ?>

  <div id="wrapper">

    <?php
    include_once "menu.php";
    ?>
    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="color: #e67e00;" href="painel.php">Painel Principal</a>
          </li>
          <li class="breadcrumb-item active">Tabela de Produtos</li>
        </ol>

        <!-- Alerts-->
        <?php if (isset($_SESSION['produto_deletado'])) { ?>
          <script>
            swal("Feito!", "Produto excluído com sucesso!", "success");
          </script>
        <?php
          unset($_SESSION['produto_deletado']);
        } ?>
        <?php if (isset($_SESSION['cadastrado'])) { ?>
          <script>
            swal("Feito", "Produto cadastrado com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['cadastrado']);
        } ?>
        <?php if (isset($_SESSION['nao_cadastrado'])) { ?>
          <script>
            swal("Ops", "Produto não pôde ser cadastrado!", "error")
          </script>
        <?php

          unset($_SESSION['nao_cadastrado']);
        } ?>

        <?php if (isset($_SESSION['prod_alterado'])) { ?>
          <script>
            swal("Feito!", "Produto alterado com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['prod_alterado']);
        } ?>

        <?php if (isset($_SESSION['select_vazio'])) { ?>
          <script>
            swal("Ops...", "Selecione um produto!", "warning")
          </script>
        <?php
          unset($_SESSION['select_vazio']);
        } ?>

        <?php if (isset($_SESSION['prod_nao_alterado'])) { ?>
          <script>
            swal("Ops...", "Produto não pôde ser alterado!", "error")
          </script>
        <?php
          unset($_SESSION['prod_nao_alterado']);
        } ?>

        <div class="card mb-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div>
              <i class="fas fa-table"></i>
              Tabela de Produtos
            </div>
            <div>
              <?php require "modais/modal_cadastrar_produto.php" ?>
              <button style="background-color:#e67e00; color: white;" type="button" data-toggle="modal" data-target="#modal_cadastrar_produto" class="btn">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Cadastrar
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Fornecedor</th>
                    <th>Unidade</th>
                    <th>Valor unitário</th>
                    <th>Opções</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Fornecedor</th>
                    <th>Unidade</th>
                    <th>Valor unitário</th>
                    <th>Opções</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php while ($dados_lista = mysqli_fetch_array($result_lista)) {


                    $valor_unidade_formatado = number_format($dados_lista['valor_unidade'], 2, ',', '.');

                    echo "<tr>";
                    echo "<td> " . $dados_lista['codigo'] . "</td>";
                    echo "<td> " . $dados_lista['descricao'] . "</td>";
                    echo "<td> " . $dados_lista['tipo'] . "</td>";
                    echo "<td> " . $dados_lista['nome'] . "</td>";
                    echo "<td> " . $dados_lista['unidade'] . "</td>";
                    echo "<td> " . "R$" . $dados_lista['valor_unidade'] . "</td>";
                    echo "<td> " . "<a href='select_alterar_produto.php?id=" . $dados_lista['codigo'] . "' type='button' class='btn btn-outline-warning btn-sm 'data-toggle='tooltip' data-placement='top' title='Alterar' style='width:40%;'><i class='fa fa-cogs' aria-hidden='true'></i></a>" . " " . "<a href='../valida/valida_exclusao_produto.php?id=" . $dados_lista['codigo'] . "' type='button' class='btn btn-outline-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Excluir' style='width:40%;'><i class='fa fa-window-close' aria-hidden='true'></i></a>" . "</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"> Atualizado em :
            <?php date_default_timezone_set('America/Sao_Paulo');
            $date = date('d-m-y H:i');
            echo $date; ?>
          </div>
        </div>
      </div>

      <!-- Botão exportar-->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div style="margin-left:94%" class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="planilha_produtos.php"><button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Petus © Controle de Estoque 2020</span>
        </div>
      </div>
    </footer>
  </div>
  </div>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 1000);
    });

    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

</body>

</html>
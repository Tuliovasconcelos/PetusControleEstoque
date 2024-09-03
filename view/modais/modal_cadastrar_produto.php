<?php
require "../dao/conexao.php";

// Consulta para obter o último código dos produtos
$sqlProduto = "SELECT codigo FROM produto ORDER BY codigo DESC LIMIT 1";
$resultProduto = mysqli_query($conexao, $sqlProduto);

// Verifique se a consulta retornou resultados
if ($resultProduto && mysqli_num_rows($resultProduto) > 0) {
  $dadosProduto = mysqli_fetch_array($resultProduto);
} else {
  // Se não houver resultados, defina um valor padrão
  $dadosProduto = ['codigo' => 0];
}

// Consulta para obter os fornecedores
$sqlFornec = "SELECT * FROM fornecedores ORDER BY ID";
$resultFornec = mysqli_query($conexao, $sqlFornec);

// Verifique se a consulta retornou resultados
if (!$resultFornec) {
  die("Erro na consulta: " . mysqli_error($conexao));
}
?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_cadastrar_produto" tabindex="-1" role="dialog" aria-labelledby="modal_cadastrar_produtoTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div style="background-color:#e67e00" class="modal-header">
        <h5 class="modal-title" style="color:white;" id="modal_cadastrar_produtoTitle">Cadastrar novo Produto:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário -->
        <form method="POST" action="../valida/valida_cadastro_prod.php">
          <div class="modal-body">
            <div class="form-group">
              <label for="inputAddress">Descrição do Produto:</label>
              <input type="text" name="descricao" class="form-control" id="nome_produto" placeholder="Descrição" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Unidade:</label>
                <select id="inputState" name="unidade" class="form-control" required>
                  <option value="" selected>--Selecione--</option>
                  <option value="Unidade">Unidade</option>
                  <option value="Pacote">Pacote</option>
                  <option value="Caixa">Caixa</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="tipo_produto">Tipo Produto:</label>
                <select id="inputState" name="tipo_produto" class="form-control" required>
                  <option value="" selected>--Selecione--</option>
                  <option value="Biquini">Biquíni</option>
                  <option value="Blusa">Blusa</option>
                  <option value="Body">Body</option>
                  <option value="Calca">Calça</option>
                  <option value="Camisa">Camisa</option>
                  <option value="Camiseta">Camiseta</option>
                  <option value="Cropped">Cropped</option>
                  <option value="Jaqueta">Jaqueta</option>
                  <option value="Maio">Maiô</option>
                  <option value="Regata">Regata</option>
                  <option value="Short">Short</option>
                  <option value="Moletom">Moletom</option>
                  <option value="Diversos">Diversos</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" class="form-control" id="quantidade" required>
              </div>
              <!-- select do código -->
              <div class="form-group col-md-4">
                <label for="usuario">Custo unidade:</label>
                <input type="number" step="0.01" class="form-control" name="valor_unidade" id="valor_unidade" required>
              </div>
              <div class="form-group col-md-4">
                <label for="data">Fornecedor:</label>
                <select class="form-control" name="select_fornecedor" id="select_serv" required>
                  <option value="" selected>Selecione...</option>
                  <?php
                  // Preencha o dropdown com fornecedores
                  while ($dadosFornec = mysqli_fetch_array($resultFornec)) {
                    if (!empty($dadosFornec)) {

                  ?>
                      <option value="<?php echo $dadosFornec['id']; ?>">
                        <?php echo $dadosFornec['id'] . " - " . $dadosFornec['nome']; ?>
                      </option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="data">Código:</label>
                <input class="form-control" id="data_cadastro" value="<?php echo ($dadosProduto['codigo'] + 1); ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck" required>
                <label class="form-check-label" for="gridCheck">
                  Confirmar Cadastro
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="width:15%;" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" style="width:15%; background-color:#e67e00" name="cadastrar" class="btn">
              <div style="color:white">Cadastrar</div>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
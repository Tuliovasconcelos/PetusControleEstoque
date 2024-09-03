<?php
// Obtém o nome do arquivo atual
$pagina = basename($_SERVER['PHP_SELF'], '.php');

?>

<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $pagina == "painel" ? "active" : ""; ?>">
        <a class="nav-link" href="painel.php">
            <i class="fas fa-fw fa-university"></i>
            <span>Painel Principal</span>
        </a>
    </li>
    <li class="nav-item <?php echo $pagina == "lista_fornecedores" ? "active" : ""; ?>">
        <a class="nav-link" href="lista_fornecedores.php">
            <i class="fas fa-fw fa-industry"></i>
            <span>Fornecedores</span>
        </a>
    </li>
    <li class="nav-item <?php echo $pagina == "lista_produtos" ? "active" : ""; ?>">
        <a class="nav-link" href="lista_produtos.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Produtos</span>
        </a>
    </li>
    <li class="nav-item <?php echo $pagina == "lista_estoque" ? "active" : ""; ?>">
        <a class="nav-link" href="lista_estoque.php">
            <i class="fas fa-fw fa-archive"></i>
            <span>Estoque</span>
        </a>
    </li>
    <li class="nav-item dropdown <?php echo (strpos($pagina, 'relatorio') !== false) ? 'active' : ''; ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-book"></i>
            <span>Relatórios</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Opções:</h6>
            <a class="dropdown-item <?php echo $pagina == "relatorio_produtos" ? "active" : ""; ?>" href="relatorio_produtos.php">Produtos</a>
            <a class="dropdown-item <?php echo $pagina == "relatorio_fornecedores" ? "active" : ""; ?>" href="relatorio_fornecedores.php">Fornecedores</a>
            <div class="dropdown-divider"></div>
        </div>
    </li>
    <li class="nav-item">
        <?php include "modais/modal_suporte.php"; ?>
        <a style="cursor:pointer;" class="nav-link" data-toggle="modal" data-target="#modal_suporte">
            <i class="fas fa-fw fa-headset"></i>
            <span>Suporte Online</span>
        </a>
    </li>
</ul>
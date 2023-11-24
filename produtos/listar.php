<?php 
    require_once "../src/funcoes-produtos.php";
    $listaDeProdutos = lerProdutos($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <div class="container">
        <h1>Produtos | SELECT <a href=".../index.php"></a></h1>
        <hr>
        <h2>Lendo e carregando todos os produtos</h2>

        <p><a href="inserir.php" style="color:blue;">Inserir a um novo produto</a></p>
        <hr>
        <div class="produtos">
            <?php foreach($listaDeProdutos as $produto) { ?> 
            
                <article>
                    <!-- <h3><?=$produto['nome']?></h3> -->

                    <h3><?=$produto['produto'] ?></h3>
                    
                    <!-- <p><b>Preço:</b>  R$ <?=number_format($produto['preco'], 2, ',', '.')?></p> -->

                    <p><b>Preço:</b>  <?=formataMoeda($produto['preco'])?></p>

                    <p><b>Quantidade:</b>  <?=$produto['quantidade']?></p>
                    <p><b>Descrição:</b>  <?=$produto['descricao']?></p>
                    <!-- <p><b>Fabricantes:</b> <?=$produto['fabricante_id'] ?></p> -->

                    <p><b>Fabricantes:</b> <?=$produto['fabricantes']?></p>

                    <p>
                        <a href="atualizar.php?id=<?=$produto['id']?>" style ="color: blue;">Atualizar</a>
                        <a class="excluir" href="excluir.php?id=<?=$produto['id']?>" style ="color:red;">Excluir</a>
                    </p>

                    <hr>
                </article>
                <?php } ?>
        </div>

    </div>

    <script src="../js/confirm.js"></script>
    <!-- <p><a href="../index.html">Home</a></p> -->

</body>
</html>
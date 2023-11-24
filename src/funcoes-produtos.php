<?php
    // Incluir neste ponto o arquivo conecta.php 
    require_once "conecta.php";

    // ____________________________________________________
    // Programar a função lerProdutos neste ponto 
    function lerProdutos(PDO $conexao):array {
        // String com o comando SQL para trazer apenas o n° do id (ANTIGO)
        // $sql = "SELECT id, nome, descrição, preco, quantidade, fabricante_id FROM produtos ORDER BY nome ";

        // String com o conteudo SQL para trazer o nome do fabricante (ATUAL - melhor)
        $sql = "SELECT produtos.id,
                    produtos.nome AS produto,
                    produtos.descricao,
                    produtos.preco,
                    produtos.quantidade,
                    fabricantes.nome AS fabricantes
                FROM produtos INNER JOIN fabricantes
                ON produtos.fabricantes_id = fabricantes.id
                ORDER BY produto";

        try {
            // preparação do comando 
            $consulta = $conexao->prepare($sql);

            // Execução do comando 
            $consulta->execute();

            // capturar os resultados
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro){
            die ("Erro" .$erro->getMessage());
        }
        return $resultado;
    }

    // Programar a função inserirProdutos neste ponto 
    function inserirProdutos(PDO $conexao, string $nome, float $preco, int $quantidade, string $descricao, int $fabricanteId):void { //void indica sem retorno
        $sql = "INSERT INTO produtos(nome, preco, quantidade, descricao, fabricantes_id) VALUES(:nome, :preco, :quantidade, :descricao, :fabricantes_id)";

        try {
            // preparacao do conteudo 
            $consulta = $conexao->prepare($sql);

            $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
            $consulta->bindParam(':preco', $preco, PDO::PARAM_STR);
            $consulta->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $consulta->bindParam(':fabricante_id', $fabricanteId, PDO::PARAM_INT);

            // Execucao do comando
            $consulta->execute();
        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
        }
        
    }
    // Programar a função lerUmProduto neste ponto 
    function lerUmProduto(PDO $conexao, int $id):array {
        $sql = "SELECT id, nome, preco, quantidade, descricao, fabricantes_id FROM produtos WHERE id = :id";

        try {
            // preparacao do conteudo
            $consulta = $conexao->prepare($sql);

            $consulta->bindParam(':id', $id, PDO::PARAM_INT);

            // Execucao do comando
            $consulta->execute();

            // capturar os resultados
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
        }
        return $resultado;
    }
    // _______________________________________________________
    // Programar a função atualizarProduto neste ponto 
    function atualizarProdutos(PDO $conexao, int $id, string $nome, float $preco, int $quantidade, string $descricao, int $fabricanteId) {
    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade, descricao = :descricao, fabricantes_id = :fabricantes_id WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);

        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nome', $nome, PDO::PARAM_INT);
        $consulta->bindParam(':preco', $preco, PDO::PARAM_INT);
        $consulta->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $consulta->bindParam(':descricao', $descricao, PDO::PARAM_INT);
        $consulta->bindParam(':fabricante_id', $fabricanteId, PDO::PARAM_INT);

        // Execucao do comando
        $consulta->execute();

    } catch (Exception $erro) {
        die ("Erro" .$erro->getMessage());
    }
}
    // Programar a função excluirProduto neste ponto 
    function excluirProduto(PDO $conexao, int $id):void {
        $sql = "DELETE FROM produtos WHERE id = :id";
        try {
            $consulta = $conexao->prepare($sql);
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die ("Erro" .$erro->getMessage());
        }
    }
    
    /* Funções utilitárias dump e formataMoeda */
    function dump($dados){
        echo "<pre>";
        var_dump($dados);
        echo "<pre>";
    }

    function formataMoeda(float $valor):string {
        return "R$ " .number_format($valor, 2, ",", ".");
    }
    
    
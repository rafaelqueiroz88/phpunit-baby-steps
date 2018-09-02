<?php

namespace CDC\Loja\Produto;

require "./vendor/autoload.php";

use CDC\Loja\Carrinho\CarrinhoDeCompras;
use CDC\Loja\Produto\Produto;
use CDC\Loja\Produto\MaiorEMenor;

use PHPUnit_Framework_TestCase as PHPUnit;

class TestaMaiorEMenor extends PHPUnit
{
    public function testOrdemDecrescente()
    {
        $carrinho = new CarrinhoDeCompras();

        /**
         * O exemplo do livro retorna um erro indicando que a instancia do objeto não corresponde
         * ao que está sendo recebido.
         */
        // $carrinho->adiciona(new Produto("Geladeira", 450.00));
        // $carrinho->adiciona(new Produto("Liquidificador", 250.00));
        // $carrinho->adiciona(new Produto("Jogo de Pratos", 70.00));
        $carrinho->produtos->append(new Produto("Geladeira", 450.00));
        $carrinho->produtos->append(new Produto("Liquidificador", 250.00));
        $carrinho->produtos->append(new Produto("Jogo de Pratos", 70.00));

        $maiorMenor = new MaiorEMenor();
        $maiorMenor->encontra($carrinho);

        /**
         * Verifica se o resultado é igual ao esperado
         */
        $this->assertEquals("Jogo de Pratos", $maiorMenor->getMenor()->getNome());
        $this->assertEquals("Geladeira", $maiorMenor->getMaior()->getNome());

        /**
         * Verifica se é um objeto da instancia esperada
         */
        $this->assertInstanceOf("CDC\Loja\Produto\Produto", $maiorMenor->getMenor());

        /**
         * Verifica se é de fato um objeto ou um resultado do parametro a ser testado
         */
        $this->assertInternalType("object", $maiorMenor->getMenor());
    }

    public function testApenasUmProduto()
    {
        $carrinho = new CarrinhoDeCompras();

        $carrinho->produtos->append(new Produto("Geladeira", 450.00));

        $maiorMenor = new MaiorEMenor();
        $maiorMenor->encontra($carrinho);

        $this->assertEquals("Geladeira", $maiorMenor->getMenor()->getNome());
        $this->assertEquals("Geladeira", $maiorMenor->getMaior()->getNome());
    }
}
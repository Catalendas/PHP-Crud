<?php

namespace App\Db;

class Pagination {

    /**
     * Numero maximo de registro por pagina
     * @var integer
     */
    private $limit;

    /**
     * Quantidade total de resultados do banco
     * @var integer
     */
    private $results;

    /**
     * Quantidade de paginas
     * @var integer
     */
    private $pages;

    /**
     * Pagina atual
     * @var integer
     */
    private $correntPages;

    /**
     * Construtor da classe
     * @param integer
     */
    public function __construct($results, $correntPages = 1, $limit = 10){

        $this->results = $results;
        $this->limit = $limit;
        $this->correntPages = (is_numeric($correntPages) and $correntPages > 0) ? $correntPages : 1;
        $this->calculate();

    }

    /**Método responsavel por calcular a paginação
     *
     */
    private function calculate(){
        // Como calcular o total de paginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        // Ver se  numero atual não ecede o numero de paginas
        $this->correntPages = $this->correntPages <= $this->pages ? $this->correntPages : $this->pages;
    }

    /**
     * Método responsavel por retornar a clausula limit do sql
     * @return string
     */
    public function getLimit(){

        $offset = ($this->limit * ($this->correntPages - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Método responsavel por retornar as opções de paginas disponiveis
     * @return array
     */
    public function getPages() {

        // não retorna paginas
        if($this->pages == 1) return [];

        // paginas
        $paginas = [];
        for($i = 1; $i <= $this->pages; $i++){
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->correntPages
            ];
        }
        return $paginas;
    }

}
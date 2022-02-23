<?php 

namespace App\Entity;
use App\Db\Database;
use \PDO;


 class Vaga {
     
     /**
     *Identificador unico da vaga
     *@var integer
     */
    public $id;

    /** 
     *Titulo da vaga
     *@var string
     */   
    public $title;

    /**
     * Descrição da vaga (Pode conter HTML)
     * @var string
     */
    public $descripition;

    /**
     * Define se avaga ativa
     * @var string(s/n)
     */
    public $acttive;

    /**
     * Data de publicação da vaga
     * @var string
     */
    public $data;
    /**
     * Metodos responsavel por cadastrar a nova vaga no banco
     * @return boolean
     */ 
    public function cadastrar() {
        // Definir data 
        $this->data = date('Y-m-d H:i:s');

        // Inserir a vaga no banco
        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
            'title'         => $this->title,
            'descripition'  => $this->descripition,
            'acttive'       => $this->acttive,
            'dia'           => $this->data
        ]);
        
        // Retornar sucesso
        return true;
    }

    /**
     * Método responsavel po atulizar a vaga no banco
     * @return boolean
     */
    public function atuliazar(){
        return(new Database('vagas'))->update('id ='.$this->id,[
            'title'         => $this->title,
            'descripition'  => $this->descripition,
            'acttive'       => $this->acttive,
            'dia'           => $this->data
        ]);
    }

    /**
     * Método responsavel por fazer a exclusão a vaga do banco
     * @return boolean
     */
    public function excluir() {
        return(new Database('vagas'))->delete('id = '.$this->id);
    }
 
    /**
     * Metodo responsavel por pegar as vagas no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function  getVagas($where = null, $order = null, $limit = null) {

        return(new Database('vagas'))->select($where,$order,$limit)
                                ->fetchAll(PDO::FETCH_CLASS, self::class);

    }

    /**
     * Método responsavel por buscar uma vaga com base em seu id
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id) {
        return(new Database('vagas'))->select('id = '.$id)
                        ->fetchObject(self::class);
    }

}

        

                                                 
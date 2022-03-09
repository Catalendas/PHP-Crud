<?php

    namespace App\Entity;

    use App\Db\Database;

    use \PDO;

    class Usuario{

        /**
         * Identificador unico do usuario
         * @var integer
         */
        public $id;

        /**
         * Nome do usuario
         * @var string
         */
        public $nome;

        /**
         * Email do usuario
         * @var string
         */
        public $email;

        /**
         * Hash da senha do usuario
         * @var string
         */
        public $senha;


        /**
         * Método resposavel por cadastrar o usuario no banco
         * @return boolean
         */
        public function cadastrar(){

            $obDatabase = new Database('usuarios');

            // Inseri um novo usuario
            $this->id = $obDatabase->insert([
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'senha' => $this->senha

            ]);

            // sucesso
            return true;

        }


        /**
         * Método responsavel por retornar uma instancia de usuario com base no seu email
         * @param string
         * @return Usuario
         */
        public static function getUsuarioPorEmail($email) {
            return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
        }

    }
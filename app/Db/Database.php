<?php

    namespace App\Db;

    use \PDO;
    use \PDOException;

    class Database {
        /**
         * Host de conexão com o banco de dados
         * @var string
         */
        const HOST = 'localhost';
        /**
         * Nome no banco de dados
         * @var string
         */
        const NAME = 'dev_empregos';
        /**
         * Usuario do banco de dados
         * @var string
         */
        const USER = 'root';
        /**
         * Senha do banco de dados
         * @var string
         */
        const PASS = '12345';
        /**
         * Nome da tabela a ser manipulado
         * @var string
         */
        private $table;
        /**
         * Instancia de conexão com banco de dados
         * @var PDO
         */
        private $connection;
        /**
         * Define a tabela e instancia com a conexão
         * @var string
         */
        public function __construct($table = null) {
            $this->table = $table;
            $this->setConnection();
        }

        /**
         * Métodos responsavel pela conexão com o banco de dados
         */
        private function setConnection() {
            try {
                $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Error:' .$e->getMessage());
            }
        }
        /**
         * Método responsavel por executar queries dentro do banco de dados
         * @param string
         * @param array
         * @return PDOStatment
         */
        public function execute($query, $params = []) {

            try{
                $statemen = $this->connection->prepare($query);
                $statemen->execute($params);
                return $statemen;
            }catch (PDOException $e) {
                die('Error:' .$e->getMessage());
            }    
        }

        /**
         * Metodo reponsavel por inserir dados no banco
         * @param array $values [field value]
         * @return integer ID inserido
         */
        public function insert($values) {
            // Dados da Query
            $fields = array_keys($values); 
            $binds = array_pad([], count($fields), '?');

               
            // Monta a Query
            $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

            // Executa o insert
            $this->execute($query,array_values($values));

            // Retorna o id Inserido
            return $this->connection->lastInsertId();
        }

        /**
         * Método responsavel por executar uma consulta no b anco 
         * @param string $where
         * @param string $order
         * @param string $limit
         * @param string $fields
         * @return PDOStament
         */
        public function select($where = null, $order = null, $limit = null, $fields = '*') {
            // Dados da query
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';

            // Monta a query
            $query = ' SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

            return $this->execute($query);
        }

        /**
         * Método responsavel por executar atulização no banco de dados
         * @param string $where
         * @param array $values [ field = >value ]
         * @return boolean
         */
        public function update($where, $values) {
            // Dados da query
            $fields = array_keys($values);

            // Monta a query
            $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
            
            // Executar a query
            $this->execute($query, array_values($values));

            // Return sucesso
            return true;

        }

        /**
         * Método responsavel por deletar do banco
         * @param string $where
         * @return boolean
         */
        public function delete($where) {
            // Monta a querye
            $query = 'DELETE FROM '.$this->table.' WHERE '.$where; 

            // Executa a querye
            $this->execute($query);

            // Retorna sucesso
            return true;
        }

    }
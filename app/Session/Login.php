<?php

namespace App\Session;

class Login{


    /**
     * Método responsavel por iniciar a sessão
     * 
     */
    private static function init(){
        // Verifica status da sessão
        if(session_status() !== PHP_SESSION_ACTIVE){
            // Inicia a sessão
            session_start();
        }
    }

    /**
     * Metodo responsavel por retornar os dados do usuario logado
     * @return Array
     */
    public static function getUsuarioLogado() {

          // Inicia a sessão
          self::init();

        //   Retorna dado do usuario
          return self::isLoged() ? $_SESSION['usuario'] : null;

    }

    /**
     * Método reponsavel por logar o usuario
     * @param Usuario
     */
    public static function login($obUsuario) {
        // Inicia a sessão
        self::init();

        // Sessão do usuario
        $_SESSION['usuario'] = [

            'id' =>$obUsuario->id,
            'name' =>$obUsuario->nome,
            'email' =>$obUsuario->email

        ];

        // Redireciona o usuario para index
        header('Location: index.php');
        exit;
    }

    /** 
     * Metodo responsavel por deslogar o usuario
     * 
     */
    public static function logout(){

        // Inicia a sessão
        self::init();

        // Remove a seção do usuario
        unset($_SESSION['usuario']);

         // Redireciona o usuario para index
         header('Location: index.php');
         exit;

    }


    /**
     * Método responsavel por verificar se o usuário está logado
     * @return boolean
     */
    public static function isLoged() {
        // Inicia a sessão
        self::init();

        // Validação da sessão
        return isset($_SESSION['usuario']['id']);

    }

    /**
     * Método responsavel por obrigar o usuario a estar logado
     * @return
     */
    public static function requireLogin(){

        if(!self::isLoged()){

            header('Location: login.php');
            exit;

        }
    }    

    /**
    * Método responsavel por obrigar o usuario a estar deslogado
    * @return
    */
    public static function requireLogout(){

        if(self::isLoged()){

            header('Location: index.php');
            exit;

        }    

    } 

       
}
<?php

/**
 * Class de connexion à la BDD
 */
class Database {

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost:3306;dbname=banque", 'root', '');
        $this->app=new App();
    }

    /**
     * Get informations from Db
     *
     * @param string $statement
     * @param boolean $one
     */
    public function query ($statement, $one=false)
    {
        try {
            $state = $this->pdo->query($statement, PDO::FETCH_OBJ);
            
            if ($one) {   
                $data = $state->fetch();
            } else {
                $data = $state->fetchAll();
            }

            $this->app->sendData("Informations récupérées", true, $data);
        } catch (\Throwable $th) {
            $this->app->sendData(" Erreur lors de la récupération des informations");
           
        }
    }

    /**
     * Get informations from Db
     *
     * @param string $statement
     * @param boolean $one
     */
    public function queryReturn ($statement, $one=false)
    {
        try {
            $state = $this->pdo->query($statement, PDO::FETCH_OBJ);
            
            if ($one) {   
                $data = $state->fetch();
            } else {
                $data = $state->fetchAll();
            }

            return $data;
        } catch (\Throwable $th) {
            $this->app->sendData(" Erreur lors de la récupération des informations");
           
        }
    }

    /**
     * Save data in Db
     *
     * @param string $statement
     * @param string $action
     * @param array $param
     */
    public function prepare($statement, $action, $param = array()){
        try {
            $state = $this->pdo->prepare($statement);

            $state->execute($param);

            if ($action === "save") {
                $message = "Données enregistrées";
            } elseif ($action === "delete"){
                $message = "Données supprimées";
            } elseif ($action === "put"){
                $message = "Données modifiées";
            }

            $this->app->sendData($message, true);
        } catch (\Throwable $th) {
            $this->app->sendData(" Erreur lors de l'enregistrement");
        }
    }
}
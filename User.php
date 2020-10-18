<?php

require "General.php";

use Firebase\JWT\JWT;

class User extends General {

    protected $table = "user";

    /**
     * Save client
     *
     * @param array $param
     * @return void
     */
    public function save($param){
        $statement = "INSERT INTO user (email, password)
                        VALUES (:email, :password)";
        
        $param["email"]= htmlspecialchars($param["email"]);
        $param["password"]= password_hash($param["password"], PASSWORD_DEFAULT);

        $this->db->prepare($statement, 'save', $param);
    }

    public function connexion ($param){
        $statement = "SELECT * FROM user WHERE email='".$param["email"]."'";
        $user = $this->db->queryReturn($statement, true);
        if (password_verify($param["password"], $user->password)) {
            $key = "demo";
            $payload = array(
                "exp" => time() * 600,
                "email" => $user->email,
            );

            $jwt = JWT::encode($payload, $key);
            $this->app->sendData("connexion réussie", true, $jwt);
        }

    }
}
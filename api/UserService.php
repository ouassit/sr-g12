<?php

use Firebase\JWT\JWT;

require_once 'User.php';

class UserService {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function auth($username, $password) {
        $query = "SELECT id, full_name, username, password FROM users where username='$username' and password='$password'";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $user = $result->fetch_object("User");
            $key = "ABCDEFGH";
            $payload = array(
                "sub" => $user->id,
                "name" => $user->username,
                "iat" => round(microtime(true) * 1000)
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            $user->jwt = $jwt;
            return $user;
        } else {
            return NULL;
        }        

    }

}

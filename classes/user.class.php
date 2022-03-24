<?php
class User {
    protected $Conn;

    public function __construct($Conn){
        $this->Conn = $Conn;
    }

    public function updateUser($user_data, $session_data){
        $query = "SELECT * FROM users WHERE user_email = :user_email AND user_id != :user_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            'user_email' => $user_data['email'],
            'user_id' => $session_data['user_id']
        ));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result){
            return;
        }
        $sec_password = password_hash($user_data['password'], PASSWORD_DEFAULT);
        $query = "UPDATE users SET first_name=?, last_name = ?, user_email=?, user_pass=? WHERE user_id=?";
        $stmt = $this->Conn->prepare($query);
        $stmt->bindParam(1, $user_data["first_name"], PDO::PARAM_STR);
        $stmt->bindParam(2, $user_data["last_name"], PDO::PARAM_STR);
        $stmt->bindParam(3, $user_data["email"], PDO::PARAM_STR);
        $stmt->bindParam(4, $sec_password, PDO::PARAM_STR);
        $stmt->bindParam(5, $session_data['user_id'], PDO::PARAM_STR);
        $stmt->execute();
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            'user_id' => $session_data['user_id']
        ));
        $attempt = $stmt->fetch();
        return $attempt;
    }

    public function createUser($user_data){
        $query = "SELECT * FROM users WHERE user_email = :user_email";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            'user_email' => $user_data['email']
        ));
        // if the user already exists exit function
        if ($stmt->fetch()){
            return;
        }
        $sec_password = password_hash($user_data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO users (first_name, last_name, user_email, user_pass) VALUES (:first_name, :last_name, :user_email, :user_pass)";
        $stmt = $this->Conn->prepare($query);
        return $stmt->execute(array(
            'user_email' => $user_data['email'],
            'first_name' => ucfirst($user_data['first_name']),
            'last_name' => ucfirst($user_data['last_name']),
            'user_pass' => $sec_password
        ));
    }
    
    public function loginUser($user_data) {
        $query = "SELECT * FROM users WHERE user_email = :user_email";
        $stmt = $this->Conn->prepare($query);
        $stmt->execute(array(
            'user_email' => $user_data['email']
        ));
        $attempt = $stmt->fetch();
        if($attempt && password_verify($user_data['password'], $attempt['user_pass'])) {
            return $attempt;
        }else{
            return false;
        }
    }
}

<?php

namespace Models;

class User extends Model
{
    protected $table = "users";

    public function insertUser($lname, $fname, $email, $password, $adress, $city, $zip_code)
    {
        $stmt1 = $this->pdo->prepare("INSERT INTO {$this->table} (lname, fname, email, password, adress, city, zip_code, id_role)
                                    VALUES (:lname, :fname, :email, :password, :adress, :city, :zip_code, 2)");
        $stmt1->bindParam(":lname", $lname);
        $stmt1->bindParam(":fname", $fname);
        $stmt1->bindParam(":email", $email);
        $stmt1->bindParam(":password", $password);
        $stmt1->bindParam(":adress", $adress);
        $stmt1->bindParam(":city", $city);
        $stmt1->bindParam(":zip_code", $zip_code);
        $stmt1->execute();
        if (!isset($_SESSION)) {
            session_start();
        }
        $id = $this->pdo->lastInsertId();
        $_SESSION['is_logged'] = $id;
        $_SESSION['is_admin'] = 'user';
    }

    public function loginUser($email, $password)
    {
        $stmt1 = $this->pdo->prepare("SELECT * from {$this->table} WHERE email = :email");

        $stmt1->bindParam(":email", $email);

        $stmt1->execute();

        $user = $stmt1->fetchAll();

        if (isset($user[0]) && $user[0]["password"] == password_verify($password, $user[0]["password"]) && $user[0]["email"] == $email) {
            session_start();
            $_SESSION['is_logged'] = $user[0]['id_user'];
            $_SESSION['is_admin'] = $user[0]['id_role'];

            echo json_encode("success");
        } else {
            echo json_encode("L'email et le mot de passe ne correspondent pas");
        }
    }

    public function getInfoUser()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_user = :id_user");
        $stmt1->bindParam(":id_user", $_SESSION['is_logged']);
        $stmt1->execute();

        $user = $stmt1->fetchAll();

        return $user;
    }

    public function getAllUser()
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table} LEFT JOIN role ON users.id_role = role.id_role");
        $stmt1->execute();

        $users = $stmt1->fetchAll();

        return $users;
    }

    public function delete($id)
    {
        $stmt1 = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id_user = :id_user");
        $stmt1->bindParam(":id_user", $id);
        $stmt1->execute();
    }

    public function getUser($id)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_user = :id_user");
        $stmt1->bindParam(":id_user", $id);
        $stmt1->execute();

        $user = $stmt1->fetch();

        return $user;
    }

    public function edit($lname, $fname, $email, $adress, $city, $zip_code, $id)
    {
        $stmt1 = $this->pdo->prepare("UPDATE {$this->table} SET lname = :lname, fname = :fname, email = :email, adress = :adress, city = :city, zip_code = :zip_code WHERE id_user = :id_user");

        $stmt1->bindParam(":lname", $lname);
        $stmt1->bindParam(":fname", $fname);
        $stmt1->bindParam(":email", $email);
        $stmt1->bindParam(":adress", $adress);
        $stmt1->bindParam(":city", $city);
        $stmt1->bindParam(":zip_code", $zip_code);
        $stmt1->bindParam(":id_user", $id);

        $stmt1->execute();
    }

    public function createUser($lname, $fname, $email, $password, $adress, $city, $zip_code, $role)
    {
        $stmt1 = $this->pdo->prepare("INSERT INTO {$this->table} (lname, fname, email, password, adress, city, zip_code, id_role)
                                    VALUES (:lname, :fname, :email, :password, :adress, :city, :zip_code, :role)");
        $stmt1->bindParam(":lname", $lname);
        $stmt1->bindParam(":fname", $fname);
        $stmt1->bindParam(":email", $email);
        $stmt1->bindParam(":password", $password);
        $stmt1->bindParam(":adress", $adress);
        $stmt1->bindParam(":city", $city);
        $stmt1->bindParam(":zip_code", $zip_code);
        $stmt1->bindParam(":role", $role);
        $stmt1->execute();
    }
}

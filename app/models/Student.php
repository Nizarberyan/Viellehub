<?php
require_once 'BaseModel.php';

class Student extends BaseModel
{

    public function CreateUser($email, $password, $first_name, $last_name, $role, $status)
    {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->role = $role;
        $this->status = $status = 'pending';
        try {
            $sql = "INSERT INTO users (email, password, first_name, last_name, role, status) VALUES (:email, :password, :first_name, :last_name, :role, :status)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name', $this->last_name);
            $stmt->bindParam(':role', $this->role);
            $stmt->bindParam(':status', $this->status);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function UpdateUser($id, $email, $password, $first_name, $last_name, $role, $status)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->role = $role;
        $this->status = $status;
        try {
            $sql = "UPDATE users SET email = :email, password = :password, first_name = :first_name, last_name = :last_name, role = :role, status = :status WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name', $this->last_name);
            $stmt->bindParam(':role', $this->role);
            $stmt->bindParam(':status', $this->status);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function DeleteUser($id)
    {
        $this->id = $id;
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetUser($id)
    {
        $this->id = $id;
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetUsers()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


}
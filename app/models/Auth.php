<?php
require_once '../core/Database.php';

class Auth
{
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->connection;
    }

    public function CreateUser($email, $password, $first_name, $last_name, $role, $status = 'pending')
    {

        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            $_SESSION['error'] = "All fields are required.";
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format.";
            return false;
        }

        if ($this->emailExists($email)) {
            $_SESSION['error'] = "Email already registered.";
            return false;
        }


        if (strlen($password) < 8) {
            $_SESSION['error'] = "Password must be at least 8 characters long.";
            return false;
        }

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (email, password, first_name, last_name, role, status) VALUES (:email, :password, :first_name, :last_name, :role, :status)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Log error
            error_log('User creation error: ' . $e->getMessage());
            $_SESSION['error'] = "Registration failed. Please try again.";
            return false;
        }
    }

    public function Login($email, $password)
    {
        // Input validation
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email and password are required.";
            return false;
        }

        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {

                if ($user['status'] !== 'active') {
                    echo $_SESSION['error'] = "Your account is not active. Please contact support.";
                    return false;
                }


                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];

                return true;
            } else {
                $_SESSION['error'] = "Invalid email or password.";
                return false;
            }
        } catch (PDOException $e) {
            // Log error
            error_log('Login error: ' . $e->getMessage());
            $_SESSION['error'] = "Login failed. Please try again.";
            return false;
        }
    }

    public function Logout()
    {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        return true;
    }

    private function emailExists($email)
    {
        try {
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log('Email check error: ' . $e->getMessage());
            return false;
        }
    }
}


session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['method']) && $_GET['method'] == 'register') {
   
    if (!isset($_POST['terms'])) {
        $_SESSION['error'] = "You must agree to the Terms and Conditions.";
        header('Location: ../views/auth/register.php');
        exit();
    }


    if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: ../views/auth/register.php');
        exit();
    }

    $auth = new Auth();
    $result = $auth->CreateUser(
        $_POST['email'],
        $_POST['password'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['role']
    );

    if ($result) {
        unset($_SESSION['error']);
        
        $_SESSION['success'] = "Registration successful. Please log in.";
        header('Location: ../views/auth/login.php');
        exit();
    } else {
        header('Location: ../views/auth/register.php');
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['method']) && $_GET['method'] == 'login') {
    $auth = new Auth();
    $result = $auth->Login($_POST['email'], $_POST['password']);

    if ($result) {
        unset($_SESSION['error']);

        switch ($_SESSION['user_role']) {
            case 'student':
                header('Location: ../views/subjects/list.php');
                break;
            case 'teacher':
                header('Location: ../views/subjects/manage.php');
                break;
            default:
                header('Location: ../views/dashboard.php');
        }
        exit();
    } else {
        die (var_dump($_SESSION['error']));

        header('Location: ../views/auth/login.php');
        exit();
    }
}


if (isset($_GET['method']) && $_GET['method'] == 'logout') {
    $auth = new Auth();
    $auth->Logout();
    header('Location: ../views/auth/login.php');
    exit();
}
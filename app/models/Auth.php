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
        session_start();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../views/auth/register.php');
            exit();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $role = $_POST['role'] ?? '';
        $status = 'pending';

        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            $_SESSION['error'] = "All fields are required.";
            header('Location: ../views/auth/register.php');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format.";
            header('Location: ../views/auth/register.php');
            exit();
        }

        if ($this->emailExists($email)) {
            $_SESSION['error'] = "Email already registered.";
            header('Location: ../views/auth/register.php');
            exit();
        }

        if (strlen($password) < 8) {
            $_SESSION['error'] = "Password must be at least 8 characters long.";
            header('Location: ../views/auth/register.php');
            exit();
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

            unset($_SESSION['error']);
            $_SESSION['success'] = "Registration successful. Please log in.";
            header('Location: ../views/auth/login.php');
            exit();
        } catch (PDOException $e) {
            error_log('User creation error: ' . $e->getMessage());
            $_SESSION['error'] = "Registration failed. Please try again.";
            header('Location: ../views/auth/register.php');
            exit();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../views/auth/login.php');
            exit();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email and password are required.";
            header('Location: ../views/auth/login.php');
            exit();
        }

        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                if ($user['status'] !== 'active') {
                    $_SESSION['error'] = "Your account is not active. Please contact support.";
                    header('Location: ../views/auth/login.php');
                    exit();
                }

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];

                unset($_SESSION['error']);

                switch ($user['role']) {
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
                $_SESSION['error'] = "Invalid email or password.";
                header('Location: ../views/auth/login.php');
                exit();
            }
        } catch (PDOException $e) {
            error_log('Login error: ' . $e->getMessage());
            $_SESSION['error'] = "Login failed. Please try again.";
            header('Location: ../views/auth/login.php');
            exit();
        }
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        header('Location: ../views/auth/login.php');
        exit();
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



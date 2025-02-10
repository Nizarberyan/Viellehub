<?php
require_once '../core/Database.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';


class subject
{
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->connection;
    }
public function CreateSubject(): void
{
    $this->title = $_POST['title'] ?? '';
    $this->description = $_POST['description'] ?? '';
    $this->suggested_by = $_SESSION['user_id'] ?? '';
    $this->resources = $_POST['resources'] ?? '';
    $this->status = 'pending';
    try {
        $sql = "INSERT INTO subjects (title, description, suggested_by, status, resources) VALUES (:title, :description, :suggested_by, :status, :resources)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':suggested_by', $this->suggested_by);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':resources', $this->resources);
        $stmt->execute();
        header('Location: ../views/subjects/list.php');


        $sql = "SELECT email FROM users";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $sql = "SELECT CONCAT(first_name, ' ', last_name) AS creator_full_name FROM users WHERE id = :suggested_by";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':suggested_by', $this->suggested_by);
        $stmt->execute();
        $creator_full_name = $stmt->fetchColumn();


        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.eu.mailgun.org';
        $mail->SMTPAuth = true;
        $mail->Username = 'VeilleHub@nizarberiane.me';
        $mail->Password = 'Nizar2005nizar#';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('nizarberiane5@nizarberiane.me', 'Mailer');
        $mail->addReplyTo('nizarberiane5@nizarberiane.me', 'Information');
        $mail->isHTML(true);
        $mail->Subject = 'New Subject Created';

        $mailBody = '
            <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                <h2 style="color: #4CAF50;">A New Subject Has Been Created!</h2>
                <p>Dear User,</p>
                <p>We are excited to inform you that a new subject has been created in our system. Here are the details:</p>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><strong>Title:</strong></td>
                        <td style="padding: 8px; border: 1px solid #ddd;">' . $this->title . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><strong>Description:</strong></td>
                        <td style="padding: 8px; border: 1px solid #ddd;">' . $this->description . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><strong>Suggested By:</strong></td>
                        <td style="padding: 8px; border: 1px solid #ddd;">' . $creator_full_name . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;"><strong>Status:</strong></td>
                        <td style="padding: 8px; border: 1px solid #ddd;">' . $this->status . '</td>
                    </tr>
                </table>
                <p>Thank you for your attention.</p>
                <p>Best regards,<br>Subject Suggestion System</p>
            </div>
        ';

        $mail->Body = $mailBody;
        $mail->AltBody = 'A new subject has been created: ' . $this->title;

        foreach ($emails as $email) {
            $mail->addAddress($email);
            try {
                $mail->send();
            } catch (Exception $e) {
                die("Error: " . $e->getMessage());
            }
            $mail->clearAddresses();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
    public function renderSubjects()
{
    try {
        $sql = "SELECT s.*, 
                   u.first_name, 
                   u.last_name, 
                   CONCAT(u.first_name, ' ', u.last_name) AS creator_full_name
            FROM subjects s
            LEFT JOIN users u ON s.suggested_by = u.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
}
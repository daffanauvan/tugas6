<?php
// Koneksi ke database
$host = 'localhost';
$db = 'basicweb';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
  die('Connection failed: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];

  // Menyimpan data ke database
  $query = "INSERT INTO items (title, description) VALUES (:title, :description)";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['title' => $title, 'description' => $description]);

  // Mengirim respons dalam format JSON
  echo json_encode(['success' => true]);
}
<?php

session_start();

require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;

// Firebase Admin SDK
$factory = (new Factory)->withServiceAccount($_ENV['SERVICEACCOUNT']);
$auth = $factory->createAuth();

$input = json_decode(file_get_contents('php://input'), true);
$idToken = $input['idToken'] ?? '';

try {
    $verifiedToken = $auth->verifyIdToken($idToken);
    $uid = $verifiedToken->claims()->get('sub');
    $_SESSION['user_id'] = $uid;

    echo json_encode(['success' => true]);
} catch (InvalidToken $e) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid token']);
}

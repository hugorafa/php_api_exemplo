<?php

header("Content-Type: application/json");

// Arquivo JSON que simula um banco de dados
const DB_FILE = "db.json";

// Carrega dados do "banco"
function loadData() {
    return file_exists(DB_FILE) ? json_decode(file_get_contents(DB_FILE), true) : [];
}

// Salva dados no "banco"
function saveData($data) {
    file_put_contents(DB_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

// Obtém a requisição
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Obtém a posição do script para ajustar a rota
$scriptName = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
$apiPath = array_slice($requestUri, count($scriptName));

// Carrega os dados atuais
$data = loadData();

// Rotas para gerenciar "usuários"
if ($method == 'GET' && count($apiPath) == 1 && $apiPath[0] == 'users') {
    echo json_encode($data);
} elseif ($method == 'POST' && count($apiPath) == 1 && $apiPath[0] == 'users') {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = uniqid();
    $data[$id] = $input;
    saveData($data);
    echo json_encode(["message" => "Usuário criado", "id" => $id]);
} elseif ($method == 'GET' && count($apiPath) == 2 && $apiPath[0] == 'users') {
    $id = $apiPath[1];
    echo isset($data[$id]) ? json_encode($data[$id]) : json_encode(["error" => "Usuário não encontrado"]);
} elseif ($method == 'PUT' && count($apiPath) == 2 && $apiPath[0] == 'users') {
    $id = $apiPath[1];
    if (isset($data[$id])) {
        $input = json_decode(file_get_contents("php://input"), true);
        $data[$id] = $input;
        saveData($data);
        echo json_encode(["message" => "Usuário atualizado"]);
    } else {
        echo json_encode(["error" => "Usuário não encontrado"]);
    }
} elseif ($method == 'DELETE' && count($apiPath) == 2 && $apiPath[0] == 'users') {
    $id = $apiPath[1];
    if (isset($data[$id])) {
        unset($data[$id]);
        saveData($data);
        echo json_encode(["message" => "Usuário deletado"]);
    } else {
        echo json_encode(["error" => "Usuário não encontrado"]);
    }
} else {
    echo json_encode(["error" => "Rota não encontrada"]);
}

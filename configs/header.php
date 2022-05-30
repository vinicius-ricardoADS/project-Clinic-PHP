<?php

// Alguns headers usado para declarar que a resposta será um JSON!
header("Access-Control-Max-Age: 3600");
// Coloque aqui os comandos que deseja que sejam aceitos...
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// Esse comando em geral é inválido, mas alguns clientes (como Angular) necessitam dele.
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

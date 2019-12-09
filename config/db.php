<?php

$host = $username = $password = $dbname = '';
$url = parse_url(getenv("DATABASE_URL"));
if (isset($url["host"]) && isset($url["user"]) && isset($url["pass"]) && isset($url["path"])) {
    $host = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $dbname = substr($url["path"], 1);
} else {
    $host = "127.0.0.1";
    $username = "postgres";
    $password = "password";
    $dbname = "sipk_kaprodi";
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host={$host};port=5432;dbname={$dbname}",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

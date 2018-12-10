<?
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/constants.php';
    require_once PATH_CORE . 'classes/safemysql.class.php';
    require_once PATH_CORE . 'functions/func.php';

    $opts = [
        'user'    => DB_USER,
        'pass'    => DB_PASS,
        'db'      => DB_NAME,
        'charset' => 'utf8'
    ];

    $db = new SafeMySQL($opts);


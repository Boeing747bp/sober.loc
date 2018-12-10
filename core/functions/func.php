<?
function __autoload($className) {
    $filename = $className . '.php';

    // определяем класс и находим для него путь

    $expArr = explode('_', $className);
    $switcher = strpos($expArr[0], 'Model') !== false ? 'Model' : false;
    if(empty($switcher))
    {
        $switcher = strpos($expArr[0], 'Controller') != false  ? 'Controller' : false;
    }

    if(empty($switcher) || (isset($expArr[1]) && $expArr[1] == 'Base'))
    {
        $folder = 'classes';
    }
    else
    {
        switch($switcher)
        {
            case 'Controller':
                $folder = 'src/Controllers';
                break;

            case 'Model':
                $folder = 'src/Models';
                break;

            default:
                $folder = 'classes';
                break;
        }
    }
    // путь до класса
    $file = PATH_CORE . $folder . DS . $filename;

    // проверяем наличие файла
    if (file_exists($file) == false) {
        return false;
    }
    // подключаем файл с классом
    include ($file);
}
function pr($o, $die = false) {
    $bt =  debug_backtrace();
    $bt = $bt[0];
    $dRoot = $_SERVER["DOCUMENT_ROOT"];
    $dRoot = str_replace("/","\\",$dRoot);
    $bt["file"] = str_replace($dRoot,"",$bt["file"]);
    $dRoot = str_replace("\\","/",$dRoot);
    $bt["file"] = str_replace($dRoot,"",$bt["file"]);
    ?>
    <div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;'>
        <div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
        <pre style='padding:10px;'><?print_r($o)?></pre>
    </div>
    <?

    if($die){
        die();
    }
}

function mix(){

}
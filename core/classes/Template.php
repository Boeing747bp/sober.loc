<?php
// класс для подключения шаблонов и передачи данных в отображение
Class Template {

    private $template;
    private $controller;
    private $layouts;
    private $vars = array();

    function __construct($layouts, $controllerName) {
        $this->layouts = $layouts;
        $this->controller = str_replace('Controller', '', $controllerName);
    }

    // установка переменных, для отображения
    public function vars($varname, $value) {
        if (isset($this->vars[$varname]) == true) {
            trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
            return false;
        }

        $this->vars[$varname] = $value;
        return true;
    }

    // отображение
    public function view($name, $is_ajax = false) {
        $pathLayout  = PATH_SRC . 'Views' . DS . 'Layouts' . DS . $this->layouts . '.php';
        $contentPage = PATH_SRC . 'Views' .  DS . $name . '.php';

        if (file_exists($pathLayout) == false && $is_ajax == false){
            trigger_error ('Layout `' . $this->layouts . '` does not exist.', E_USER_NOTICE);
            return false;
        }

        if (file_exists($contentPage) == false)
        {
            trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
            return false;
        }

        $arResult = $this->vars;

        if($is_ajax == false){
            include ($pathLayout);
        }
        else{
            include ($contentPage);
        }
    }
}
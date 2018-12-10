<?
    Class IndexController Extends Controller_Base
    {
        public $layouts = "main";

        public function index()
        {

            $this->template->view('index');
        }
    }
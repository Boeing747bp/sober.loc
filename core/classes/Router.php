<?  class Router
    {
        private $path;
        private $controller;
        private $action;
        private $file;

        public function setPath($path)
        {
            $path = trim($path, '/\\');
            $path = DS . $path . DS;
            $path = str_replace('//', '/', $path);

            // если путь не существует, сигнализируем об этом
            if (is_dir($path) == false) {
                throw new Exception ('Invalid controller path: `' . $path . '`');
            }

            $this->path = $path;
        }

        public function start() {
            // Анализируем путь

            $this->getController();

            // Проверка существования файла, иначе 404
            if (is_readable($this->file) == false) {
                die ('404 Not Found');
            }

            // Подключаем файл
            require_once ($this->file);

            // Создаём экземпляр контроллера
            $class =  $this->controller;


            $ct = new $class();

            $action = $this->action;

            // Если экшен не существует - 404

            if (is_callable(array($ct, $action)) == false) {
                die ('404 Not Found');
            }

            // Выполняем экшен
            $ct->$action();
        }

        private function getController()
        {
            $route = (empty($_REQUEST['route'])) ? 'Index' : trim(htmlspecialchars($_REQUEST['route']));

            // Получаем части урла
            $route = trim($route, '/\\');
            $parts = explode('/', $route);


            $controller = isset($parts[0]) && !empty($parts[0]) ? trim($parts[0]) : 'Index';
            $action = isset($parts[1]) && !empty($parts[1]) ? trim($parts[1]) : 'index';


            $this->controller = $controller . 'Controller';
            $this->action = $action;

            // файл
            $this->file = PATH_SRC . 'Controllers' . DS . ucfirst($this->controller) . '.php';

            if(!file_exists($this->file))
            {
                die('Не найден файл контроллера! ' . $this->file);
            }
        }
    }
<?php

namespace core;

class Core
{
    public $defaultlayoutPath = 'views/layouts/index.php';
    public $moduleName;
    public $actionName;
    public $route;
    public $template;
    public $db;
    public Controller $controllerObject;
    public static $instance;
    public $session;

    private function __construct()
    {

        $this->template = new Template($this->defaultlayoutPath);
        $host = Config::get()->dbHost;
        $name = Config::get()->dbName;
        $login = Config::get()->dbLogin;
        $password = Config::get()->dbPassword;
        $this->db = new DB($host, $name, $login, $password);
        $this->session = new Session();
        session_start();
    }

    public function run($route)
    {
        $this->route = new \core\Router($route);
        $params = $this->route->run();
        if (!empty($params))
            $this->template->SetParams($params);
    }

    public function done()
    {
        $this->template->display();
        $this->route->done();
    }

    public static function get()
    {
        if (empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

}
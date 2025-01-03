<?php

namespace core;

class Controller
{
    protected $template;
    protected $errorMessages;
    protected $successMessages;
    public $isPost = false;
    public $isGet = false;
    public $post;
    public $get;
    public function __construct()
    {
        $action = Core::get()->actionName;
        $module = Core::get()->moduleName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);
        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                $this->isPost = true;
            case 'GET':
                $this->isGet = true;
                break;
        }
        $this->post = new Post();
        $this->get = new Get();
        $this->errorMessages =[];
        $this->successMessages = [];
    }
    public function render($pathToView = null, $params = []): array
    {
        if (!empty($pathToView)) {
            $this->template->setTemplateFilePath($pathToView);
        }
        foreach ($params as $key => $value) {
            $this->template->setParam($key, $value);
        }
        return [
            'Content' => $this->template->getHTML()
        ];
    }

    public function redirect($path):void
    {
        header("Location:{$path}");
        die;
    }
    public function addErrorMessage($message = null):void
    {
        $this->errorMessages [] = $message;
        $this->template->setParam('error_message',implode('<br/>',$this->errorMessages));
    }
    public function isErrorMessageExists():bool
    {
        return count($this->errorMessages)>0;
    }

}
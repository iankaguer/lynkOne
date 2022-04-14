<?php

namespace Router;

use Model\__Model;

class Route{
    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }
	
	/**
	 * @param string $url
	 * @return bool
	 * @desc check if url matches path
	 */
    public function matches(string $url): bool
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)){
            $this->matches = $matches;
            return true;
        }else{
            return false;
        }

    }
	
	/**
	 * @return mixed
	 * @desc execute method from action
	 */
    public function execute()
    {
        $params = explode("@", $this->action);
        $controller = new $params[0](new __Model());

        $method = $params[1];

        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }




}
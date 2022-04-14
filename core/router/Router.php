<?php 
namespace Router;
/**
 * 
 */
class Router 
{

	public string $url;
	public array $routes = [];
	
	public function __construct($url)
	{
		$this->url = trim($url, "/");
	}
	
	/**
	 * @param $path
	 * @param $action
	 * @desc set up _GET
	 */
    public function get($path, $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }
	/**
	 * @param $path
	 * @param $action
	 * @desc set up _POST
	 */
    public function post($path, $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

	/**
	 * @param $path
	 * @param $action
	 * @desc set up _PATCH
	 */
    public function patch($path, $action)
    {
        $this->routes['PATCH'][] = new Route($path, $action);
    }

	/**
	 * @param $path
	 * @param $action
	 * @desc set up _PATCH
	 */
    public function put($path, $action)
    {
        $this->routes['PUT'][] = new Route($path, $action);
    }

	/**
	 * @param $path
	 * @param $action
	 * @desc set up _PATCH
	 */
    public function delete($path, $action)
    {
        $this->routes['delete'][] = new Route($path, $action);
    }
	
	/**
	 * @desc dynamic route execution
	 */
    public function run()
    {
        foreach ($this->routes[$_SERVER["REQUEST_METHOD"]] as $route){
            //print_r($route);
            if ($route->matches($this->url)){

                return $route->execute();
            }
        }
        return header("HTTP/1.0 404 Not Found");
    }

}
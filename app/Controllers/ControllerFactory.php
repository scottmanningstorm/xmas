<?php 

class ControllerFactory 
{
	public static function build($className, $method, $params = null)  
	{	

		if (class_exists($className)) { 
			return call_user_func_array(array(new $className, $method), $params); 
		} else {
			call_user_func_array(array(new ErrorController, 'index'),  $params); 
			throw new Exception("no class found with the name " . $className);
		}
	}
}

?> 
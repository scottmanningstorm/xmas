<?php 

abstract class BaseController
{	
	protected $vars = array(); 

	public function renderView($filePath)
	{	
		$path = 'View/';
		$ext = '.php'; 

 		extract($this->vars, EXTR_PREFIX_SAME, "wddx");
 		
 		include $path.'header'.$ext;

		if (is_readable($path.$filePath.'.php')) {
			include ($path.$filePath.$ext); 
		} 

		include $path.'footer'.$ext;
	}

	public function addVar($name, $value) 
	{
		// Fix if we have array. 
		if (is_array($value)) {
			foreach ($values as $key => $value) {
				$this->vars[$key] = $value; 			
			}
		}
		else { 	
			$this->vars[$name] = $value; 
		}
	}

}

?>
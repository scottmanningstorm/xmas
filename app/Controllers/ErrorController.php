<?php 

class ErrorController extends BaseController 
{
	public function index() 
	{	
		// Weird glitch where root has a space prepended to it. Seems to be intermittent...
		$this->addVar('root', Paths::Root()); 

		$this->renderView('Error/Error');
	}
}

?>
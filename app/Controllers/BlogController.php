<?php 

class BlogController extends BaseController 
{
	public function index($id=0, $title='no title') 
	{
		$this->addVar('id', $id);
		$this->addVar('title', $title);
		$this->addVar('name', 'Name vars values');
		 
		$this->renderView('Blog/index');
	}

	public function add($id=0)
	{
		$this->addVar('id', $id); 

		var_dump($_POST);
	}
}

?>
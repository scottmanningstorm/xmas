<?php 
////////////////////////////////
//   DEBUG - Error Reporting. //
error_reporting(E_ALL);   	  //
ini_set('display_errors', 1); //						  //
////////////////////////////////

class arrayTest 
{
	
	protected $elements = array(); 
	protected $numOfElements; 

	public function __construct($x, $y, $z) 
	{
		$this->elements[] = $x; 
		$this->elements[] = $y;  
		$this->elements[] = $z; 
	}

	public function getArray($element = '')
	{
		if ($element === '') 
			var_dump($this->elements); 
		else 
			echo $this->elements[$element]; 
	}

	public function addValuesToArray ($args = array())
	{
	 	foreach ($args as $arg => $value) {
	 		$this->addToArray($value); 
	 	}
	}

	public function addToStartOfArray($value)
	{
		array_unshift($this->elements, $value); 
		$this->numOfElements++; 
	}

	public function addToArray($value)
	{
		$rand = 4;
		$this->elements[] = $value; 
		$this->numOfElements++; 
	}

	public function removeElementWithOffset($element, $removeOffset)
	{
		array_splice($this->elements, $element, $removeOffset); 
	}

	public function removeElement($element)
	{
		$this->removeElementWithOffset($element, 1);
	}

	public function getNumOfElements() 
	{
		return count($this->elements); 
	}


}


$array = new arrayTest('element1', 'ELEMENT2', 'element3'); 
var_dump($array->getNumOfElements()); 
$array->removeElementWithOffset(1,2);
$array->addToStartOfArray('addto start of array'); 
$array->addToStartOfArray('addto start of array'); 
var_dump($array->getNumOfElements()); 
//var_dump($array->getNumOfElements()); 
//$array->removeElement(1); 
//$array->getArray(); 



?> 
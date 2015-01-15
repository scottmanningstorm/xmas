<?php
include('RssReader.php'); 
abstract class RssFeed
{	

	protected $object_reader; 
	/**
	 * Root node of everty entry within our XML document. 
	 * 
	 * @var string
	 */
	public $root_node; 

	/**
	 * Stores an array of all child nodes of each $root_node.
	 * 
	 * @var string
	 */ 
	public $child_nodes; 

	/**
	 * Stores a ref to our reader object. 
	 * 
	 * @var string
	 */ 
	protected $reader; 

	/**
	 * Stores a ref to our DOM.  
	 * 
	 * @var object
	 */ 
	protected $doc; 

	public function __construct($xml_file_path, $object_reader)
	{	
		$this->reader = new DOMDocument(); 

		$object_reader = strtolower($object_reader);
		$object_reader = ucfirst($object_reader); 
		$this->object_reader = new XmlReader();

		$this->reader->load($xml_file_path);

		$this->doc = $this->reader->documentElement;
	}

	public function setObjectReader($object_reader)
	{
		$this->object_reader = $object_reader; 
	}
	/**
	 * Iterates over our node and extracts each child node to $this->child_nodes. Uses recursion if our extracted node is an array.
	 * @param $node String 
	 * @return Feed
	 */
	public function iterateOverNodes($node)
	{	 
		if ($node == null) {	
			$node = $this->doc;
		}

		foreach ($node->childNodes as $item) { 

			if ($item->nodeType == 1) {

				$this->child_nodes[$item->nodeName][] = $item->nodeValue;	
				
			}

		if (is_object($item)) {
			$this->iterateOverNodes($item); 
		}

		}
	
	}

	public function __get($name)
	{
		return $this->child_nodes[$name];
	}

	public function extractNode($node='') 
	{	
		if ($node === '') {
			$node = $this->child_nodes; 
		} 
		$return = ''; 
		
		var_dump($this->child_nodes); 
		
		foreach ($this->child_nodes as $node) {
			if(is_array($node) || is_object($node)) {
				$this->extractNode($node); 
			} else {
				
			}
		}


		return $return; 
	}

}

?>
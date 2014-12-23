<?php 

class sendDataController extends BaseController
{  
    public function index() 
    {	
    	//$data_sender = new ActiveRecord();
        
        $data_router = new DataRouter();    	
        
        $data_router->getServerRequestData();
 
        $routing_object = ObjectWriterFactory::build($data_router->getReturnFormat()); 
  
       // $routing_object->sendData('http://localhost:8888/framework/sendData/incoming/'.$data_router->getData());
         $data_router->sendData('lhasdlnas'); 
    } 

    public function incoming($data_object)
    {
		
	}
}

?> 
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Bug extends Controller {
    
    public function action_noscript()
	{
        $this->response->body(View::factory('error/noscript'));
	}
        
} 

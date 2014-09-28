<?php

namespace Vibius\AbstractTemplating\Engines;

use Vibius\AbstractTemplating\EngineInterface;

class Twig implements EngineInterface{

	public $variables = [];

	public function __construct(){
		
		$loader = new \Twig_Loader_String();
		$this->engine = new \Twig_Environment($loader);

	}

	public function assign($variables){
		$this->variables = $variables;
	}

	public function render($content){
		echo $this->engine->render($content, $this->variables);
	}


}
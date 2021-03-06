<?php

namespace Vibius\AbstractTemplating\Engines;

use Vibius\AbstractTemplating\EngineInterface;

class Twig implements EngineInterface{

	use \Vibius\AbstractTemplating\EngineHelpers;

	public $variables = [];

	public $htmlParseable = true;

	public $extensions = [
		'php', 'html','blade.php', 'tpl.php', 'tpl'
	];

	public $engine;

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
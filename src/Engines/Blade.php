<?php

namespace Vibius\AbstractTemplating\Engines;

use Vibius\AbstractTemplating\EngineInterface;
use Philo\Blade\Blade as LaravelBlade;

class Blade implements EngineInterface{

	use \Vibius\AbstractTemplating\EngineHelpers;

	public $variables = [];

	public $htmlParseable = false;

	public $extensions = [
		'php', 'blade.php'
	];

	public $engine;
	
	public function __construct(){
		
		$views = vibius_BASEPATH. 'app/views/';
		$cache = vibius_BASEPATH. '/app/cache/templating';
		$this->engine = new LaravelBlade($views, $cache);

	}

	public function assign($variables){
		$this->variables = $variables;
	}

	public function render($content){
		echo $this->engine->view()->make($content)->with($this->variables);
	}


}
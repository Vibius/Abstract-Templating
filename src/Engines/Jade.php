<?php

namespace Vibius\AbstractTemplating\Engines;

use Vibius\AbstractTemplating\EngineInterface;

use Everzet\Jade\Dumper\PHPDumper as PHPDumper;
use Everzet\Jade\Visitor\AutotagsVisitor as AutotagsVisitor;
use Everzet\Jade\Filter\JavaScriptFilter as JavaScriptFilter;
use Everzet\Jade\Filter\CDATAFilter as CDATAFilter;
use Everzet\Jade\Filter\PHPFilter as PHPFilter;
use Everzet\Jade\Filter\CSSFilter as CSSFilter;

use Everzet\Jade\Parser as Parser;
use Everzet\Jade\Lexer\Lexer as Lexer;
use Everzet\Jade\Jade as JadeEngine;

class Jade implements EngineInterface{

	use \Vibius\AbstractTemplating\EngineHelpers;

	public $variables = [];

	public $htmlParseable = true;

	public $extensions = [
		'php', 'blade.php', 'html'
	];

	public $engine;

	public function __construct(){

		$dumper = new PHPDumper();
		$dumper->registerVisitor('tag', new AutotagsVisitor());
		$dumper->registerFilter('javascript', new JavaScriptFilter());
		$dumper->registerFilter('cdata', new CDATAFilter());
		$dumper->registerFilter('php', new PHPFilter());
		$dumper->registerFilter('style', new CSSFilter());

		// Initialize parser & Jade
		$parser = new Parser(new Lexer());
		$this->engine  = new JadeEngine($parser, $dumper);



	}

	public function assign($variables){
		$this->variables = $variables;
	}

	public function render($content){
		echo $this->engine->render($content);
	}


}
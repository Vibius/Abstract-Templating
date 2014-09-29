<?php

namespace Vibius\AbstractTemplating;

use FileSystem, Exception;

class Abstractor{

	public $variables = [];

	function __construct( EngineInterface $engine, $folderPath = false){
		
		$this->engine = $engine;

		$this->folderPath = '/app/views/';
		
		if( $folderPath ){
			$this->folderPath = $folderPath;
		}

	}

	public function load($file){

		$fileSource = $this->folderPath.$file;

		foreach($this->engine->extensions as $extension){
			if(  FileSystem::has($fileSource.'.'.$extension) ){
			
				if($this->engine->htmlParseable){
					$load = FileSystem::read($fileSource.'.'.$extension);
					
					$this->files[$file] = $load;
					$this->lastFile = $file;
				}else{
					$this->files[$file] = $file;
					$this->lastFile = $file;
				}
				
				break;
			}
		}

		return $this;
		throw new Exception(' View not found at path: '. $file);
	}

	private function getView($file){
		
		if( !isset($this->files[$file]) ){
			throw new Exception("File is not loaded to the view class! ($file)");
		}
		
		return $this->files[$file];
	}

	public function assign($variables){
		$this->engine->assign($variables);
		return $this;
	}

	public function render( $filePath = false){
		
		if( !$filePath ){
			$file = $this->lastFile;
		}else{
			$file = $filePath;
		}

		$content = $this->getView($file);

			$this->engine->render($content);
		
	}

	public function getEngine(){
		return $this->engine->getEngine();
	}



}
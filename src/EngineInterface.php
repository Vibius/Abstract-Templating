<?php

namespace Vibius\AbstractTemplating;

interface EngineInterface{
	public function assign($variables);
	public function render($content);
}
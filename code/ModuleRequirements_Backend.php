<?php

class ModuleRequirements_Backend extends Requirements_Backend {
	
	protected function path_for_file($fileOrUrl) {
		if(preg_match('{^//|http[s]?}', $fileOrUrl)) {
			return $fileOrUrl;	
		} else {
			if(!Director::fileExists($fileOrUrl)) {
				$fileOrUrl = MODULES_DIR . '/' . $fileOrUrl;
			}
			return parent::path_for_file($fileOrUrl);
		}
	}
}
<?php

class ModuleRequirements_Backend extends Requirements_Backend {
	
	protected function path_for_file($fileOrUrl) {
		if(preg_match('{^//|http[s]?}', $fileOrUrl)) {
			return $fileOrUrl;
			
		} else {
			if(!Director::fileExists($fileOrUrl)) {
				$fileOrUrl = MODULES_DIR . '/' . $fileOrUrl;
			}
			if(Director::fileExists($fileOrUrl)) {
				$filePath = preg_replace('/\?.*/', '', Director::baseFolder() . '/' . $fileOrUrl);
				$prefix = Director::baseURL();
				$mtimesuffix = "";
				$suffix = '';
				if($this->suffix_requirements) {
					$mtimesuffix = "?m=" . filemtime($filePath);
					$suffix = '&';
				}
				if(strpos($fileOrUrl, '?') !== false) {
					if (strlen($suffix) == 0) {
						$suffix = '?';
					}
					$suffix .= substr($fileOrUrl, strpos($fileOrUrl, '?')+1);
					$fileOrUrl = substr($fileOrUrl, 0, strpos($fileOrUrl, '?'));
				} else {
					$suffix = '';
				}
				return "{$prefix}{$fileOrUrl}{$mtimesuffix}{$suffix}";
			} else {
				return false;
			}
		}
	}
}
silverstripe-modulefolder
=========================

Install modules in the 'modules' folder instead of root.

This is a proof of concept and it might break things, but first attempts seem to work just fine.

As far as I can see, the only thing that needs to be changed is an extra check for an extra path in `Requirements::path_for_file`.
To test this without touching core there is a `ModuleRequirements_Backend` that also search for requirements in `MODULES_DIR`

if(!Director::fileExists($fileOrUrl)) {
  $fileOrUrl = MODULES_DIR . '/' . $fileOrUrl;
}

##Composer

With composer you can set custom installer-paths for silverstripe-module types.
To leave the cms and framework folder in the root you can force that as well.

Example:

{
	"name": "silverstripe/installer",
	"description": "The SilverStripe Framework Installer",
	"require": {
		"php": ">=5.3.2",
		"silverstripe/cms": "3.1.2",
		"silverstripe/framework": "3.1.2",
		"silverstripe-themes/simple": "*",
		"axyr/silverstripe-modulefolder": "*",
		"axyr/silverstripe-adminlogin": "*"
	},
	"config": {
		"process-timeout": 600	
	},
	"minimum-stability": "dev",
	"extra": {
		 "installer-paths": {
			"cms/": ["silverstripe/cms"],
			"framework/": ["silverstripe/framework"],
			"modules/": ["axyr/silverstripe-modulefolder"],
			"modules/{$name}/": ["type:silverstripe-module"]
		}
	}
}

##Background

There was a long debate in the Silverstripe 2.x era on the Google dev group:
https://groups.google.com/forum/#!msg/silverstripe-dev/6qdRkCDliEg/A3mH9kFhG6MJ

and
 
https://groups.google.com/forum/#!topic/silverstripe-dev/on1_ABPDNTc

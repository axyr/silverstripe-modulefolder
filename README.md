silverstripe-modulefolder
=========================

Install modules in the 'modules' folder instead of root.

This is not really a module, but more a proof of concept.

It might break things, but first attempts seem to work just fine.

Pleas help me testing this with your own modules ! :)

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

This still leads to a code folder near th other modules in the modules folder, but that's something we can't avoid right now.


##Background

I like to have thirdparty modules living in their own folder and keep my own custom application code in mysite or maybe even a second folder with custom code.

Now that we have composer I install more modules which sometimes provide little functionality but can come in quite handy.
I don't want all those small 'plugins' in my root folder.

I don't want to stir up the discussion again if we need this or something is wrong with the current 'all code in root folder' approach

There was a long debate in the Silverstripe 2.x era on the Google dev group:

https://groups.google.com/forum/#!msg/silverstripe-dev/6qdRkCDliEg/A3mH9kFhG6MJ

and
 
https://groups.google.com/forum/#!topic/silverstripe-dev/on1_ABPDNTc

For now I just want to know if this is gonna work!

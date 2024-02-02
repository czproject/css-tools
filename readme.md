CSS Minifier
------------

Simple CSS minifier.

``` php
<?php
	$minifier = new Cz\CssMinifier\CssMinifier;
	$result = $minifier->minify("body {
		color: #333;
		background: #fff;
	}");
	
	var_dump($result); // Output: body{color:#333;background:#fff}
```


------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/

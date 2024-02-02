# CzProject\CssTools


CSS tools for PHP.

``` php
<?php
	$minifier = new CzProject\CssTools\CssMinifier;
	$result = $minifier->minify("body {
		color: #333;
		background: #fff;
	}");
	
	var_dump($result); // Output: body{color:#333;background:#fff}
```


------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/

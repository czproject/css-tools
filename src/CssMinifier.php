<?php
	/** Css Minifier - simple CSS minifier
	 * 
	 * @author		David Grudl, 2011
	 * @author		Jan Pecha, <janpecha@email.cz>, 2012
	 * @license		New BSD License
	 */
	
	namespace Cz\CssMinifier;
	
	class CssMinifier
	{
		const S_NORMAL = 0,
			S_STRING = 1;
		
		
		
		/**
		 * @link	https://github.com/nette/build-tools/blob/master/tasks/minifyJs.php#L51-L56
		 * @author	David Grudl, 2011
		 * @param	string
		 * @return	string
		 */
		public function minify($s)
		{
			$s = preg_replace('#/\*.*?\*/#s', '', $s); // remove comments
			$s = preg_replace('#\s+#', ' ', $s); // compress space
			$s = preg_replace('# ([^(0-9a-z.\#*-])#i', '$1', $s);
			$s = preg_replace('#([^0-9a-z%)]) #i', '$1', $s);
			$s = str_replace(';}', '}', $s); // remove leading semicolon
			$s = trim($s);
			
			// replace SPACE => NEW LINE
			$state = self::S_NORMAL;
			$stringChar = '';
			$len = strlen($s);
			
			for($i = 0; $i < $len; $i++)
			{
				if($state === self::S_NORMAL)
				{
					if($s[$i] === '\'' || $s[$i] === '"')
					{
						$state = self::S_STRING;
						$stringChar = $s[$i];
					}
					elseif($s[$i] === ' ')
					{
						$s[$i] = "\n";
					}
				}
				elseif($state === self::S_STRING)
				{
					if($s[$i] === $stringChar)
					{
						$state = self::S_NORMAL;
						$stringChar = '';
					}
				}
			}
			
			return $s;
		}
	}
	

<?php
namespace Parser;
use Parser\Classes\Parser;
use Parser\Classes\InternalLinks;
use Parser\Classes\ImageLinks;


require_once  __DIR__ .'\Classes\Parser.php';
require_once  __DIR__ .'\Interfaces\Handler.php';
require_once  __DIR__ .'\Classes\InternalLinks.php';
require_once  __DIR__ .'\Classes\ImageLinks.php';

class main{

	private $url;
	private $listUrl;

	function __construct($url){
		try{
			$parse = new Parser($url);
			$page = $parse->getHtml();
			$this->url = $parse->getInfo()['url'];
			
			$this->listUrl = InternalLinks::getUrl( $page, $this->url );
			
			//if(count($listUrl) > 0) $this->reportDisplay();
			//if(count($listUrl) > 0) $this->reportFile();
		}
		catch(Exception $e)
		{
			echo 'Message: ' .$e->getMessage();
		}
		
		
	}
	
	function reportFile()
	{
		try{
		if( count($this->listUrl) > 0 )
		{			
			$fp = fopen(__DIR__.'/file.csv', 'w');
			foreach($this->listUrl as $value)
			{
				$parse = new Parser($value);
				$page = $parse->getHtml();
				
				$listImgUrl = ImageLinks::getUrl( $page, parse_url($this->url)['scheme'].'://'.parse_url($this->url)['host'] );
				
				if( count($listImgUrl) > 0 )
				{
					fputcsv($fp, array($value,''));
					
					foreach($listImgUrl as $val)
					{
						fputcsv($fp, array($val));
					}
				}
			}
			fclose($fp);
		}
		}
		catch(Exception $e)
		{
			echo $e->getMessage;
		}
	}
	
	function reportDisplay()
	{		
		if( count($this->listUrl) > 0 )
		{			
			foreach($this->listUrl as $value)
			{
				$parse = new Parser($value);
				$page = $parse->getHtml();
				
				$listImgUrl = ImageLinks::getUrl( $page, parse_url($this->url)['scheme'].'://'.parse_url($this->url)['host'] );
				
				if( count($listImgUrl) > 0 )
				{
					echo "
";
					echo $value;
					foreach($listImgUrl as $val)
					{
						echo "
	";
						echo $val;
					}
				}
			}
		}
	}
}
<?php
namespace Parser\Classes;

class Parser
{
	private $url;
	private $info;
	private $html;
	private $errno;
	private $error;

	function __construct(String $url)
	{
		$this->url = $url ?? null;
	}

	public function getUrl()
	{
		return $this->url ?? null;;
	}

	function getHtml()
	{
		$this->parse();
		$this->ensureErrorExists();
		return $this->parse() ? $this->html : null;
	}
	
	public function getInfo()
	{
		return $this->info ?? null;
	}
	
	protected function ensureErrorExists()
    {
        if (!isset($this->error)) {
            throw 'Error! '.$this->errno.' '.$this->error;
        }
    }
	
	public function execute()
	{
		$this->parse();
		return $this->html;
	}
	
	function parse()
	{
		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);

		$ch      = curl_init( $this->url );
		curl_setopt_array( $ch, $options );
		$this->html		= curl_exec( $ch );
		$this->errno	= curl_errno( $ch );
		$this->error	= curl_error( $ch );
		$this->info		= curl_getinfo( $ch );
		curl_close( $ch );
		
		if($this->error != '')
		{
			return false;
		}
		return true;
	}
	
}
?>
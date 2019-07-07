<?php
namespace Parser\Interfaces;
interface HandlerInterface
{
	public function getUrl( string $html, string $url );
}
?>
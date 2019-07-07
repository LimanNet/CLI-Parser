<?php
namespace Parser\Classes;
use Parser\Interfaces\HandlerInterface;

class InternalLinks implements HandlerInterface
{
	public function getUrl( string $html, string $url )
	{
		$listUrl = array();
		/* Вызываем функцию, которая все совпадения помещает в массив $matches */
		preg_match_all("/<[Aa][\s]{1}[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\s]*([^ \"'>\s#]+)[^>]*>/", $html, $matches);
		$urls = $matches[1]; // Берём то место, где сама ссылка
		
		// Выводим все ссылки
		for ($i = 0; $i < count($urls); $i++)
		{
			// Если есть перенаправлениями на www убираем его для сравнения хостов и отсортировки поддоменов
			$urlsh = str_replace('www.', '', parse_url($urls[$i])['host']);
			$urlh = str_replace('www.', '', parse_url($url)['host']);
			
			if(is_null(parse_url($urls[$i])['host']) or strcasecmp( $urlsh, $urlh) != 0)
			{
				// Если [host] оканчивается на / и [path] начинается на / то убираем один
				if ( $url{strlen($url)-1} == '/' && $urls[$i]{0} == '/' )
				{
					$listUrl[] = substr($url,0,-1).$urls[$i];
				}else
				{
					$listUrl[] = $url.$urls[$i];
				}
			} 
			elseif( strcasecmp( $urlsh, $urlh) == 0
				and strpos( (string)$urls[$i],'tel:') != false ) // отсекаем все внешние ссылки
			{
					$listUrl[] = $urls[$i];
			}
		}
		return array_unique($listUrl); // возвращаем только уникальные значения
	}
}
?>
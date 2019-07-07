<?php
namespace Parser\Classes;
use Parser\Interfaces\HandlerInterface;

class ImageLinks implements HandlerInterface
{
	public function getUrl( string $html, string $url )
	{
		$listUrl = array();
		/* Вызываем функцию, которая все совпадения помещает в массив $matches */
		preg_match_all('/<img.*?src=.*?"(.*?)".*?.*?>/', $html, $matches);
		$urls = $matches[1];
		// Выводим все ссылки
		for ($i = 0; $i < count($urls); $i++)
		{
			// Если есть перенаправлениями на www убираем его для сравнения хостов и отсортировки поддоменов
			$urlsw = str_replace('www.', '', parse_url($urls[$i])['host']);
			$urlw = str_replace('www.', '', parse_url($url)['host']);
			if(is_null(parse_url($urls[$i])['host']))
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
			elseif(strpos($urlsw, $urlw) == false)
			{
				$listUrl[] = $urls[$i];
			}
		}
		return array_unique($listUrl); // возвращаем только уникальные значения
	}
}
?>
<?php

function e_idioma($idioma) {

	if ($idioma === 'en') {
		return 'en';
	}
	else if ($idioma === 'pt') {
		return 'pt';
	}
	else if ($idioma === 'ru') {
		return 'ru';
	}

	return false;
}

function get_idioma() {
	$idiomas = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$idioma = mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2, 'UTF-8');

	if (mb_strtolower($idioma, 'UTF-8') === 'en') {
		return 'en';
	}
	else if (mb_strtolower($idioma, 'UTF-8') === 'pt') {
		return 'pt';
	}
	else if (mb_strtolower($idioma, 'UTF-8') === 'ru') {
		return 'ru';
	}
	else if (mb_stripos($idiomas, 'en', 0, 'UTF-8') !== false) {
		return 'en';
	}
	else if (mb_stripos($idiomas, 'pt', 0, 'UTF-8') !== false) {
		return 'pt';
	}
	else if (mb_stripos($idiomas, 'ru', 0, 'UTF-8') !== false) {
		return 'ru';
	}

	return 'en';
}

function get_dominio($endereco) {
	$endereco = trim($endereco);
   	$url = parse_url($endereco);

   	if ($url == NULL || ((!isset($url['host']) || $url['host'] == NULL) && (!isset($url['path']) || $url['path'] == NULL))) {
   		$res = explode('/', $endereco, 2);
   		return array_shift($res);
   	}

   	if ($url == NULL || ((!isset($url['host']) || $url['host'] == NULL) && (isset($url['path']) && $url['path'] != NULL))) {
   		$path = $url['path'];
   		$res = explode('/', $path, 2);
   		return array_shift($res);
   	}

   	return $url['host'];
} 

function get_site_origem() {
	if (isset($_SERVER['HTTP_REFERER'])) {
		return get_dominio($_SERVER['HTTP_REFERER']); 
	}
	
	return NULL;
}

function get_navegador() {
	if (!isset($_SERVER['HTTP_USER_AGENT'])) {
		return "User Agent Vazio";
	}

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$navegador = "N/A";

	$navegadores = array(
		'/mobile/i' => 'Mobile Browser',
		'/safari/i' => 'Safari',
		'/applewebkit/i' => 'Safari',
		'/chrome/i' => 'Google Chrome',
		'/crios/i' => 'Google Chrome for iOS',
		'/crmo/i' => 'Google Chrome',
		'/chromium/i' => 'Chromium',
		'/firefox/i' => 'Mozilla Firefox',
		'/focus/i' => 'Focus for iOS (Firefox)',
		'/fxios/i' => 'Mozilla Firefox for iOS',
		'/\) like Gecko/i' => 'Internet Explorer 11',
		'/trident/i' => 'Internet Explorer',
		'/msie/i' => 'Internet Explorer',
		'/opios/i' => 'Opera > 13.0 for iOS',
		'/opr/i' => 'Opera > 13.0',
		'/opera/i' => 'Opera < 13.0',
		'/opt\/\d+(?:.?_?\d+)+/i' => 'Opera Touch',
		'/coast/i' => 'Opera Coast for iOS',
		'/\) min\//i' => 'Min',
		'/dragon/i' => 'Chromodo',
		'/y8-browser/i' => 'Y8 Browser',
		'/comodo_drag/i' => 'Comodo Dragon',
		'/electron/i' => 'Electron',
		'/iceweasel/i' => 'Iceweasel',
		'/phantom/i' => 'PhantomJS',
		'/qqbrowserlite/i' => 'QQ Browser Lite',
		'/qqbrowser/i' => 'QQ Browser',
		'/gsa/i' => 'Google Search Appliance',
		'/\sedg\//i' => 'Microsoft Edge',
		'/edg([ea]|ios)/i' => 'Microsoft Edge',
		'/blackberry|\bbb\d+/i' => 'BlackBerry',
		'/rim\stablet/i' => 'BlackBerry',
		'/falkon/i' => 'Falkon',
		'/mxios/i' => 'Maxthon for iOS',
		'/maxthon/i' => 'Maxthon',
		'/tizen/i' => 'Tizen',
		'/nintendo wiiu/i' => 'Wii U Internet Browser',
		'/osmeta/i' => 'Facebook ou Instagram App for Desktop',
		'/whatsapp/i' => 'WhatsApp Desktop',
		'/lg browser/i' => 'LG Web Browser',
		'/konqueror/i' => 'konqueror',
		'/postmanruntime/i' => 'Postman (Software)',
		'/vivaldi/i' => 'Vivaldi',
		'/webchat/i' => 'WeChat',
		'/micromessenger/i' => 'WeChat',
		'/ucbrowser/i' => 'UC Browser',
		'/samsungbrowser/i' => 'Samsung Internet for Android',
		'/googlebot/i' => 'Googlebot',
		'/bingbot/i' => 'BingBot',
		'/yandexbot/i' => 'YandexBot',
		'/yabrowser/i' => 'Yandex Browser',
		'/yabrows/i' => 'Yandex Browser Mobile',
		'/brave/i' => 'Brave',
		'/silk/i' => 'Amazon Silk',
		'/seamonkey/i' => 'SeaMonkey',
		'/playstation 4/i' => 'PS4 Web browser',
		'/webster/i' => 'Webster',
		'/uzbl/i' => 'Uzbl',
		'/ur/i' => 'UR Browser',
		'/ue4/i' => 'Unreal Engine Web Browser',
		'/ultrabrowser/i' => 'UltraBrowser',
		'/tv bro/i' => 'TV Bro',
		'/tulipchain/i' => 'Tulip Chain',
		'/tjusig/i' => 'Tjusig',
		'/tazweb/i' => 'TazWeb',
		'/sundance/i' => 'Sundance',
		'/valve steam gameoverlay/i' => 'Steam Game Overlay',
		'/station/i' => 'Station',
		'/slimbrowser/i' => 'SlimBrowser',
		'/atomshell/i' => 'Slack App',
		'/skipstone/i' => 'SkipStone',
		'/sielo/i' => 'Sielo',
		'/sezna/i' => 'Seznam.cz Browser',
		'/sraf/i' => 'Seraphic Sraf',
		'/seewoos/i' => 'Seewo Browser',
		'/salamweb/i' => 'SalamWeb Browser',
		'/rockmelt/i' => 'RockMelt',
		'/roccat/i' => 'Roccat Browser',
		'/retrozilla/i' => 'RetroZilla',
		'/retaw/i' => 'retawq',
		'/qupzilla/i' => 'QupZilla',
		'/qtweb/i' => 'QtWeb',
		'/qtwebengine/i' => 'Viber for Desktop',
		'/pb/i' => 'PirateBrowser',
		'/patriott/i' => 'Patriott',
		'/origyn web browser/i' => 'Origyn Web Browser',
		'/odyssey web browser/i' => 'Odyssey Web Browser',
		'/opwv-sdk/i' => 'Openwave Phone Simulator',
		'/omniweb/i' => 'OmniWeb',
		'/ohhaibrowser/i' => 'OhHai Browser',
		'/surf/i' => 'Surf',
		'/netsurf/i' => 'NetSurf',
		'/netpositive/i' => 'NetPositive',
		'/netbox/i' => 'NetBox',
		'/ncsa_mosaic/i' => 'NCSA Mosaic',
		'/myibrow/i' => 'My Internet Browser',
		'/mxnitro/i' => 'MxNitro',
		'/multi-browser/i' => 'Multi-Browser XP',
		'/lynx/i' => 'Lynx',
		'/phoebe/i' => 'Lunascape Phoebe',
		'/links/i' => 'Links',
		'/lieying/i' => 'LieYing',
		'/Iron/i' => 'iron',
		'/iridium/i' => 'Iridium',
		'/irider/i' => 'iRider',
		'/ice br/i' => 'ICE Browser',
		'/icab/i' => 'iCab',
		'/ibrowse/i' => 'IBrowse',
		'/hydra browser/i' => 'Hydra Browser',
		'/freebox/i' => 'Freebox Browser',
		'/ekiohflow/i' => 'Flow',
		'/flock/i' => 'Flock',
		'/flast/i' => 'Flast',
		'/flamesky/i' => 'FlameSky',
		'/espial/i' => 'Espial TV Browser',
		'/elinks/i' => 'ELinks',
		'/rocket.chat/i' => 'Electron App',
		'/doczilla/i' => 'DocZilla',
		'/degdega/i' => 'deg-degan',
		'/cyberdog/i' => 'Cyberdog',
		'/crazy/i' => 'Crazy Browser',
		'/colibri/i' => 'Colibri',
		'/coc_coc/i' => 'Coc Coc',
		'/chimlac/i' => 'Chim Lac',
		'/bunjalloo/i' => 'Bunjalloo',
		'/briskbard/i' => 'BriskBard',
		'/miuibrowser/i' => 'Miui',
		'/qupzilla/i' => 'QupZilla',
		'/bada/i' => 'Bada',
		'/slimerjs/i' => 'SlimerJS',
		'/sailfish/i' => 'Sailfish',
		'/k-meleon/i' => 'K-Meleon',
		'/sleipnir/i' => 'Sleipnir',
		'/puffin/i' => 'Puffin',
		'/epiphany/i' => 'Epiphany',
		'/swing/i' => 'Swing',
		'/mzbrowser/i' => 'MZ Browser',
		'/Whale/i' => 'NAVER Whale Browser',
		'/bolt/i' => 'Bolt',
		'/blackhawk/i' => 'BlackHawk',
		'/beamrise/i' => 'Beamrise',
		'/beaker/i' => 'Beaker',
		'/aviator/i' => 'Aviator',
		'/avant/i' => 'Avant Browser',
		'/arachne/i' => 'Arachne',
		'/aplix/i' => 'aplix',
		'/aolbuild/i' => 'AOL Explorer',
		'/amigavoyager/i' => 'Amiga Voyager',
		'/acoo browser/i' => 'Acoo Browser',
		'/abrowse/i' => 'ABrowse',
		'/abolimba/i' => 'Abolimba',
		'/37ab/i' => '37abc',
		'/alohabrowser/i' => 'Aloha Browser',
		'/(web|hpw)[o0]s/i' => 'WebOS Browser'
	);

	foreach ($navegadores as $regex => $valor) {
		if (preg_match($regex, $user_agent)) {
			$navegador = $valor;
		}
	}

	return $navegador;
}

function get_sistema_operacional() {
	if (!isset($_SERVER['HTTP_USER_AGENT'])) {
		return "User Agent Vazio";
	}

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$sistema_operacional = "N/A";

	$sistemas_operacionais = array(
		'/windows /i' => 'Windows',
		'/windows phone/i' => 'Windows Phone',
		'/android/i' => 'Android',
		'/macintosh/i' => 'MacOS',
		'/Macintosh(.*?) FxiOS(.*?)\//' => 'iOS',
		'/(ipod|iphone|ipad)/i' => 'iOS',
		'/linux/i' => 'Linux',
		'/Roku\/DVP/' => 'Roku',
		'/(web|hpw)[o0]s/i' => 'WebOS',
		'/blackberry|\bbb\d+/i' => 'BlackBerry',
		'/rim\stablet/i' => 'BlackBerry',
		'/bada/i' => 'Bada',
		'/tizen/i' => 'Tizen',
		'/CrOS/i' => 'Chrome OS',
		'/PlayStation 4/' => 'PlayStation 4',
		'/gsa/i' => 'Google Search Appliance'
	);

	foreach ($sistemas_operacionais as $regex => $valor) {
		if (preg_match($regex, $user_agent)) {
			$sistema_operacional = $valor;
		}
	}

	return $sistema_operacional;
}

function get_tipo_dispositivo() {
	if (!isset($_SERVER['HTTP_USER_AGENT'])) {
		return "User Agent Vazio";
	}

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$dispositivo = "N/A";

	$dispositivos = array(
		'/android/i' => 'tablet ou mobile',
		'/tablet(?! pc)/i' => 'tablet',
		'/googlebot/i' => 'bot',
		'/huawei/i' => 'mobile',
		'/nexus\s*(?:7|8|9|10).*/i' => 'tablet',
		'/ipad/i' => 'tablet',
		'/Macintosh(.*?) FxiOS(.*?)\//' => 'tablet',
		'/kftt build/i' => 'tablet',
		'/silk/i' => 'tablet',
		'/ipod/i' => 'mobile',
		'/iphone/i' => 'mobile',
		'/nexus\s*[0-6].*/i' => 'mobile',
		'/galaxy nexus/i' => 'mobile',
		'/[^-]mobi/i' => 'mobile',
		'/blackberry/i' => 'mobile',
		'/bada/i' => 'mobile',
		'/windows phone/i' => 'mobile',
		'/macos/i' => 'desktop',
		'/windows/i' => 'desktop',
		'/linux/i' => 'desktop',
		'/playstation 4/i' => 'videogame',
		'/roku/i' => 'smart tv',
		'/(web|hpw)[o0]s/i' => 'smart tv',
		'/tizen/i' => 'smart tv',
		'/moto g/i' => 'mobile',
		'/moto g\(100\)/i' => 'mobile',
		'/redmi note/i' => 'mobile',
		'/redmi note 8t/i' => 'mobile',
		'/lenovo k520/i' => 'mobile',
		'/mi note 10 lite/i' => 'mobile',
		'/nintendo 3ds/i' => 'console',
		'/new nintendo 3ds/i' => 'console',
		'/nintendo dsi/i' => 'console',
		'/playStation portable/i' => 'console',
		'/nintendo switch/i' => 'console',
		'/abox-iii/i' => 'tv box',
		'/bravia 4k gb/i' => 'smart tv',
		'/Freebox/i' => 'tv box',
		'/h96 pro/i' => 'tv box',
		'/m8s pro/i' => 'tv box',
		'/mx enjoy tv box/i' => 'tv box',
		'/p281/i' => 'tv box',
		'/neo-x8h-plus/i' => 'tv box',
		'/percee tv/i' => 'smart tv',
		'/qm163e/i' => 'smart tv',
		'/tx3 mini/i' => 'tv box',
		'/viera/i' => 'smart tv',
		'/x6 pro/i' => 'tv box',
		'/xbox one/i' => 'console'
	);

	foreach ($dispositivos as $regex => $valor) {
		if (preg_match($regex, $user_agent)) {
			$dispositivo = $valor;
		}
	}

	return $dispositivo;
}

function get_nome_dispositivo() {
	if (!isset($_SERVER['HTTP_USER_AGENT'])) {
		return "User Agent Vazio";
	}

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$dispositivo = "N/A";

	$dispositivos = array(
		'/android/i' => 'Celular Com Android',
		'/tablet(?! pc)/i' => 'Tablet',
		'/googlebot/i' => 'Googlebot',
		'/huawei/i' => 'Huawei',
		'/nexus\s*(?:7|8|9|10).*/i' => 'Nexus',
		'/ipad/i' => 'iPad',
		'/Macintosh(.*?) FxiOS(.*?)\//' => 'iPad',
		'/kftt build/i' => 'Kindle Fire HD 7',
		'/silk/i' => 'Amazon Tablet com Silk',
		'/ipod/i' => 'iPod',
		'/iphone/i' => 'iPhone',
		'/nexus\s*[0-6].*/i' => 'Nexus',
		'/galaxy nexus/i' => 'Nexus',
		'/[^-]mobi/i' => 'Mobile',
		'/blackberry/i' => 'BlackBerry',
		'/bada/i' => 'Bada',
		'/windows phone/i' => 'Windows Phone',
		'/macos/i' => 'Apple MacBook',
		'/windows/i' => 'Desktop Com Windows',
		'/linux/i' => 'Desktop Com Linux',
		'/playstation 4/i' => 'PlayStation 4',
		'/roku/i' => 'Roku',
		'/(web|hpw)[o0]s/i' => 'Smart TV LG',
		'/tizen/i' => 'Smart TV Samsung',
		'/moto g/i' => 'Motorola Moto G',
		'/moto g\(100\)/i' => 'Motorola Moto G100',
		'/redmi note/i' => 'Redmi Note',
		'/redmi note 8t/i' => 'Redmi Note 8T',
		'/lenovo k520/i' => 'Lenovo K520',
		'/mi note 10 lite/i' => 'Xiaomi Mi Note 10 Lite',
		'/nintendo 3ds/i' => 'Nintendo 3DS',
		'/new nintendo 3ds/i' => 'New Nintendo 3DS',
		'/nintendo dsi/i' => 'Nintendo DSi',
		'/playStation portable/i' => 'PlayStation Portable (PSP)',
		'/nintendo switch/i' => 'Nintendo Switch',
		'/abox-iii/i' => 'Amlogic ABOX III',
		'/bravia 4k gb/i' => 'Smart TV Sony Bravia 4K GB',
		'/Freebox/i' => 'Freebox Revolution',
		'/h96 pro/i' => 'Alfawise H96 Pro+',
		'/m8s pro/i' => 'Mecool M8S Pro',
		'/mx enjoy tv box/i' => 'Geniatech MX Enjoy TV BOX',
		'/p281/i' => 'BOMIX MXQ Pro P281',
		'/neo-x8h-plus/i' => 'Minix Neo X8H Plus',
		'/percee tv/i' => 'Smart TV TCL Percee TV',
		'/qm163e/i' => 'Smart TV Philips QM163E',
		'/tx3 mini/i' => 'Tanix TX3 Mini',
		'/viera/i' => 'Smart TV Panasonic Viera TV',
		'/x6 pro/i' => 'Zidoo X6 Pro',
		'/xbox one/i' => 'Xbox One'
	);

	foreach ($dispositivos as $regex => $valor) {
		if (preg_match($regex, $user_agent)) {
			$dispositivo = $valor;
		}
	}

	return $dispositivo;
}
<?php
// not used in a single language version

$langs = array(
	'en' => 'English', // Jakub Vrána - http://www.vrana.cz
	'zh' => '简体中文', // Mr. Lodar, vea - urn2.net - vea.urn2@gmail.com
	'zh-tw' => '繁體中文', // http://tzangms.com
);

/** Get current language
* @return string
*/
function get_lang() {
	global $LANG;
	return $LANG;
}

/** Translate string
* @param string
* @param int
* @return string
*/
function lang($idf, $number = null) {
	global $LANG, $translations;
	$translation = ($translations[$idf] ? $translations[$idf] : $idf);
	if (is_array($translation)) {
		$pos = 1;
		$translation = $translation[$pos];
	}
	$args = func_get_args();
	array_shift($args);
	$format = str_replace("%d", "%s", $translation);
	if ($format != $translation) {
		$args[0] = format_number($number);
	}
	return vsprintf($format, $args);
}

function switch_lang() {
	global $LANG, $langs;
	echo "<form action='' method='post'>\n<div id='lang'>";
	echo lang('Language') . ": " . html_select("lang", $langs, $LANG, "this.form.submit();");
	echo " <input type='submit' value='" . lang('Use') . "' class='hidden'>\n";
	echo "<input type='hidden' name='token' value='" . get_token() . "'>\n"; // $token may be empty in auth.inc.php
	echo "</div>\n</form>\n";
}

if (isset($_POST["lang"]) && verify_token()) { // $error not yet available
	cookie("adminer_lang", $_POST["lang"]);
	$_SESSION["lang"] = $_POST["lang"]; // cookies may be disabled
	$_SESSION["translations"] = array(); // used in compiled version
	redirect(remove_from_uri());
}

$LANG = "en";
if (isset($langs[$_COOKIE["adminer_lang"]])) {
	cookie("adminer_lang", $_COOKIE["adminer_lang"]);
	$LANG = $_COOKIE["adminer_lang"];
} elseif (isset($langs[$_SESSION["lang"]])) {
	$LANG = $_SESSION["lang"];
} else {
	$accept_language = array();
	preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~', str_replace("_", "-", strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])), $matches, PREG_SET_ORDER);
	foreach ($matches as $match) {
		$accept_language[$match[1]] = (isset($match[3]) ? $match[3] : 1);
	}
	arsort($accept_language);
	foreach ($accept_language as $key => $q) {
		if (isset($langs[$key])) {
			$LANG = $key;
			break;
		}
		$key = preg_replace('~-.*~', '', $key);
		if (!isset($accept_language[$key]) && isset($langs[$key])) {
			$LANG = $key;
			break;
		}
	}
}

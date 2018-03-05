<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'lookfortravel');

/** Имя пользователя MySQL */
define('DB_USER', 'lookfortrav_usr');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '5GIssgh3pJnLEQrv');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '@1SX}iX@}#Kj6q|s{vY&*WP[P~*{G:2w$_6)?TPW{6J<E5>1w)vPTwZ!3uTD3A|C');
define('SECURE_AUTH_KEY',  'ZY+;|_`q$E*!O4xco@tTd}<7M(r5+f;*1Vu5Nu7n&l0sri(;0uwH|d!Og^9ou{}y');
define('LOGGED_IN_KEY',    'Jg,q2}Rovr7L6Z(#Yr5@vV1U0cv1p27C;0-NRl5%_}1muw)YzC@^]&^3^EM_JF9l');
define('NONCE_KEY',        'C.,1t!bYa+Aw1P^5h3nh5_@(ZX^#.JmpvN6|rW> hMpE/mr7+E8Z[<=nmsBp-r^K');
define('AUTH_SALT',        'DiTGLPU{55X|DjImgGaAm+%&TqY{a:Y&Z=7nY,-2[ONCXJ=.Mj&Z$$v(1&jq6[ye');
define('SECURE_AUTH_SALT', 'pZj)c$+r0X`x]r<+eI<}oE(#B-CpC=2bvy8>5fV.mqE`E_iL_[mbKW-Xi1H 4eOs');
define('LOGGED_IN_SALT',   'HuvP>J#<G[Kz/HI~0s?}OeajC>_[5K^o~q!d:Mwv#3f:;*K0w2 ?s53] C5!Av*T');
define('NONCE_SALT',       'H`ID*/*WIjsm<9)#/;$%@osLzv5f>3|_vRk/-5j^$rt3Wv?r.^xe]G@f,Z[sFwUN');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');

if(is_admin()) {
    add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
    define( 'FS_CHMOD_DIR', 0751 );
}
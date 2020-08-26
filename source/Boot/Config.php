<?php
/**
 * DATABASE
 */
if (strpos($_SERVER['HTTP_HOST'], "localhost")){
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "");
    define("CONF_DB_NAME", "bkhost");
} else {
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "bkhost16_bkhost16");
    define("CONF_DB_PASS", "10sitespordia");
    define("CONF_DB_NAME", "bkhost16_bkhost");
}

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.bkhost.com.br");
define("CONF_URL_TEST", "https://www.localhost/bkhost");

/**
 * SITE
 */
define("CONF_SITE_NAME", "BKhost");
define("CONF_SITE_TITLE", "Hospede seu site no que há de melhor, rápido e seguro");
define("CONF_SITE_DESC",
    "BKhost hospeda seu site de maneira rápida e segura");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "bkhost.com.br");
define("CONF_SITE_ADDR_STREET", "");
define("CONF_SITE_ADDR_NUMBER", "");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "");
define("CONF_SITE_ADDR_STATE", "");
define("CONF_SITE_ADDR_ZIPCODE", "");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@creator");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@creator");
define("CONF_SOCIAL_FACEBOOK_APP", "5555555555");
define("CONF_SOCIAL_FACEBOOK_PAGE", "pagename");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "author");
define("CONF_SOCIAL_GOOGLE_PAGE", "5555555555");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "5555555555");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "insta");
define("CONF_SOCIAL_YOUTUBE_PAGE", "youtube");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "cafeweb");
define("CONF_VIEW_APP", "cafeapp");
define("CONF_VIEW_ADMIN", "sb-admin");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

define("CONF_IMAGE_DEFAULT_AVATAR", "/assets/images/webp/default-avatar.webp");
define("CONF_IMAGE_NO_AVAILABLE_1BY1", "/assets/images/webp/no-image-available-1by1.webp");
define("CONF_IMAGE_NO_AVAILABLE_16BY9", "/assets/images/webp/no-image-available-16by9.webp");

/**
 * ALERTS
 */
define("CONF_ALERT_MESSAGE", "alert");
define("CONF_ALERT_SUCCESS", ["class" => "alert-success", "icon" => "fas fa-fw fa-check-circle"]);
define("CONF_ALERT_DANGER", ["class" => "alert-danger", "icon" => "fas fa-fw fa-times-circle"]);
define("CONF_ALERT_WARNING", ["class" => "alert-warning", "icon" => "fas fa-fw fa-exclamation-circle"]);
define("CONF_ALERT_INFO", ["class" => "alert-info", "icon" => "fas fa-fw fa-info-circle"]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "srv248.prodns.com.br");
define("CONF_MAIL_PORT", "465");
define("CONF_MAIL_USER", "cadastro@bkhost.com.br");
define("CONF_MAIL_PASS", "10sitespordia");
define("CONF_MAIL_SENDER", ["name" => "BKhost", "address" => "cadastro@bkhost.com.br"]);
define("CONF_MAIL_SUPPORT", "cadastro@bkhost.com.br");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "ssl");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * PAGAR.ME
 */
define("CONF_PAGARME_MODE", "test");
define("CONF_PAGARME_LIVE", "ak_live_*****");
define("CONF_PAGARME_TEST", "ak_test_*****");
define("CONF_PAGARME_BACK", CONF_URL_BASE . "/pay/callback");
<?
//Basic initialization for one page
require_once 'php/crm/core/init.php';
$user = new User;
$lang = new Translation($user);
?>

<title><? echo $lang->get("GLOBAL_PAGE_TITLE")." ".$lang->get("GLOBAL_PAGE_TITLE_EXTRA"); ?></title>

<meta charset='UTF-8'>

<meta name='keywords' content=<? echo "'".$lang->get("GLOBAL_PAGE_KEYWORDS")."'";?> >
<meta name='description' content=<? echo "'".$lang->get("GLOBAL_PAGE_DESCRIPTION")."'"; ?> >
<meta http-equiv="language" content=<? echo "'".$lang->language_code."'"; ?> >

<meta name='HandheldFriendly' content='True'>
<meta http-equiv="Content-Type" content="text/html" />
<meta name="reply-to" content="support@maps4print.com" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta http-equiv="CONTENT-STYLE-TYPE" content="text/css" />
<meta name='date' content='Jan. 19, 2017'>

<link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
<link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="img/manifest.json">
<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#0d47a1">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="msapplication-config" content="img/browserconfig.xml">
<meta name="theme-color" content="#0D47A1" />
<link rel="search" href="opensearchdescription.xml" type="application/opensearchdescription+xml" title="Maps4Print" />
<!--end meta-->
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/devices.css">

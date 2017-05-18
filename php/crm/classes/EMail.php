<?
/**
* Class for sending HTML Emails
*/
class EMail
{
	public static function send($to, $subject, $html){

      $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      $headers = 	'From: noreply@maps4print.com' . "\r\n" .
					'Reply-To: support@maps4print.com'."\r\n".
					'MIME-Version: 1.0' . "\r\n".
					'Content-type: text/html; charset=utf-8' . "\r\n";

		mail($to , $subject , $html, $headers);
	}


}
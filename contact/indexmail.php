<?php

// 設定
$mail_to = 'info@tiltrotor.co.jp';
$mail_subject = 'お問い合わせメール[株式会社ティルトローター宛]'; 
$reply_subject = '株式会社ティルトローターより送信確認メール';
$mail_bcc = '';
$internal_enc = 'Shift_JIS'; 


// メイン
session_start();
if (!extension_loaded('mbstring')) Err('マルチバイト文字列関数が利用できません');
if (!$mail_to) Err('受取先メールアドレスが設定されてません');
if (!$_POST) Err('POSTデータがありません');
mb_language('ja');
mb_internal_encoding($internal_enc);
$x_mailer = '';
$mode = $_POST['mode'];

switch ($mode) {
case 'SEND':
	if (!$_SESSION) Err('セッションデータがありません');

	// メールヘッダ
	if (!$_SESSION['email']) $mail_from = 'S.B.Formmail';
	else $mail_from = $_SESSION['email'];
	$mail_header  = "From: {$mail_from}\n";
	if ($mail_bcc) $mail_header .= "Bcc: {$mail_bcc}\n";
	$mail_header .= "X-Mailer: {$x_mailer}";

	// メール送信
	include ('template.php');
	$mail_message = html_entity_decode($mail_message, ENT_QUOTES, $internal_enc);
	$mail_message = str_replace("<br />", "", $mail_message);
	$mail_message = str_replace("\t", "\n", $mail_message);
	$mail_message = mb_convert_encoding($mail_message, $internal_enc, 'AUTO');
	mb_send_mail($mail_to, $mail_subject, $mail_message, $mail_header);

	// メール自動返信
	if ($_SESSION['autoReply'] && $_SESSION['email'] && is_file('reply.php')) {
		$reply_header  = "From: {$mail_to}\n";
		if ($mail_bcc) $reply_header .= "Bcc: {$mail_bcc}\n";
		$reply_header .= "X-Mailer: {$x_mailer}";
		include ('reply.php');
		$reply_message = html_entity_decode($reply_message, ENT_QUOTES, $internal_enc);
		$reply_message = str_replace("<br />", "", $reply_message);
		$reply_message = str_replace("\t", "\n", $reply_message);
		$reply_message = mb_convert_encoding($reply_message, $internal_enc, 'AUTO');
		mb_send_mail($mail_from, $reply_subject, $reply_message, $reply_header);
	}
	$_SESSION = array(); 
	session_unset();
	session_destroy();
	header('Location: ../contact/completion.html');
	break;

default: // 入力データ処理
	session_unset();
	foreach ($_POST as $key => $value) {
		list($name, $option) = explode(";", $key);
		if ($option == 's' && !$value) {
			$_SESSION[$name] = '<span class="ERR">必須項目です</span>';
			$error = 1;
		} 
		 else {
			if (is_array($value)) {
				$value = implode("\t", $value);
			}
		if (get_magic_quotes_gpc()) $value = stripslashes($value);
		$value = mb_convert_encoding($value, $internal_enc, 'AUTO');
		$value = mb_convert_kana($value, 'KV');
		$value = htmlspecialchars($value, ENT_QUOTES);
		$_SESSION[$name] = nl2br($value);
		}
	}
	$_SESSION['inputErr'] = $error;
	header('Location: http://tiltrotor.co.jp/contact/confirm.php');
}
exit;


function Err($err) { // エラー表示用
	$internal_enc = $GLOBALS['internal_enc'];
	echo <<<EOM
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset={$internal_enc}" />
<title>エラー：$err</title></head>
<body style="font-size: 12px; line-height: 1.8em;">
<strong>エラー : </strong>$err<br>
<input type="button" value="戻る" onclick="history.back();">
</body></html>
EOM;
	exit;
}

?>

<?php

// �ݒ�
$mail_to = 'info@tiltrotor.co.jp';
$mail_subject = '���₢���킹���[��[������Ѓe�B���g���[�^�[��]'; 
$reply_subject = '������Ѓe�B���g���[�^�[��著�M�m�F���[��';
$mail_bcc = '';
$internal_enc = 'Shift_JIS'; 


// ���C��
session_start();
if (!extension_loaded('mbstring')) Err('�}���`�o�C�g������֐������p�ł��܂���');
if (!$mail_to) Err('���惁�[���A�h���X���ݒ肳��Ă܂���');
if (!$_POST) Err('POST�f�[�^������܂���');
mb_language('ja');
mb_internal_encoding($internal_enc);
$x_mailer = '';
$mode = $_POST['mode'];

switch ($mode) {
case 'SEND':
	if (!$_SESSION) Err('�Z�b�V�����f�[�^������܂���');

	// ���[���w�b�_
	if (!$_SESSION['email']) $mail_from = 'S.B.Formmail';
	else $mail_from = $_SESSION['email'];
	$mail_header  = "From: {$mail_from}\n";
	if ($mail_bcc) $mail_header .= "Bcc: {$mail_bcc}\n";
	$mail_header .= "X-Mailer: {$x_mailer}";

	// ���[�����M
	include ('template.php');
	$mail_message = html_entity_decode($mail_message, ENT_QUOTES, $internal_enc);
	$mail_message = str_replace("<br />", "", $mail_message);
	$mail_message = str_replace("\t", "\n", $mail_message);
	$mail_message = mb_convert_encoding($mail_message, $internal_enc, 'AUTO');
	mb_send_mail($mail_to, $mail_subject, $mail_message, $mail_header);

	// ���[�������ԐM
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

default: // ���̓f�[�^����
	session_unset();
	foreach ($_POST as $key => $value) {
		list($name, $option) = explode(";", $key);
		if ($option == 's' && !$value) {
			$_SESSION[$name] = '<span class="ERR">�K�{���ڂł�</span>';
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


function Err($err) { // �G���[�\���p
	$internal_enc = $GLOBALS['internal_enc'];
	echo <<<EOM
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset={$internal_enc}" />
<title>�G���[�F$err</title></head>
<body style="font-size: 12px; line-height: 1.8em;">
<strong>�G���[ : </strong>$err<br>
<input type="button" value="�߂�" onclick="history.back();">
</body></html>
EOM;
	exit;
}

?>

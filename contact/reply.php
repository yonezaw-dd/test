<?php
//ユーザー情報
$user  = @gethostbyaddr($_SERVER['REMOTE_ADDR']) . "\n";
$user .= $_SERVER['HTTP_USER_AGENT'] . "\n";
$user .= date("Y/m/d - H:i:s");

//送信メッセージ
$reply_message = <<< EOM
以下の内容で送信を受け付けました。
────────────────────────────────────
■御社名
{$_SESSION['name']}

■業種
{$_SESSION['job']}

■御社ホームページアドレス
{$_SESSION['add']}

■ご担当者様名
{$_SESSION['tanto']}

■ご担当者様名フリガナ
{$_SESSION['tantof']}

■郵便番号
{$_SESSION['yuubin']}

■所在地
{$_SESSION['syozai']}

■電話番号
{$_SESSION['tel']}

■メールアドレス
{$_SESSION['email']}

■内容
{$_SESSION['naiyo']}
────────────────────────────────────
□ユーザー情報
{$user}
EOM;
?>
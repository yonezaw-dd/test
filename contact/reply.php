<?php
//���[�U�[���
$user  = @gethostbyaddr($_SERVER['REMOTE_ADDR']) . "\n";
$user .= $_SERVER['HTTP_USER_AGENT'] . "\n";
$user .= date("Y/m/d - H:i:s");

//���M���b�Z�[�W
$reply_message = <<< EOM
�ȉ��̓��e�ő��M���󂯕t���܂����B
������������������������������������������������������������������������
����Ж�
{$_SESSION['name']}

���Ǝ�
{$_SESSION['job']}

����Ѓz�[���y�[�W�A�h���X
{$_SESSION['add']}

�����S���җl��
{$_SESSION['tanto']}

�����S���җl���t���K�i
{$_SESSION['tantof']}

���X�֔ԍ�
{$_SESSION['yuubin']}

�����ݒn
{$_SESSION['syozai']}

���d�b�ԍ�
{$_SESSION['tel']}

�����[���A�h���X
{$_SESSION['email']}

�����e
{$_SESSION['naiyo']}
������������������������������������������������������������������������
�����[�U�[���
{$user}
EOM;
?>
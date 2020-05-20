<?php
session_start();
if (SID) Err('Cookieを有効にして下さい');
if (!$_SESSION) header('Location: completion.html');
function Err($err) {
echo <<< EOM
<html><head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KQGKL9R');</script>
<!-- End Google Tag Manager -->


<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>エラー：$err</title></head>

<body style="font-size: 12px; line-height: 1.8em;">
<strong>エラー : </strong>$err<br>
<input type="button" value="戻る" onclick="history.back();">
</body></html>
EOM;
exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<meta HTTP-EQUIV="CONTENT-STYLE-TYPE" CONTENT="style.css">
<title>株式会社 ティルトローター</title>
<link href="../style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-device-width: 480px)" href="../iphone.css" />
<link rel="stylesheet" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" href="../ipad.css" />
<link rel="stylesheet" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" href="../ipad2.css" />
<script type="text/javascript" src="../script/jquery-1.5.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.accordion_menu').click(function() {
        $(this).next().slideToggle();
    }).next().hide();
});
</script>

</head>


<body>

<div id="base">
	<div class="menu">
		<h1><a href="../index.html"><img src="../images/logo.jpg" width="179" height="17" border="0"></a></h1>
		<div class="menuicon">
	       <h2><a href="../index.html"><img src="../images/menu_01.jpg" width="182" height="29" border="0" onMouseOver="this.src='../images/menu_over_01.jpg'" onMouseOut="this.src='../images/menu_01.jpg'"></a></h2>
	      <h2><a href="../recruit/index.html"><img src="../images/menu_02.jpg" width="182" height="37" border="0" onMouseOver="this.src='../images/menu_over_02.jpg'" onMouseOut="this.src='../images/menu_02.jpg'"></a></h2>
          <h2 class="accordion_menu"><img src="../images/menu_03.jpg" width="182" height="39" border="0" onMouseOver="this.src='../images/menu_over_03.jpg'" onMouseOut="this.src='../images/menu_03.jpg'"></h2>
	      <p class="accordion_in"><a href="../novelty/index.html"><img src="../images/menu_06.jpg" width="182" height="24" border="0" onMouseOver="this.src='../images/menu_over_06.jpg'" onMouseOut="this.src='../images/menu_06.jpg'"></a></br>
		    <a href="../officeshop/index.html"><img src="../images/menu_07.jpg" width="182" height="23" border="0" onMouseOver="this.src='../images/menu_over_07.jpg'" onMouseOut="this.src='../images/menu_07.jpg'"></a></br>
		    <a href="../webdesign/index.html"><img src="../images/menu_08.jpg" width="182" height="25" border="0" onMouseOver="this.src='../images/menu_over_08.jpg'" onMouseOut="this.src='../images/menu_08.jpg'"></a></br>
		    <a href="../system/index.html"><img src="../images/menu_10.jpg" width="182" height="25" border="0" onMouseOver="this.src='../images/menu_over_10.jpg'" onMouseOut="this.src='../images/menu_10.jpg'"></a></br>
		    <a href="../movie/index.html"><img src="../images/menu_09.jpg" width="182" height="19" border="0" onMouseOver="this.src='../images/menu_over_09.jpg'" onMouseOut="this.src='../images/menu_09.jpg'"></a></p>
	      <h2><a href="../recruit/index.html"><img src="../images/menu_04.jpg" width="182" height="29" border="0" onMouseOver="this.src='../images/menu_over_04.jpg'" onMouseOut="this.src='../images/menu_04.jpg'"></a></h2>
	      <h2><img src="../images/menu_over_05.jpg" width="182" height="33" border="0" /></h2>
	  </div>
        <div class="cr">&copy;2002 <span style="color:#CC6600">TILTROTOR inc.</span><br />
        All Rights Reserved. </div>
	</div>
		<div class="main_cont">
        	<div class="cont_right">
            <img src="../images/icon_contact.jpg" width="107" height="36" alt="Contact" />
			<div class="cont_text">下記のフォームに必要事項をご入力の上、「入力内容を確認する」ボタンを押してください。<br />
			担当者より、回答・返信させていただきます。<br />
			お見積もりなどのご相談、お問い合わせ、スタッフ一同心よりお待ちしております。</div>
            <div class="cont_box">
				<form action="../contact/indexmail.php" method="post">
                <table border="0"><tbody>
                <tr>
                <td class="cont_1">御社名</td>
                <td><?=$_SESSION['name']?></td><td class="cont_orange">※必須</td>
                </tr>
                <tr>
                <td class="cont_1">業種</td>
                <td><?=$_SESSION['job']?></td>
                </tr>
                <tr>
                <td class="cont_1">御社ホームページアドレス</td>
                <td><?=$_SESSION['add']?></td>
                </tr>
                <tr>
                <td class="cont_1">ご担当者様名</td>
                <td><?=$_SESSION['tanto']?></td><td class="cont_orange">※必須</td>
                </tr>
                <tr>
                <td class="cont_1">ご担当者様名フリガナ</td>
                <td><?=$_SESSION['tantof']?></td><td class="cont_orange">※必須</td>
                </tr>
                <tr>
                <td class="cont_1">郵便番号</td>
                <td>〒<?=$_SESSION['yuubin']?></td><td class="cont_orange">※必須</td>
                </tr><tr>
                <td class="cont_1">所在地</td>
                <td><?=$_SESSION['syozai']?></td><td class="cont_orange">※必須</td>
                </tr>
                <tr>
                <td class="cont_1">電話番号</td>
                <td><?=$_SESSION['tel']?></td>
                </tr>
                <tr>
                <td class="cont_1">メールアドレス</td>
                <td><?=$_SESSION['email']?></td><td class="cont_orange">※必須</td>
                </tr>
                <tr>
                <td class="cont_2">内容</td>
                <td class="cont_3"><p>
                    <?=$_SESSION['naiyo']?></td><td class="cont_orange">※必須</td>
                </tr><th colspan="2" class="Submit"><?php
//入力項目エラー判定
if($_SESSION['inputErr']){
	echo'<input type="button" value="戻 る" onclick="history.back()" style="width:80px" />';
}else{
	echo'<p class="cont_4">入力が正しければ、送信ボタンを押して下さい。</p>
<input name="mode" type="hidden" id="mode" value="SEND" />
<input type="image" src="../images/send_1.jpg" style="width:80px" value="送 信" />
<input type="image" src="../images/send_2.jpg" value="戻 る" onclick="history.back()" style="width:80px" />';
}
?></th>
                </tbody></table></form>
			</div>
</div></div></div>
<div id="foot">
</div>




</body>
</html>

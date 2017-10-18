jQuery(document).ready(function( $ ) {

	$('#backtoblog a').prop('title','返回首页');

	$('form#loginform').prepend('<h2>请输入用户名和密码：</h2><br class="clear">');
	$('form#lostpasswordform').prepend('<h2>输入所需的信息，您将通过电子邮件收到新密码。</h2><br class="clear">');
	$('form#resetpassform').prepend('<h2>在下面输入您的新密码：</h2><br class="clear">');

	$('form#registerform').prepend('<h2>创建您自己的个性化帐户，密码<br />将通过电子邮件发送。</h2><br class="clear">');
	//$('form').prepend('<p class="ver"><a href="#">品牌的登录屏幕3.2</a></p>');

	//TODO: make the alert boxes look prettier. :)

	$("p.reset-pass:contains('在下面输入您的新密码：')").hide();

	$("p.reset-pass:contains('您的密码已重设！')").show().addClass('backtologin').removeClass('message').removeClass('reset-pass');
});
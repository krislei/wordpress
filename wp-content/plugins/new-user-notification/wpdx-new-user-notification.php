<?php
/*
  Plugin Name: WPDX New User Notification
  Description:重新定义新用户注册邮件
  Version: 1.0
 */
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);
        //获取用户名和邮箱
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
        //获取管理员邮箱和博客名称
        $admin_email = stripslashes(get_option('admin_email'));
        $blog_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
        //自定义管理员邮件
        $headers = 'From: '.$blog_name.' <'.$admin_email.'>';
        $headers .= 'MIME-Version: 1.0';
        $headers .= 'Content-type: text/html; charset=uft-8';
        $headers .= 'Content-Transfer-Encoding: 8bit';
 
        $message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><div>';
        $message .= '<p>'.sprintf(__('你的网站[%s] 有新用户注册:'), $blog_name ) . '</p>';
        $message .= '<p>'.sprintf(__('Username: %s'), $user_login) . '</p>';
        $message .= '<p>'.sprintf(__('E-mail: %s'), $user_email) . '</p></div></body></html>';
 
        @wp_mail($admin_email, sprintf(__('[%s] New User Registration'), $blog_name), $message, $headers);
        //判断新用户密码是否为空
        if ( empty($plaintext_pass) )
            return;
        //自定义新用户欢迎邮件
        $headers = 'From: '.$blog_name.' <'.$admin_email.'>';
        $headers .= 'MIME-Version: 1.0';
        $headers .= 'Content-type: text/html; charset=uft-8';
        $headers .= 'Content-Transfer-Encoding: 8bit';
 
        $message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><div>';
        $message .= '<p>'.__('亲爱的：') .$user_login. '</p>';
        $message .= '<p>这是由康赛在线服务中心（www.service.comsys.net.cn）发来的邮件。</p>';
        $message .= '<p>首先恭喜贵校项目顺利通过验收，成为我们售后客户一员，我们已经展开热情的怀抱欢迎您。我们这里有漂亮的客服妹子与专业的服务工程师，我们将竭诚为您的项目服务！</p>';
        $message .= '<p>您的账号信息如下：</p>';
        $message .= '<p>'.sprintf(__('Username: %s'), $user_login) . '</p>';
        $message .= '<p>'.sprintf(__('Password: %s'), $plaintext_pass) . '</p>';
        $message .= '<p>请妥善保存好自己的账户信息，如果您忘记密码，可以通过登录窗口的密码找回功能找回密码，或者联系我们服务人员帮您重置密码</p>';
        $message .= '<p>加入我们的微信，可及时获取我司最新动态！</p>';
        $message .= '<p><img src="http://service.comsys.net.cn/wp-content/uploads/2015/10/qrcode_chengdu_comsys_1.jpg" /></p></div></body></html>';
 
        @wp_mail($user_email, sprintf(__('[%s] Your username and password'), $blog_name), $message , $headers);
 
    }
    //让邮件支持html
    add_filter( 'wp_mail_content_type', 'wpdx_set_html_content_type' );
    function wpdx_set_html_content_type() {
        return 'text/html';
    }
}
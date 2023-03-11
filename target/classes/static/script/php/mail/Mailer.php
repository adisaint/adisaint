<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendRegisterCode($to, $code): bool
{
    return sendEmail($to, "欢迎注册Adisaint", "<h3>欢迎注册</h3><p>【JitSaint】验证码: $code, 此验证码用只于账号注册, 5分钟内有效。</p>", "【JitSaint】验证码: $code, 此验证码用只于账号注册, 5分钟内有效。");
}


function sendEmail($to, $subject, $body, $altBody): bool
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet = "UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.163.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = 'jitsain@163.com';                // SMTP 用户名  即邮箱的用户名
        $mail->Password = 'FNJVDVHPELXOKDOW';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

        $mail->setFrom('jitsain@163.com', 'Adisaint');  //发件人
        $mail->addAddress($to, 'You');  // 收件人
        //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
        $mail->addReplyTo('jitsain@163.com', 'info'); //回复的时候回复给哪个邮箱 建议和发件人一致
        //$mail->addCC('cc@example.com');                    //抄送
        //$mail->addBCC('bcc@example.com');                    //密送

        //发送附件
        // $mail->addAttachment('../xy.zip');         // 添加附件
        // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

        //Content
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $altBody;

        $mail->send();
//        echo '邮件发送成功';
        return true;
    } catch (Exception) {
//        echo '邮件发送失败: ', $mail->ErrorInfo;
        return false;
    }
}
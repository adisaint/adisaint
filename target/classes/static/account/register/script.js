var sendCodeCount = 0;


function checkSubmit() {
    let user = $("#input_username").val();
    let mail = $("#input_email").val();
    let code = $("#input_code").val();
    let pwd = $("#input_password").val();
    let accept = document.forms["register"]["accept"].checked;
    if (user === "" || mail === "" || code === "" || accept !== true) {
        if (user === "") $("#username_tip").html("<br/>用户名不可为空"); else $("#username_tip").html("");
        if (mail === "") $("#email_tip").html("<br/>邮箱不可为空"); else $("#email_tip").html("");
        if (pwd === "") $("#password_tip").html("<br/>密码不可为空"); else $("#password_tip").html("");
        if (code === "") $("#code_tip").html("<br/>验证码不可为空"); else $("#code_tip").html("");
        if (accept !== true) $("#accept_tip").html("<br/>请阅读并同意服务协议和隐私政策"); else $("#accept_tip").html("");
        return false;
    } else {
        let res = true;
        if (!isUsername(user)) {
            $("#username_tip").html("<br/>用户名格式错误");
            res = false;
        } else {
            $.post("request.php", {username: user, event: "get_username_exists"}, function (data, status) {
                if (data === "true" || data === "false") {
                    if (data === "true") {
                        $("#username_tip").html("<br/>用户名已存在");
                        res = false;
                    } else $("#username_tip").html("");
                } else {
                    alert("Fatal Error");
                    res = false;
                }
            });
        }
        if (!isEmail(mail)) {
            $("#email_tip").html("<br/>邮箱格式错误");
            res = false;
        } else {
            $.post("request.php", {
                email: mail, event: "get_email_exists"
            }, function (data, status) {
                if (data === "true" || data === "false") {
                    {
                        if (data === "true") {
                            $("#email_tip").html("<br/>邮箱已被绑定");
                            res = false;
                        } else $("#email_tip").html("");
                    }
                } else {
                    alert("Error");
                    res = false;
                }
            });
        }
        if (!isPassword(pwd)) {
            $("password_tip").html("<br/>密码格式错误");
            res = false;
        } else $("password_tip").html("");
        if (sendCodeCount === 0) {
            $("#password_tip").html("<br/>请先发送验证码");
            res = false;
        } else {
            if (isCode(code)) {
                $.post("request.php", {
                    email: mail, code: code, event: "verify_verification_code"
                }, function (data, status) {
                    if (data === "ok") $("#code_tip").html(""); else {
                        $("#password_tip").html("<br/>验证码错误或已失效");
                        res = false;
                    }
                });
            } else {
                $("#password_tip").html("<br/>验证码无效");
                res = false;
            }
        }
        return res;
    }
}


function sendCode(button) {
    let mail = $("#input_email").val();
    let code = $("#input_code").val();
    if (mail === "") {
        $("email_tip").html("<br/>邮箱不可为空");
        return;
    } else $("email_tip").html("");
    if (isEmail(mail)) {
        let res = false;
        $.post("script/request.php", {
            email: mail, event: "get_email_exists"
        }, function (data, status) {
            if (data === "true" || data === "false") {
                {
                    if (data === "true") {
                        $("email_tip").html("<br/>邮箱已被绑定");
                    } else {
                        $("email_tip").html("");
                        res = true;
                    }
                }
            }
        });
        if (res) {
            $.post("request.php", {
                email: mail, code: code, event: "send_verification_code"
            }, function (data, status) {
                if (data === "ok") {
                    sendCodeCount++;
                    $("email_tip").html("");
                    time_down(button);
                } else {
                    alert("发送失败\ndata: " + data + "\nstatus: " + status);
                }
            });
        }
    } else {
        $("email_tip").html("<br/><span>邮箱格式错误</span>");
        $("#input_email").val("");
    }
}


function checkUsername() {
    let user = $("#input_username").val();
    if (user === "") $("#username_tip").html("<br/>用户名不可为空"); else $("#username_tip").html("");
    if ((!isUsername(user) && user.length >= 5) || isOneNumber(user[0])) $("#username_tip").html("<br/>用户名格式错误"); else $("#username_tip").html("");
}


function checkPassword() {
    let pwd = $("#input_password").val();
    let tip = document.getElementById("password_tip");
    if (pwd === "") $("#password_tip").html("<br/>密码不可为空"); else $("#password_tip").html("");
    if (!isPassword(pwd) && pwd.length >= 5) tip.innerHTML = "<br/>密码格式错误"; else tip.innerHTML = "";
}

function checkEmail() {
    let email = document.forms["register"]["email"].value;
    let tip = document.getElementById("email_tip");
    if (email === "") tip.innerHTML = "<br/>邮箱不可为空"; else tip.innerHTML = "";
    if (!isEmail(email) && email.length >= 5) tip.innerHTML = "<br/>邮箱格式错误"; else tip.innerHTML = "";
}

var codeTipCount = 0;

function checkCode() {
    let code = document.forms["register"]["code"].value;
    let tip = document.getElementById("code_tip");
    if (code === "") {
        if (codeTipCount === 0) {
            codeTipCount++;
        } else {
            tip.innerHTML = "<br/>验证码不可为空";
        }

    } else tip.innerHTML = "";
    if (!isOneNumber(code[0]) || code[0] === undefined) tip.innerHTML = "<br/>验证码无效"; else tip.innerHTML = "";
}
function checkCommit() {
    let user = $("#user").val().trim();
    let pwd = $("#pwd").val().trim();
    let res = false;
    if (user === "") $("#user_tip").text("请输入用户名");
    else {
        $("#user_tip").text("");
        res = true;
    }
    if (pwd === "") $("#pwd_tip").text("请输入密码");
    else {
        $("#pwd_tip").text("");
        res = true;
    }
    return res;
}
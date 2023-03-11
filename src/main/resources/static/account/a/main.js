function checkCommit() {
    let inputUsername = document.forms["login"]["username"].value;
    let inputPassword = document.forms["login"]["password"].value;
    let inputAccept = document.forms["login"]["accept"].value;
    let usernameTip = document.getElementById("username_tip");
    let passwordTip = document.getElementById("password_tip");
    let acceptTip = document.getElementById("accept_tip");
    if (inputUsername === "" || inputPassword === "" || inputAccept !== "accepted") {
        if (inputUsername === "") {
            usernameTip.innerHTML = "<br/><span>用户名不可为空</span>";
        } else {
            usernameTip.innerHTML = "";
        }
        if (inputPassword === "") {
            passwordTip.innerHTML = "<br/><span>密码不可为空</span>";
        } else {
            passwordTip.innerHTML = "";
        }
        if (inputAccept === "accepted") {
            acceptTip.innerHTML = "<br/><span>请阅读并同意服务协议和隐私政策</span>";
        } else {
            acceptTip.innerHTML = "";
        }
        return false;
    } else {
        if (inputUsername !== "") {
            usernameTip.innerHTML = "";
        }
        if (inputPassword !== "") {
            passwordTip.innerHTML = "";
        }
        if (inputAccept === "accepted") {
            acceptTip.innerHTML = "";
        }
        return true;
    }
}
var sendCodeCount = 0;


function sendCode(button) {
    let inputEmail = document.forms["login"]["email"].value;
    let emailTip = document.getElementById("email_tip");
    if (inputEmail === "") {
        emailTip.innerHTML = "<br/><span>邮箱不可为空</span>";
        return;
    } else {
        emailTip.innerHTML = "";
    }
    if (isEmail(inputEmail)) {
        sendCodeCount++;
        emailTip.innerHTML = "";
        time_down(button);
        sendEmail(inputEmail);
    } else {
        emailTip.innerHTML = "<br/><span>邮箱格式错误</span>";
        document.forms["login"]["email"].innerHTML = "";
    }
}


function checkCommit() {
    let inputEmail = document.forms["login"]["email"].value;
    let inputCode = document.forms["login"]["code"].value;
    let inputAccept = document.forms["login"]["accept"].value;
    let emailTip = document.getElementById("email_tip");
    let codeTip = document.getElementById("code_tip");
    let acceptTip = document.getElementById("accept_tip");
    if (inputEmail === "" || inputCode === "" || inputAccept !== "accepted") {
        if (inputEmail === "") emailTip.innerHTML = "<br/><span>邮箱不可为空</span>"; else emailTip.innerHTML = "";
        if (inputCode === "") codeTip.innerHTML = "<br/><span>验证码不可为空</span>"; else codeTip.innerHTML = "";
        if (inputAccept === "accepted") acceptTip.innerHTML = "<br/><span>请阅读并同意服务协议和隐私政策</span>"; else acceptTip.innerHTML = "";
        return false;
    } else {
        let res = true;
        emailTip.innerHTML = "";
        codeTip.innerHTML = "";
        acceptTip.innerHTML = "";
        if (sendCodeCount === 0) {
            codeTip.innerHTML = "<br/><span>请先发送验证码</span>";
            res = false
        } else {
            codeTip.innerHTML = "";
        }
        return res;
    }
}


function sendEmail() {

}
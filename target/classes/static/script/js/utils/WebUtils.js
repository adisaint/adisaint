function into(url) {
    window.location.href = url;
}

function getUrlParam(name) {
    let reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    let r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return decodeURI(r[2]);
    }
    return null;
}

function sleep(numberMillis) {
    let now = new Date();
    let exitTime = now.getTime() + numberMillis;
    while (true) {
        now = new Date();
        if (now.getTime() > exitTime)
            return;
    }
}


// 验证码倒计时
function time_down(button) {
    let clock = '';
    let nums = 60;
    button.disabled = true;
    button.value = nums + '秒后可重新获取';

    function doLoop() {
        nums--;
        if (nums > 0) {
            button.value = nums + '秒后可重新获取';
        } else {
            clearInterval(clock);
            button.disabled = false;
            button.value = '获取验证码';
            nums = 60;
        }
    }

    clock = setInterval(doLoop, 1000);
}
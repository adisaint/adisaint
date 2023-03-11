function isEmail(str) {
    return str.search(/^\w+((-\w+)|(\.\w+))*@[A-Za-z0-9]+(([.\-])[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) !== -1;
}

function getRandomInt(l, r) {
    return parseInt(l + Math.random() * (r - l + 1));
}

function isUsername(str) {
    return str.search(/^[a-zA-Z]\w{4,19}$/i) !== -1;
}

function isPassword(str) {
    return str.search(/^[a-zA-Z]\w{5,19}$/i) !== -1;
}

function isCode(str) {
    return str.search(/^[0-9]{4,6}$/i) !== -1;
}

function isOneNumber(str) {
    return str.search(/^[0-9]$/i) !== -1;
}

let buff = new Buffer('eyJyZWNoYXJnZV9hbW91bnQiOjIwMCwidHhuX2lkIjoiIiwiZ3N0X3BlcmN0IjoiMTgiLCJnc3RfYW1vdW50IjozNiwiZmlyc3RfdXNlciI6ZmFsc2UsInBsYW5faWQiOjJ9', 'base64');
let text = buff.toString('ascii');


function isBase64(str) {
    if (str ==='' || str.trim() ===''){ return false; }
    try {
        return btoa(atob(str)) == str;
    } catch (err) {
        return false;
    }
}

console.log(isBase64('eyJyZWNoYXJnZV9hbW91bnQiOjIwMCwidHhuX2lkIjoiIiwiZ3N0X3BlcmN0IjoiMTgiLCJnc3RfYW1vdW50IjozNiwiZmlyc3RfdXNlciI6ZmFsc2UsInBsYW5faWQiOjJ9'));

console.log(JSON.parse(text));
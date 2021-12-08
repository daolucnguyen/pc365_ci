const socket = io.connect('https://chat.timviec365.com', {
    secure: true,
    enabledTransports: ["https"],
    transports: ['websocket', 'polling']
});


function get_Cookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

const uid = get_Cookie('UID');
const uid_type = get_Cookie('UT');

const data_ol = { uid, uid_type };

socket.emit('checkonlineUser', data_ol);

socket.on('onlineUser', (candidate) => {

    console.log(candidate);
});
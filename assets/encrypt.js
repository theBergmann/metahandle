function create_aes_key(password, salt) {
    console.log("start encrypting");
        var pwd = password;
        var slt = salt;
        scrypt(pwd, slt, {
            N: 16384,
            r: 8,
            p: 1,
            dkLen: 16,
            encoding: 'hex'
        }, function(derivedKey) {
            key_256 = Array.from(derivedKey);
            key_256_array = new Uint8Array(key_256);
            return key_256_array;
        });
    }

function create_aes_key_old(password, salt) {
    console.log("start encrypting old");
     var pwd = password;
        var slt = salt;
        scrypt(pwd, slt, {
            N: 16384,
            r: 8,
            p: 1,
            dkLen: 16,
            encoding: 'hex'
        }, function(derivedKey) {
            key_256 = Array.from(derivedKey);
            key_256_array = new Uint8Array(key_256);
            return key_256_array;
        });
}

function create_aes_key_light(password, salt) {
    console.log("start encrypting light");
    var pwd = password;
        var slt = salt;
        scrypt(pwd, slt, {
            N: 2156,
            r: 8,
            p: 1,
            dkLen: 16,
            encoding: 'hex'
        }, function(derivedKey) {
            key_256 = Array.from(derivedKey);
            key_256_array = new Uint8Array(key_256);
            return key_256_array;
        });
}


function create_aes_key_extra_light(password) {
    console.log("creating extra light key");
    var pwd = password;
    var slt = password;
        scrypt(pwd, slt, {
            N: 128,
            r: 8,
            p: 1,
            dkLen: 16,
            encoding: 'hex'
        }, function(derivedKey) {
            key_256 = Array.from(derivedKey);
            key_256_array = new Uint8Array(key_256);
        });
}


function create_aes_key_strong(password, salt) {
    console.log("creating strong key");
    var pwd = password;
    var slt = password;
        scrypt(pwd, slt, {
            N: 1048576,
            r: 8,
            p: 1,
            dkLen: 16,
            encoding: 'hex'
        }, function(derivedKey) {
            key_256 = Array.from(derivedKey);
            key_256_array = new Uint8Array(key_256);
        });
}

// N: 1048576 ca. 8 Sek.


function create_aes_key_extra_strong(password, salt) {
    console.log("creating strong key");
    var pwd = password;
    var slt = password;
        scrypt(pwd, slt, {
            N: 1048576,
            r: 8,
            p: 1,
            dkLen: 16,
            encoding: 'hex'
        }, function(derivedKey) {
            pwd = Array.from(derivedKey);
            console.log("creating strong key");
            scrypt(pwd, slt, {
                N: 1048576,
                r: 8,
                p: 1,
                dkLen: 16,
                encoding: 'hex'
            }, function(derivedKey) {
                key_256 = Array.from(derivedKey);
            key_256_array = new Uint8Array(key_256);
            });
            
              //key_256 = Array.from(derivedKey);
            //key_256_array = new Uint8Array(key_256);
        });
}


// alles über x²20 zu groß. Daher muss man sie koppeln, der key_256 wird zum password, und so weiter. Je Runde dauert es 10 Sekunden. 
    
    function dec2hex (dec) {
            return ('0' + dec.toString(16)).substr(-2)
        }
    
    function generateId (length) {
          var arr = new Uint8Array((length || 40) / 2)
          window.crypto.getRandomValues(arr)
          return Array.from(arr, dec2hex).join('')
        }
    
    
    function encrypt_it(message){
        var text = message;
        var textBytes = aesjs.utils.utf8.toBytes(text);
        var aesCtr = new aesjs.ModeOfOperation.ctr(key_256_array, new aesjs.Counter(5));
        encryptedBytes = aesCtr.encrypt(textBytes);
        encryptedHex = aesjs.utils.hex.fromBytes(encryptedBytes);
        // When ready to decrypt the hex string, convert it back to bytes
        encryptedBytes = aesjs.utils.hex.toBytes(encryptedHex);
        return encryptedBytes;
    
    }
    
    function decrypt_it(message) { 
        var encryptedHex = message;
        var encryptedBytes = aesjs.utils.hex.toBytes(encryptedHex);
        // create_aes_key(password, salt);
        // The counter mode of operation maintains internal state, so to
        // decrypt a new instance must be instantiated.
        var aesCtr = new aesjs.ModeOfOperation.ctr(key_256_array, new aesjs.Counter(5));
        var decryptedBytes = aesCtr.decrypt(encryptedBytes);
        // Convert our bytes back into text
        decryptedText = aesjs.utils.utf8.fromBytes(decryptedBytes);
        return decryptedText;
        //document.getElementById("one").innerHTML = decryptedText;
        // "Text may be any length you wish, no padding is required."

    }
    

    
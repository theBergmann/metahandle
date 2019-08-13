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
        //document.getElementById("one").innerHTML = decryptedText;
        // "Text may be any length you wish, no padding is required."

    }
    

    

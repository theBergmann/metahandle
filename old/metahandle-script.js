function button() { 
        var salt = generateId(128);
        create_aes_key(handle, salt);
        encrypt_it(description);
        encdesc = encryptedHex;
        encrypt_it(title)
        enctitle = encryptedHex;
        if (type == 2) {
            encrypt_it(txidd);
            txid = encryptedHex;
            version_number = "010202";
        }
        else {
            txid = txidd;
            version_number = "010102";
        }
        var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + version_number, "" + txid, "" + enctitle, "" + encdesc, "" + salt]).toASM();
        document.getElementById("mbuttonload").innerHTML = "<img src='https://acegif.com/wp-content/uploads/loading-40.gif' width=60px />";
        
        const div = document.getElementById("mbutton");
        moneyButton.render(div, {
          outputs: [{
            type: 'SCRIPT',
            script: returndata,
            amount: '0',
            currency: 'BSV'
          }],
          label: "Publish",
          onPayment: function () { 
             document.getElementById("mbutton").innerHTML="<form action='metahandle.php' method='post' id='form'><input type='hidden' name='handle' value='" + handle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='savehandlename' value='" + handle + "'><img src='owlwithtie.jpg' onload='submitform()'></form>";
          },
          onError: function (arg) { console.log('onError', arg) }
        });
        
        
        let privKey = bsv.PrivateKey.fromRandom();
        const payment = proxypay({
            key: privKey,
            outputs: [
                { data: ['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', version_number, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt] }
            ],
            onPayment(tx) { document.getElementById("mbutton").innerHTML="<form action='metahandle.php' method='post' id='form'><input type='hidden' name='handle' value='" + handle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='savehandlename' value='" + handle + "'><img src='owlwithtie.jpg' onload='submitform()'></form>" }
        })
        document.getElementById("proxypay").innerHTML = `<br /><strong>No MoneyButton? No problem!</strong><br /> Fund the handle-transaction with ProxyPay by sending:<br /> ${ payment.fee } satoshis to <b>${ payment.address }</b> <br />or use this payment URI (click or copy to your send field)<br /> <a href='` +  payment.bip21URI + `'>` + payment.bip21URI + `</a><br /><img src='https://api.qrserver.com/v1/create-qr-code/?data=` + payment.bip21URI + `&size=130x130&margin=10' />`;
}


function submitform(){
        document.getElementById('form').submit();
}

function crawl() {
        window.location = "metahandle.php";
}

function store() {
        window.location = "metahandle-old.php?store=1";
}
    
    

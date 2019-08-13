<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <title>Metahandle - bookmark and tag onchain files onchain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="handle-favicon.png">
    <link rel="stylesheet" href="/assets/style.css">
     
    <meta name="description" content="Metahandle: Gatewaxy to Bitcoin onchain content">
  <meta name="keywords" content="metanate, BSV, onchain, opreturn, tag, bookmark">
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet"> 
  <!--<script type="text/javascript" src="https://cdn.rawgit.com/ricmoo/aes-js/e27b99df/index.js"></script>-->
     <script src="/assets/aes-js-index.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>-->
    <script type="text/javascript" src="/assets/aes.js"></script>
    <script type="text/javascript" src="/assets/scrypt-async.js" ></script>
    <script type="text/javascript" src="/assets/aes-js.js" ></script>
       <script type="text/javascript" src="/assets/bsv.min.js" ></script>
        <!--<script src="//cdn.jsdelivr.net/npm/vue"></script>-->
    <script type="text/javascript" src="/assets/vue.js" ></script>
  <!--<script src="//unpkg.com/bsv@0.27.2"></script>-->
  <!--<script src="//unpkg.com/proxypay/dist/proxypay.min.js"></script>-->
  <script type="text/javascript" src="/assets/proxypay.min.js"></script>
 <!-- <script src="//unpkg.com/qrcode-generator"></script>-->
  <script src="qrcode.js"></script>
        <script type="text/javascript" src="/assets/encrypt.js" ></script>
    <link rel="icon" type="image/png" href="/assets/handle-favicon.png">
    <!--<script src="https://asecuritysite.com/sha256.js" ></script>-->
    <script src="/assets/sha256.js" ></script>
    

    
        
        
  
</head>

<script>
    function submitform(){
        document.getElementById('form').submit();
    }
    function crawl() {
        window.location = "metahandle-tags.php";
    }
    
    function store() {
        window.location = "metahandle-tags.php?store=1";
    }
    
    function submitForm(action) {
        var form = document.getElementById('form1');
        form.action = action;
        form.submit();
    }
    
</script>
<script>
    function button() { 
        document.getElementById("mbuttonload").innerHTML = "<img src='loading-40.gif' width=60px />";
        var salt = generateId(128);
        if (type == '010202' || type == '010401' || type == '020201' || type == 
        '020401') {
            create_aes_key(newhandle, salt);
            encrypt_it(txidd);
            txid = encryptedHex;
        }
        else {
            create_aes_key_extra_light(newhandle);
            txid = txidd;
        }
        encrypt_it(description);
        encdesc = encryptedHex;
        encrypt_it(title);
        enctitle = encryptedHex;
        if (type == '010303' || type == '020402' || type == '010402' || type == '020303') {
            let tagarray = [];
            tagarrayclear = [];
            let tagends = [];
            length = tags.length;
            for (i=0; i<length; i++) {
                var char = tags.substr(i,1);
                if (char == ",") {
                    tagends.push(i);
                    if (tagends.length == 1) {
                        var onetag = tags.substr(0,i);
                        tagarrayclear.push(onetag);
                        onetag = hex_sha256(onetag);
                        tagarray.push(onetag);
                    }
                    else if (tagends.length == 2) {
                        var tagstart = tagends[0] + 1;
                        if (tags.substr(tagstart,1) == " ") {
                            tagstart = tagstart + 1;
                        }
                        var nexttag = tags.substr(tagstart, (i - tagstart));
                        tagarrayclear.push(nexttag);
                        nexttag = hex_sha256(nexttag);
                        tagarray.push(nexttag);
                    }
                }
                else if (i == (length - 1)) {
                    var tagstart = tagends[1] + 1;
                    if (tags.substr(tagstart,1) == " ") {
                        tagstart = tagstart + 1;
                    }
                    var nexttag = tags.substr(tagstart, i);
                    tagarrayclear.push(nexttag);
                    nexttag = hex_sha256(nexttag);
                    tagarray.push(nexttag);
                }
            }
            //console.log(tagarray);
            //console.log(tagarrayclear);
            k = 0;
            encarray = []
            for (i=0; i<tagarray.length; i++) {
                let e = i;
                if (type == "010303" || type == "020303") {
                    create_aes_key_extra_light(tagarrayclear[e]);
                }
                else {
                    create_aes_key(tagarrayclear[e], salt)
                }
                encrypt_it(newhandle);
                encarray.push(encryptedHex);
                decrypt_it(encarray[e]);
                k++;
            }
            
            //var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + type, "" + txid, "" + enctitle, "" + encdesc, "" + salt]).toASM();
            switch (k) {
                case 1:
                    var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + type, "" + txid, "" + enctitle, "" + encdesc, "" + salt, "" + tagarray[0], "" + encarray[0]]).toASM();
                    var proxydata = "'1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt, ' ', '" + tagarray[0] + "', ' ', '" + encarray[0] + "'";
                    break;
                case 2:
                    var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + type, "" + txid, "" + enctitle, "" + encdesc, "" + salt, "" + tagarcray[0], "" + encarray[0], "" + tagarray[1], "" + encarray[1]]).toASM();
                    var proxydata = "'1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt, ' ', '" + tagarray[0] + "', ' ', '" + encarray[0] + "', ' ', '" + tagarray[1] + "', ' ', '" + encarray[1] + "'";
                    break;
                case 3:
                    var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + type, "" + txid, "" + enctitle, "" + encdesc, "" + salt, "" + tagarray[0], "" + encarray[0], "" + tagarray[1], "" + encarray[1], "" + tagarray[2], "" + encarray[2]]).toASM();
                    var proxydata = "'1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt, ' ', '" + tagarray[0] + "', ' ', " + encarray[0] + ", ' ', '" + tagarray[1] + "', ' ', '" + encarray[1] + "', ' ', '" + tagarray[2]  + "', ' ', '" + encarray[2] + "'";
                    break;
            }
            
            // learn tags, encrypt newhandle with tags, and add it to returndata
        }
        else {
             var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + type, "" + txid, "" + enctitle, "" + encdesc, "" + salt]).toASM();
             var proxydata = "'1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt";
        }
        
        console.log(returndata);
        console.log(proxydata);
        
        if (type == '020102' || type == '020201' || type == '020302' || type == '020401') {
            const div = document.getElementById("mbutton");
            moneyButton.render(div, {
                outputs: [
                     {
                      address: addressvalue,
                      currency: 'BSV',
                      amount: value/10000000
                    },
                    {
                        type: 'SCRIPT',
                        script: returndata,
                        amount: '0',
                        currency: 'BSV'
                    }
              ],
              label: "Publish",
              onPayment: function () { 
                 document.getElementById("mbutton").innerHTML="<form action='search.php' method='post' id='form'><input type='hidden' name='handle' value='" + newhandle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='tag1' value='" + tagarrayclear[0] + "'><input type='hidden' name='tag2' value='" + tagarrayclear[1] + "'><input type='hidden' name='tag3' value='" + tagarrayclear[2] + "'><img src='owlwithtie.jpg' onload='submitform()'></form>";
              },
              onError: function (arg) { console.log('onError', arg) }
            });
            
            let privKey = bsv.PrivateKey.fromRandom();
            const payment = proxypay({
                key: privKey,
                outputs: [
                    { to: addressvalue, satoshis: value },
                    { data: ['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt] }
                ],
                onPayment(tx) { document.getElementById("mbutton").innerHTML="<form action='search.php' method='post' id='form'><input type='hidden' name='handle' value='" + newhandle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='tag1' value='" + tagarrayclear[0] + "'><input type='hidden' name='tag2' value='" + tagarrayclear[1] + "'><input type='hidden' name='tag3' value='" + tagarrayclear[2] + "'><img src='owlwithtie.jpg' onload='submitform()'></form>" }
            })
            paymentamount = payment.fee + Number(value);
            document.getElementById("proxypay").innerHTML = `<br /><strong>No MoneyButton? No problem!</strong><br /> Fund the handle-transaction with ProxyPay by sending:<br />` + paymentamount + ` satoshis to <b>${ payment.address }</b> <br />or use this payment URI (click or copy to your send field)<br /> <a href='` +  payment.bip21URI + `'>` + payment.bip21URI + `</a><br /><img src='https://api.qrserver.com/v1/create-qr-code/?data=` + payment.bip21URI + `&size=130x130&margin=10' /><br />In case something goes wrong, here's the Private Key ` + privKey;
            
        
        }
        else {
            console.log(tagarrayclear);
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
                 document.getElementById("mbutton").innerHTML="<form action='search.php' method='post' id='form'><input type='hidden' name='handle' value='" + newhandle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='tag1' value='" + tagarrayclear[0] + "'><input type='hidden' name='tag2' value='" + tagarrayclear[1] + "'><input type='hidden' name='tag3' value='" + tagarrayclear[2] + "'><img src='owlwithtie.jpg' onload='submitform()'></form>";
              },
              onError: function (arg) { console.log('onError', arg) }
            });
            
            
            let privKey = bsv.PrivateKey.fromRandom();
            const payment = proxypay({
                key: privKey,
                outputs: [
                    { data: ['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehashin, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt] }
                ],
                onPayment(tx) { document.getElementById("mbutton").innerHTML="<form action='search.php' method='post' id='form'><input type='hidden' name='handle' value='" + newhandle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='tag1' value='" + tagarrayclear[0] + "'><input type='hidden' name='tag2' value='" + tagarrayclear[1] + "'><input type='hidden' name='tag3' value='" + tagarrayclear[2] + "'><img src='owlwithtie.jpg' onload='submitform()'></form>" }
            })
            document.getElementById("proxypay").innerHTML = `<br /><strong>No MoneyButton? No problem!</strong><br /> Fund the handle-transaction with ProxyPay by sending:<br /> ${ payment.fee } satoshis to <b>${ payment.address }</b> <br />or use this payment URI (click or copy to your send field)<br /> <a href='` +  payment.bip21URI + `'>` + payment.bip21URI + `</a><br /><img src='https://api.qrserver.com/v1/create-qr-code/?data=` + payment.bip21URI + `&size=130x130&margin=10' /><br />In case something goes wrong, here's the Private Key ` + privKey;
        }
    }
   

</script>
<?php
        
        $create = $_POST["create"];
        $newhandle = $_POST["handle"];
        $description = $_POST["description"];
        $txid = $_POST["txid"];
        $title = $_POST["title"];
        $type = $_POST["type"];
        $public = $_POST["public"];
        $savehandlename = $_POST["savehandlename"];
        $publicizehandle = $_POST["publicizehandle"];
        $address = $_POST["address"];
        $amount = $_POST["amount"];
        $tags = $_POST["tags"];
        $encrypt = $_POST["encrypt"];
        
        
        
        
        
        
        // pr端fen, was f端r ein Handle gebildet werden soll + Variablen an JavaScript 端bergeben
        
        if (isset($create)) {
            if (isset($encrypt)) {
                if (isset($tags) && strlen($tags) > 5) {
                    if (isset($amount) && isset($address) && $amount > 0) {
                        $type = '020402';
                        echo "<script>tags=\"" . $tags . "\";addressvalue=\"" . $address . "\";value=\"" . $amount . "\";</script>";
                    }
                    else {
                        $type = '010402';
                        echo "<script>tags=\"" . $tags . "\";</script>";
                    }
                } 
                
                else {
                    if (isset($amount) && isset($address) && $amount > 0) {
                        $type = '020201'; 
                        echo "<script>addressvalue=\"" . $address . "\";value=\"" . $amount . "\";</script>";
                    }
                    else {
                        $type = '010202';    
                    }
                }
            }
            else {
                if (isset($tags) && strlen($tags) > 5) {
                    if (isset($amount) && isset($address) && $amount > 0) {
                            $type = '020303';
                            echo "<script>tags=\"" . $tags . "\";addressvalue=\"" . $address . "\";value=\"" . $amount . "\";</script>";
                    }
                    else {
                        $type = '010303';
                        echo "<script>tags=\"" . $tags . "\";</script>";
                    }
                } 
                
                else {
                    if (isset($amount) && isset($address) && $amount > 0) {
                        $type = '020102';
                        echo "<script>addressvalue=\"" . $address . "\";value=\"" . $amount . "\";</script>";
                    }
                    else {
                        $type = '010103';
                    }
                }
            }
            $handlehash = hash('sha256', $newhandle);
            echo "<script>newhandle=\"" . $newhandle . "\"; description=\"" . $description . "\"; handlehashin=\"" . $handlehash . "\"; title=\"" . $title . "\"; type=\"" . $type . "\";</script>";
            echo "<script>txidd=\"" . $txid . "\";</script>";
            if (isset($public)) {
                if ($public == 1) {
                    echo "<script>publicize=1;</script>";
                }
            }
            else {
                $num = 0;
                echo "<script>publicize=\"" . $num . "\";</script>";
            }
            if (isset($publicizehandle)) {
                if ($publicizehandle == 2) {
                    $db = mysqli_connect('localhost', 'mobymomk_system', 'Dead99preZ', 'mobymomk_mobybit');
                    $handledb = mysqli_query($db, "SELECT * FROM Handles");
                    $tagdb = mysqli_query($db, "SELECT * FROM Tags");
                    $newentryhandle = 1;
                    while($row = mysqli_fetch_object($handledb)) {
                        if ($row->Handle == $savehandlename) {
                            $newentryhandle = 0;
                            $amount = $row->Amount;
                            $amount = $amount + 1;
                        }
                    }
                    if ($newentryhandle == 1) {
                        $sql = "INSERT INTO Handles (Handle, Amount) VALUES ('$savehandlename', '1')";
                        if ($db->query($sql) === TRUE) {
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                    else {
                        $sql = "UPDATE Handles SET Amount = '$amount' WHERE Handle = '$savehandlename'";
                        if ($db->query($sql) === TRUE) {
                        } 
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                }
            }
            echo "<body onload='button()'>";
        }
        
        else {
            echo "<body class='text-center'>"; 
        }

  
        
        
?>

<nav class="navbar navbar-expand-lg navbar-light flex-row-reverse"  style="background-color: white;font-size:20px">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
    <a class="nav-link active" href="metahandle-tags.php">Search</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color:black">Create</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="metahandle-tags.php?store=1">Basic Handle</a>
      <a class="dropdown-item" href="metahandle-exclusive.php">Exclusive Handle</a>
     <a class="dropdown-item" href="create-account-handle.php">Account Handle</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"  style="color:black">Account</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="create-account-handle.php">Register</a>
      <a class="dropdown-item" href="login-account-handle.php">Login</a>
      <a class="dropdown-item" href="send-message.php">Send Message</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"  style="color:black">About Metahandle</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="about.html">About us</a>
      <a class="dropdown-item" href="docu.html">Documentation</a>
      <a class="dropdown-item" href="blog.html">Blog</a>
    </div>
  </li>
    </ul>
    <a class="navbar-brand" href="metahandle.php" style="font-size:20px">Metahandle</a>
  </div>
</nav><br /><br />

<div class="info"><br />
        <div id="info"></div>
        <?php
        if (!isset($create)) {
            echo "<h2>Create a new Metahandle</h2><form action='create.php' method='post'>
            <input type='text' name='handle'";
            if (isset($newhandle) && strlen($newhandle) != 0) {
                echo "value = '" . $newhandle . "' value '" . $newhandle . "'";
            }
            else {
                echo " placeholder='your handle / password'";
            }
            echo " id='textin' class='searchinput store' required></input><br />
            <input type='text' name='txid' placeholder='the txid you want to reference' id='textin' class='searchinput store' pattern=
            '[0-9|a-f]{64}'></input><br />
            <input type='text' name='title' placeholder='the title of the content' id='textin' class='searchinput store' required></input><br />
            <input type='hidden' name='create' value=1></input>
            <textarea cols='40' rows='10' name='description' placeholder='a description of the content' id='textarea' class='searchinput area' required></textarea><br />
            <div class='form-check' id='check1'>
                  <input class='form-check-input' name='encrypt' type='checkbox' value='1' id='checkbox'>
                  <label class='form-check-label' for='checkbox'>
                    <pre>Encrypt Transaction ID</pre>
                  </label>
            </div>
             <div class='form-check' id='check2'>
                  <input class='form-check-input' name='public' type='checkbox' value='1' id='checkbox'>
                  <label class='form-check-label' for='checkbox'>
                    <pre><abbr title='Make your Handle public visible on our homepage'>Publicize Handle</abbr></pre>
                  </label>
            </div>
            <h4>Add up to three tags</h4>
            <input type='text' name='tags' placeholder='Ad up to three tags, separated by a comma (optional)' id='textin' class='searchinput store'></input><br /><br &>
           <h4>Create a Value Handle</h4>
            <input type='text' name='address' placeholder='A BSV address in your control (optional)' id='textin' class='searchinput store'></input><br />Amount of value in Satoshi (optional): <input type='number' name='amount' id='textin' class='searchinput store amount' min='1000'><br /><br />
             <h4>Create an Exclusive Handle</h4>
             <p>To create an Exclusive Handle <a href='metahandle-exclusive.php'>go to this form.</p>
            <button type='submit' class='btn btn-info btn-lg '>Create Handle </button>
        </form>";
        }
        else {
            echo "<div class='container' style='margin-top:-3%'><div class='row'><div class='col-sm-10'><h3>Initiate a Handle transaction with MoneyButton or ProxyPay</h3><br /><div id='mbutton'></div>
                <div id='mbuttonload'></div><div id='proxypay'></div";
        }
        ?>
</div>
        






</script>
<script src="https://www.moneybutton.com/moneybutton.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    /* function stored(payment) {
        window.location = "metahandle-tags.php?handle=" + handle;
    }*/
</script>
<div class="searchfield"><div id="hello" class="search"></div><div id="hello2" class="search"></div><div id="hello3" class="search"></div></div>

<script>
    if (typeof handle !== 'undefined') { 
        document.getElementById("hello").innerHTML = "<img src='https://acegif.com/wp-content/uploads/loading-40.gif' width=200px align='middle' style='margin-left:350px'/>";
    };
</script>
</div>
</body>
</html>


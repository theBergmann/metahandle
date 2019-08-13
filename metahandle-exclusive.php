<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <title>Metahandle - bookmark and tag onchain files onchain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
     
    <meta name="description" content="Metahandle: Gatewaxy to Bitcoin onchain content">
  <meta name="keywords" content="metanate, BSV, onchain, opreturn, tag, bookmark">
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet"> 
     <script type="text/javascript" src="https://cdn.rawgit.com/ricmoo/aes-js/e27b99df/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="/assets/scrypt-async.js" ></script>
    <script src="/assets/aes-js.js" ></script>
       <!-- <script src="bsv.min.js" ></script>-->
          <script src="//cdn.jsdelivr.net/npm/vue"></script>
  <script src="//unpkg.com/bsv@0.27.2"></script>
  <script src="//unpkg.com/proxypay/dist/proxypay.min.js"></script>
  <script src="//unpkg.com/qrcode-generator"></script>
        <script src="encrypt.js" ></script>
    <script src="https://asecuritysite.com/sha256.js" ></script>
    <link rel="icon" type="image/png" href="/assets/handle-favicon.png">
     <link rel="stylesheet" href="/assets/style.css">

    <style>
        #exclusive {
            max-width:500px;
            margin:auto;
        }
        
        #exclusivetext {
            width:90%;
        }
        
        
    </style>
   
</head>

<script>
    // button() creates the moneybutton / proxypay field to initiate the transaction composing the metahandle
    
    function button() { 
        // the type of the exclusive handle        
        type = "020501";
        // check if there is already a handle with this word. If so, don't build.
        var query = {
          "v": 3,
          "q": {
            "find": {
             "out.b0": { "op": 106 },
             "out.s1": "1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU",
              $or: [ {"out.s2": handlehash }, {"out.s8": handlehash }, {"out.s10": handlehash }, {"out.s12": handlehash } ] 
             },
            "limit": 20,
            "sort": { "blk.i": 1 }
          }
        }
        var b64 = btoa(JSON.stringify(query));
        var url = "https://genesis.bitdb.network/q/1FnauZ9aUH2Bex6JzdcV4eNX7oLSSEbxtN/" + b64;
        var header = {
          headers: { key: "1CN88CMwB8wAVeoX2zm9CCZE4ZrrHDjZL5" }
        };
        fetch(url, header).then(function(r) {
          return r.json()
        }).then(function(r) {
            let total = r.u.concat(r.c);
            length = total.length;
            if (length > 0) {
                console.log(length);
                console.log(total);
                document.getElementById("mbutton").innerHTML = "Sorry, this handle does already exist. To register an exclusive handle, you have to be the first. <a href='metahandle-exclusive.php'>Try another word.</a>";
            } 
            // now start creating exclusive handle
            else {
                document.getElementById("mbuttonload").innerHTML = "<img src='loading-40.gif' width=60px />";
                let salt = generateId(128);
                create_aes_key(newhandle, salt);
                encrypt_it(description);
                encdesc = encryptedHex;
                encrypt_it(title);
                enctitle = encryptedHex;
                txid = txidd;
                let returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehash, "" + type, "" + txid, "" + enctitle, "" + encdesc, "" + salt]).toASM();
                let proxydata = "'1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehash, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt";          
                const div = document.getElementById("mbutton");
                moneyButton.render(div, {
                    outputs: [
                         {
                          address: address,
                          currency: 'BSV',
                          amount: 0.1
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
                     document.getElementById("mbutton").innerHTML="<form action='metahandle-tags.php' method='post' id='form'><input type='hidden' name='handle' value='" + newhandle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='savehandlename' value='" + newhandle + "'><img src='owlwithtie.jpg' onload='submitform()'></form>";
                  },
                  onError: function (arg) { console.log('onError', arg) }
                });
                
                let privKey = bsv.PrivateKey.fromRandom();
                const payment = proxypay({
                    key: privKey,
                    outputs: [
                        { to: address, satoshis: '10000000' },
                        { data: ['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', ' ', handlehash, ' ', type, ' ', txid, ' ', enctitle, ' ', encdesc, ' ', salt] }
                    ],
                    onPayment(tx) { document.getElementById("mbutton").innerHTML="<form action='metahandle-tags.php' method='post' id='form'><input type='hidden' name='handle' value='" + newhandle + "'><input type='hidden' name='publicizehandle' value='" + publicize + "'><input type='hidden' name='savehandlename' value='" + newhandle + "'><img src='owlwithtie.jpg' onload='submitform()'></form>" }
                })
                paymentamount = payment.fee + 10000000;
                document.getElementById("proxypay").innerHTML = `<br /><strong>No MoneyButton? No problem!</strong><br /> Fund the handle-transaction with ProxyPay by sending:<br /> ${ payment.fee } satoshis to <b>${ payment.address }</b> <br />or use this payment URI (click or copy to your send field)<br /> <a href='` +  payment.bip21URI + `'>` + payment.bip21URI + `</a><br /><img src='https://api.qrserver.com/v1/create-qr-code/?data=` + payment.bip21URI + `&size=130x130&margin=10' /><br />In case something goes wrong, here's the Private Key ` + privKey;
        
            }
        });        
    }    
</script>
<?php
        $newhandle = $_POST["newhandle"];
        $description = $_POST["description"];
        $txid = $_POST["txid"];
        $title = $_POST["title"];
        $public = $_POST["public"];
        $address = $_POST["address"];
        $encrypt = $_POST["encrypt"];
        
        // site either loads the form for handle creation or it loads the moneybutton to create the handle
    
        if (isset($newhandle) && strlen($newhandle) > 0) {
            $handlehash = hash('sha256', $newhandle);
            echo "<script>handlehash=\"" . $handlehash . "\"; newhandle=\"" . $newhandle . "\"; description =\"" . $description . "\"; title=\"" . $title . "\"; txidd=\"" . $txid . "\"; address=\"" . $address . "\"; </script>";
            echo "<script>console.log(title)</script>";
            echo "<body onload='button()'>";
        }
        else {
            echo "<body class='text-center'>";
        }
        
        
?>
<!--<body>-->
<nav class="navbar navbar-expand-lg navbar-light "  style="background-color: white;font-size:20px">
     <a class="navbar-brand" href="metahandle.php">
        <img src="handle-favicon.svg" width="70" alt="">
      </a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
     
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
    <a class="nav-link active" href="search.php">Search</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color:black">Create</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="create.php?store=1">Basic Handle</a>
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
    <div id="headline">
        
        <div id="info"></div>
        <?php
        if (isset($newhandle) && strlen($newhandle) > 0) {
            echo "<div class='container' style='margin-top:-3%'><div class='row'><div class='col-sm-10'><h3>Create your Exclusive Handle with MoneyButton or ProxyPay</h3><br /><div id='mbutton'></div>
                <div id='mbuttonload'></div><div id='proxypay'></div";
        }
        else {
            echo "<div id='exclusive'>
        <p id='exclusivetext'>You are about to create an exclusive handle. This handle references to only ONE transaction id. It is valid, as long as it is the first to claim it, and as long as it is backed by 0.1 BSV which are deposited to an address of your choice. </p>
        <p><b>The BSV remain always under your control. When you spent them, you give away ownership of the exclusive handle</b></p>
        </div>
        <br />
        <form action='metahandle-exclusive.php' method='post'>
            <input type='text' name='newhandle' placeholder=
            'your handle / password' id='textin' class='searchinput store' required></input><br />
            <input type='text' name='txid' placeholder='the txid you want to reference' id='textin' class='searchinput store' pattern=
            '[0-9|a-f]{64}'></input><br />
            <input type='text' name='title' placeholder='the title of the content' id='textin' class='searchinput store' required></input><br />
            <textarea cols='40' rows='10' name='description' placeholder='a description of the content' id='textarea' class='searchinput area' required></textarea><br />
            <input type='text' name='address' placeholder='an address to add value to the handle' id='textin' class='searchinput store'></input><br /><br />
             <div class='form-check' id='check2'>
                  <input class='form-check-input' name='public' type='checkbox' value='1' id='checkbox'>
                  <label class='form-check-label' for='checkbox'>
                    <pre><abbr title='Make your Handle public visible on our homepage'>Publicize Handle</abbr></pre>
                  </label>
            </div>
            <button type='submit' class='btn btn-info btn-lg '>Create Handle </button>
        </form>";
        }

        ?>
</div>
        


<script src="https://www.moneybutton.com/moneybutton.js"></script>
</div><div class="searchfield"><div id="hello" class="search"></div><div id="mbutton" class="search"></div><div id="hello3" class="search"></div></div>

<script>
    if (typeof handle !== 'undefined') { 
        document.getElementById("hello").innerHTML = "<img src='https://acegif.com/wp-content/uploads/loading-40.gif' width=200px align='middle' style='margin-left:350px'/>";
    };
</script>
</div>
</body>
</html>


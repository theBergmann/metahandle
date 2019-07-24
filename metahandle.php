<html>
<head>
    <title>Metahandle - bookmark and tag onchain files onchain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
     <meta charset="UTF-8">
    <meta name="description" content="Metahandle: Gatewaxy to Bitcoin onchain content">
  <meta name="keywords" content="metanate, BSV, onchain, opreturn, tag, bookmark">
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet"> 
     <script type="text/javascript" src="https://cdn.rawgit.com/ricmoo/aes-js/e27b99df/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script src="scrypt-async.js" ></script>
    <script src="aes-js.js" ></script>
          <script src="//cdn.jsdelivr.net/npm/vue"></script>
  <script src="//unpkg.com/bsv@0.27.2"></script>
  <script src="//unpkg.com/proxypay/dist/proxypay.min.js"></script>
  <script src="//unpkg.com/qrcode-generator"></script>
        <script src="encrypt.js" ></script>
    <link rel="icon" type="image/png" href="handle-favicon.png">
    <link rel="stylesheet" href="style.css">
</head>

<script>
    function submitform(){
        document.getElementById('form').submit();
    }
    function crawl() {
        window.location = "metahandle.php";
    }
    
    function store() {
        window.location = "metahandle.php?store=1";
    }
    
    function button() { 
        
        // encrypt title, description and optionaly txid.         
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
        
        // compose data for opreturn
        var returndata = bsv.Script.buildDataOut(['1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU', "" + handlehashin, "" + version_number, "" + txid, "" + enctitle, "" + encdesc, "" + salt]).toASM();
        
        // loading gif while MoneyButton loads
        document.getElementById("mbuttonload").innerHTML = "<img src='https://acegif.com/wp-content/uploads/loading-40.gif' width=60px />";
        
        // create MoneyButton
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
        
        // create ProxyPay
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
</script>
<?php
        // load variables with post. Handle can be obtained by post and get, but has different variables (handlie and handle)
        // Variables like "store", "newhandle", "savehandlename", "publicizehandle" tell the site what to do
        // Variables like "txid", "title", "type", "public" etc. forward components of the handle
        $action = $_GET["store"];
        $handlie = $_GET["handle"];
        $handle = $_POST["handle"];
        $newhandle = $_POST["newhandle"];
        $description = $_POST["description"];
        $txid = $_POST["txid"];
        $title = $_POST["title"];
        $type = $_POST["type"];
        $public = $_POST["public"];
        $savehandlename = $_POST["savehandlename"];
        $publicizehandle = $_POST["publicizehandle"];
    
        // when the handle is public, we test if it is already here. If, the counter increases, if not, it is put into the database
        if (isset($public)) {
            if ($public == 1) {
                $num = 2;
                echo "<script>publicize=\"" . $num . "\";</script>";
            }
        }
        else {
            $num = 0;
            echo "<script>publicize=\"" . $num . "\";</script>";
        }
        if (isset($publicizehandle)) {
            if ($publicizehandle == 2) {
                $db = mysqli_connect('...');
                $handledb = mysqli_query($db, "SELECT * FROM Handles");
                $newentry = 1;
                while($row = mysqli_fetch_object($handledb)) {
                    if ($row->Handle == $savehandlename) {
                        $newentry = 0;
                        $amount = $row->Amount;
                        $amount = $amount + 1;
                    }
                }
                if ($newentry == 1) {
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
        
        // if no type is set, it is handle 010102    
        if (!isset($type)) {
            $type = 1;
        }
    
        // if a handle was typed in, it is hashed. Ripemd160 is still here because it was used for handle type 010101 (formerly 1).
        if (isset($handle)) {
            $handlehash = hash('sha256', $handle);
            $handlehashripe = hash('ripemd160', $handle);
            // The handle is passed from php to javascript
            echo "<script>handle=\"" . $handle . "\"; handlehash=\"" . $handlehash . "\"; handlehashripe=\"" . $handlehashripe . "\"; </script>";
            echo "<body class='text-center'>"; 
        }
    
        // Same happens, when the handle is obtained with GET
        if (isset($handlie)) {
            $handlehash = hash('sha256', $handlie);
            $handlehashripe = hash('ripemd160', $handlie);
            echo "<script>handle=\"" . $handlie . "\"; handlehash=\"" . $handlehash . "\"; handlehashripe=\"" . $handlehashripe . "\";</script>";
            echo "<body class='text-center'>"; 
        }
        // if the variable newhandle exists, it is hashed too
        else if (isset($newhandle)) {
            $handlehash = hash('sha256', $newhandle);
            echo "<script>handle=\"" . $newhandle . "\"; description=\"" . $description . "\"; handlehashin=\"" . $handlehash . "\"; title=\"" . $title . "\"; type=\"" . $type . "\";</script>";
            echo "<script>txidd=\"" . $txid . "\";</script>";
            echo "<body onload='button()' class='text-center'>";
        }
    
        // if no handle is set, we are on the homepage. Then load the public handles from the database
        else {
             echo "<body class='text-center'>";
             $db = mysqli_connect('...');
             $handledb = mysqli_query($db, "SELECT * FROM Handles");
             $frontpage = 1;
        }
?>
    <div id="headline">
        <a href="metahandle.php">
            <h1><font size="10">Metahandle</font></h1>
            <h2><font size="5">Gateway to Bitcoin onchain data</font></h2><br/></div>
        </a>
        <button type="button" class="btn btn-outline-info btn-lg" onclick="crawl()">Crawl</button>
        <button type="button" class="btn btn-outline-success btn-lg " onclick="store()" style="margin-left:1em">Store</button>
        <br /><br /><a href="docu.html">What is this about? Read the docu!</a><br /><br /><br />
        <div id="info"></div>
        <div id="mbutton"></div>
        <div id="mbuttonload"></div>
   
        <?php
    
        // when creating a handle, a form to get data
        if (isset($action)) {
            echo "<form action='metahandle.php' method='post'>
            <input type='text' name='newhandle' placeholder=
            'your handle / password' id='textin' class='searchinput store'></input><br />
            <input type='text' name='txid' placeholder='the txid you want to reference' id='textin' class='searchinput store'></input><br />
            <input type='text' name='title' placeholder='the title of the content' id='textin' class='searchinput store'></input><br />
            <textarea cols='40' rows='10' name='description' placeholder='a description of the content' id='textarea' class='searchinput area'></textarea>
            <!--<pre><label><input type='checkbox' name='type' value='2' id='checkbox' class='form-check-input'>Encrypt Transaction ID</pre></label><br />-->

            <div class='form-check' id='check1'>
                  <input class='form-check-input' name='type' type='checkbox' value='2' id='checkbox'>
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
            <button type='submit' class='btn btn-info btn-lg '>Create Handle with MoneyButton or ProxyPay</button>
        </form>";
        }
    
        // When homepage, show public handles 
        if (!isset($action) and !isset($handle) and !isset($newhandle)) {
            echo "
            <form action='metahandle.php' method='post'>
            <input type='text' name='handle' class='searchinput'></input>
            <button class='btn btn-info btn-sm' id='searchbutton' type='submit'>Crawl</button>
            </form>
            </div>";
            if ($frontpage == 1) {
                echo "<h2>Popular Handles*</h2><br />";
                $publichandles = [];
                while($row = mysqli_fetch_object($handledb)) {
                    $amount = $row->Amount;
                    $thishandle = $row->Handle;
                    $publichandles[] = array(                                     "amount" => $amount,
                        "handle" => $thishandle,);
                }
                rsort($publichandles);
                for ($i=0; $i<sizeof($publichandles); $i++) {
                    echo "<a href='metahandle.php?handle=" . $publichandles[$i]["handle"] . "'>" . $publichandles[$i]["handle"] . " (" . $publichandles[$i]["amount"] . ")</a>";
                    echo "<br />";
                }
                 echo "<br />*Handles only show up when explicitly allowed to be publicized";
            }
        }
        ?>
</div>
        
<script>
// if handlehash is defined, it starts to querry the hash at babel.
var query = {
  "v": 3,
  "q": {
    "find": {
     "out.b0": { "op": 106 },
     "out.s1": "1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU",
     "out.s2": handlehash
     },
    "project": { "out.$": 1, "_id": 0 },
    "limit": 20,
    "sort": { "blk.i": 1 }
  },
 "r": {
    "f": "[.[] | .out[0] | {Addr: \"\\(.s1)\", Handle: \"\\(.s2)\", VersionNumber: \"\\(.s3)\", Txid: \"\\(.s4)\", Title: \"\\(.s5)\", Description: \"\\(.s6)\", Salt: \"\\(.s7)\"}]"
   }
}

var b64 = btoa(JSON.stringify(query));
var url = "https://babel.bitdb.network/q/1DHDifPvtPgKFPZMRSxmVHhiPvFmxZwbfh/" + b64;

var header = {
  headers: { key: "1KrCDqrudYge6YuGKhnBmSJsBKWSRjv7tz" }
};

var results = [];
k = 0;


fetch(url, header).then(function(r) {
  return r.json()
}).then(function(r) {
    document.getElementById("hello").innerHTML = "<font size='5'>Handle: " + handle + "<br /><br /></font>";
    let total = r.u.concat(r.c);
    total.forEach(function(output) {
       var salt = output.Salt;
       if (output.VersionNumber == "010102" || output.VersionNumber == "010202") {
            create_aes_key(handle, salt);
       }
       if (output.VersionNumber == "010101" || output.VersionNumber == "010201" ) {
            create_aes_key_old(handle, salt);
       }
       VersionNumber = output.VersionNumber;
       if (output.VersionNumber == "010102" || output.VersionNumber == "010202" || output.VersionNumber == "010102" || output.VersionNumber == "010202") {
            decrypt_it(output.Title);
            Title = decryptedText;
            decrypt_it(output.Description);
            Description = decryptedText;
       }
       if (output.VersionNumber == "010201") {
           decrypt_it(output.Txid);
           Txid = decryptedText;
       }
       else {
           Txid = output.Txid;
       }
       
       alreadyhere = 0;
       for (m=0; m<results.length; m++) {
           if (results[m][0] == Txid) {
               alreadyhere = 1;
               console.log(results.length + " " + m + " " + results[m][0] + " " + k + " " + Txid)
           }
       }
       
       if (alreadyhere == 0) {
           results[k] = [];
           results[k][0] = Txid;
           results[k][1] = Title;
           results[k][2] = Description;
           k = k+1;
       }
  })
 
  length = results.length;
  for (i=0; i<length; i++) {
      var div = document.createElement("div");
       div.setAttribute("class", "search");
       div.innerHTML = "<b>" + results[i][1] + "</b><br />" + results[i][2] + "<br /><em>" + results[i][0] + "</em><br />Lookup with: <a href='https://bico.media/" +results[i][0] + "' target='_blank'> bico.media</a>  <a href='https://www.bitcoinfiles.org/" + results[i][0] + "' target='_blank'> BitcoinFiles</a>   <a href='https://www.bitpaste.app/tx/" + results[i][0] + "' target='_blank'>BitPaste</a><br /><br />";
    document.body.appendChild(div)
  }
})  







</script>
<script src="https://www.moneybutton.com/moneybutton.js"></script>
<script>
     function stored(payment) {
        window.location = "metahandle.php?handle=" + handle;
    }
</script>
<div id="proxypay"></div><div class="searchfield"><div id="hello" class="search"></div><div id="hello2" class="search"></div><div id="hello3" class="search"></div></div>
</div>
</body>
</html>


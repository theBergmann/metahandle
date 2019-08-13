<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <title>Metahandle - bookmark and tag onchain files onchain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="handle-favicon.png">
    <link rel="stylesheet" href="style.css">
     
    <meta name="description" content="Metahandle: Gatewaxy to Bitcoin onchain content">
  <meta name="keywords" content="metanate, BSV, onchain, opreturn, tag, bookmark">
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet"> 
  <!--<script type="text/javascript" src="https://cdn.rawgit.com/ricmoo/aes-js/e27b99df/index.js"></script>-->
     <script src="aes-js-index.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>-->
    <script type="text/javascript" src="aes.js"></script>
    <script type="text/javascript" src="scrypt-async.js" ></script>
    <script type="text/javascript" src="aes-js.js" ></script>
       <script type="text/javascript" src="bsv.min.js" ></script>
        <!--<script src="//cdn.jsdelivr.net/npm/vue"></script>-->
    <script type="text/javascript" src="vue.js" ></script>
  <!--<script src="//unpkg.com/bsv@0.27.2"></script>-->
  <!--<script src="//unpkg.com/proxypay/dist/proxypay.min.js"></script>-->
  <script type="text/javascript" src="proxypay.min.js"></script>
 <!-- <script src="//unpkg.com/qrcode-generator"></script>-->
  <script src="qrcode.js"></script>
        <script type="text/javascript" src="encrypt.js" ></script>
    <link rel="icon" type="image/png" href="handle-favicon.png">
    <!--<script src="https://asecuritysite.com/sha256.js" ></script>-->
    <script src="sha256.js" ></script>
    
    <style>
        .search {
            width:100%;
            max-width:750px;
            margin-left:0;
        }
        
        
        
    </style>
    
        
        
  
</head>


<?php
        $handlie = $_GET["handle"];
        $handle = $_POST["handle"];
        $publicize = $_POST["publicizehandle"];
        $tag1 = $_POST["tag1"];
        $tag2 = $_POST["tag2"];
        $tag3 = $_POST["tag3"];
        $savehandlename = $handle;
        
        // when publicize is active, we put the handle in our database ...
        if (isset($publicize)) {
                $db = mysqli_connect('', '', '', '');
                $handledb = mysqli_query($db, "SELECT * FROM Handles");
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
                $tagdb = mysqli_query($db, "SELECT * FROM Tags");
                if (isset($tag1) && strlen($tag1) > 1) {
                    $tagdb = mysqli_query($db, "SELECT * FROM Tags");
                    $newentrytag1 = 1;
                    while($row = mysqli_fetch_object($tagdb)) {
                        if ($row->Handle == $tag1) {
                            $newentrytag1 = 0;
                            $amount = $row->Amount;
                            $amount = $amount + 1;
                        }
                    }
                    if ($newentrytag1 == 1) {
                        $sql = "INSERT INTO Tags (Handle, Amount) VALUES ('$tag1', '1')";
                        if ($db->query($sql) === TRUE) {
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                    else {
                        $sql = "UPDATE Tags SET Amount = '$amount' WHERE Handle = '$tag1'";
                        if ($db->query($sql) === TRUE) {
                        } 
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                }
                if (isset($tag2) && strlen($tag2) > 1) {
                    $tagdb = mysqli_query($db, "SELECT * FROM Tags");
                    $newentrytag2 = 1;
                    while($row = mysqli_fetch_object($tagdb)) {
                        if ($row->Handle == $tag2) {
                            $newentrytag2 = 0;
                            $amount = $row->Amount;
                            $amount = $amount + 1;
                        }
                    }
                    if ($newentrytag2 == 1) {
                        $sql = "INSERT INTO Tags (Handle, Amount) VALUES ('$tag2', '1')";
                        if ($db->query($sql) === TRUE) {
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                    else {
                        $sql = "UPDATE Tags SET Amount = '$amount' WHERE Handle = '$tag2'";
                        if ($db->query($sql) === TRUE) {
                        } 
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                }
                if (isset($tag3) && strlen($tag3) > 1) {
                    $tagdb = mysqli_query($db, "SELECT * FROM Tags");
                    $newentrytag3 = 1;
                    while($row = mysqli_fetch_object($tagdb)) {
                        if ($row->Handle == $tag3) {
                            $newentrytag3 = 0;
                            $amount = $row->Amount;
                            $amount = $amount + 1;
                        }
                    }
                    if ($newentrytag3 == 1) {
                        $sql = "INSERT INTO Tags (Handle, Amount) VALUES ('$tag3', '1')";
                        if ($db->query($sql) === TRUE) {
                        }
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                    else {
                        $sql = "UPDATE Tags SET Amount = '$amount' WHERE Handle = '$tag3'";
                        if ($db->query($sql) === TRUE) {
                        } 
                        else {
                            echo "Error: " . $sql . "<br>" . $sql->error;
                        }
                    }
                }
                            
        }
        if (isset($handle)) {
            $handlehash = hash('sha256', $handle);
            $handlehashripe = hash('ripemd160', $handle);
            echo "<script>handle=\"" . $handle . "\"; handlehash=\"" . $handlehash . "\"; handlehashripe=\"" . $handlehashripe . "\"; </script>";
        }
        else if (isset($handlie)) {
            $handlehash = hash('sha256', $handlie);
            $handlehashripe = hash('ripemd160', $handlie);
            echo "<script>handle=\"" . $handlie . "\"; handlehash=\"" . $handlehash . "\"; handlehashripe=\"" . $handlehashripe . "\";console.log(handlehash)</script>";
        }
?>
        
        
  
        
    
<body>
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
      <a class="dropdown-item" href="create.php">Basic Handle</a>
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



<div class="container" style="margin-top:-3%">
    <div class="row">
        <div class="col-10">
            <form action="search.php" method="post">
                <input type='text' name='handle' autofocus class='searchinput'
                <?php 
                    if (isset($handle)) { 
                        echo "value='" . $handle . "'"; 
                    }
                    else if (isset($handlie)) { 
                        echo "value='" . $handlie . "'"; 
                    }
                    ?>
                    </input>&nbsp;&nbsp;<button class='btn btn-info btn-sm' id='searchbutton' type='submit'>Search</button>
            </form>
        </div>
    </div>
</div>

    

        
        
    
<script>

// now we get to the core of it ...  
if (typeof handlehash !== 'undefined') {

// searching genesis 
var query = {
  "v": 3,
  "q": {
    "find": {
     "out.b0": { "op": 106 },
     "out.s1": "1NYJFDJbcSS2xGhGcxYnQWoh4DAjydjfYU",
     $or: [ {"out.s2": handlehash }, {"out.s8": handlehash }, {"out.s10": handlehash }, {"out.s12": handlehash } ] 
     },
    "limit": 120,
    "sort": { "blk.i": 1 }
  }
}
var b64 = btoa(JSON.stringify(query));
var url = "https://genesis.bitdb.network/q/1FnauZ9aUH2Bex6JzdcV4eNX7oLSSEbxtN/" + b64;
var header = {
  headers: { key: "1CN88CMwB8wAVeoX2zm9CCZE4ZrrHDjZL5" }
};

resultarray = [];

// this is the base process scheme
    
fetch(url, header).then(function(r) {
  return r.json()
}).then(function(r) {
    results = r.u.concat(r.c);
    checkFirst()
    .then(function(firstState) {
        let state = firstState;
        switch (state) {
            case "exclusive":
                showResults()
                break;
            case "invalid":
                processResults(1)
                .then(function() {
                    sortResults();
                }) 
                .then(function() {
                    showResults();
                }) 
                break;
            case "basic":
                processResults(0)
                .then(function(result) {
                    sortResults();
                }) 
                .then(function() {
                    showResults();
                }) 
                break;
        }
        return(firstState)
    }) 
})
}

// the first result is special, as if it is a valid exclusive handle we can skip all the rest
function checkFirst() {
  return new Promise((resolve, reject) => {
      let versionNumber = results[0].out[0].s3;
      if (versionNumber == "020501" || versionNumber == "20501") {
        checkValue(0)
        .then(function(value) {
            console.log(value);
            if (value > 9999999) {
                addToArray(0, value);
                resolve("exclusive");
            }
            else {
                resolve("rejected");
            }
        })
      }
      else {
          resolve("basic");
      }
  })
}

// When we have value handles or an exclusive handle, we need to lookup the balance of the utxo. For this we use bitindex at this time.    
function checkValue(num) {
    return new Promise(function(resolve, reject) {
        let valueAddr = [];
        let utxo = results[num].tx.h;
        for (let i = 0; i<results[0].out.length; i++) {
            val = results[num].out[i].e.a;
            if (val != 'false') {
                valueAddr.push(val);
            }
        }
        let url = "https://api.bitindex.network/api/v3/main/addr/" + valueAddr + "/utxo";  
        fetch(url).then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            let HandleValue = 0;
            for (i=0;i<Object.keys(myJson).length; i++) {
                if (myJson[i]["txid"] == utxo) {
                    HandleValue = HandleValue +  myJson[i]["value"];
                }
                if (i == (Object.keys(myJson).length - 1)) {
                    return HandleValue;
                }
            }
        }).then(function(HandleValue) {
            resolve(HandleValue);
        })
    })
}

// each result needs to be added to the result array    

function addToArray(number, value) {
    return new Promise(function(resolve, reject) {
        let i = number;
        let versionNumber = results[i].out[0].s3;
        let Title = results[i].out[0].s5;
        let Description = results[i].out[0].s6;
        resultarray[i] = [];
        resultarray[i][0] = versionNumber;
        resultarray[i][4] = value;
        let Salt = results[i].out[0].s7;
        if (!Salt) {
            Salt = "null";
        }
        let Txid = results[i].out[0].s4;
        // unfortunately, there are many different cases and versions. Starting with a handle with tags ...
        if (versionNumber == '010301' || versionNumber == '010401' || versionNumber == '020301' || versionNumber == '020401' || versionNumber == '010302' || versionNumber == '020302' || versionNumber == '020303' || versionNumber == '020402' || versionNumber == '010303' || versionNumber == '010402') {
            console.log("process taghandle");
            processTagHandle(i)
            .then(function(properties) {
                if (versionNumber == "010202" || versionNumber == "020201" || versionNumber == "010401" || versionNumber == "020401") {
                   create_aes_key(handle, Salt);
                   decrypt_it(Txid);
                   Txid = decryptedText;
                }
                resultarray[i][2] = properties[1];
                resultarray[i][3] = properties[2];
                resultarray[i][1] = Txid;
                resolve("success");
            })
        }    
        else {
            // depending on the version number the handles are encrypted differently
            if (versionNumber == "010103" || versionNumber == "010302" || versionNumber == "020102" || versionNumber == "020302") {
                create_aes_key_extra_light(handle);
            }
            else if (versionNumber == "010101" || versionNumber == "010201" ) {
                create_aes_key_old(handle, Salt);
            }
            
            else {
                create_aes_key(handle, Salt);
            }
            decrypt_it(Title);
            Title = decryptedText;
            decrypt_it(Description);
            Description = decryptedText;
            // some might have an encrypted transaction id.
            if (versionNumber == "010201" || versionNumber == "020201" || versionNumber == "010402" || versionNumber == "020401" || versionNumber == "010202" || versionNumber == "010203") {
                decrypt_it(Txid);
                Txid = decryptedText;
            }
            resultarray[i][2] = Title;
            resultarray[i][3] = Description;
            resultarray[i][4] = value;
            resultarray[i][1] = Txid;
            resolve("success");
        }
    })
}

// process all the handles found    
    
function processResults(num) {
    return new Promise(function(resolve, reject) {
        p = 1;
        for (let i=num; i<results.length;i++) {
            let value = 0;
            if (results[i].out[0].s3 == "020101" || results[i].out[0].s3 == "020201" || results[i].out[0].s3 == "020301" || results[i].out[0].s3 == "020401" || results[i].out[0].s3 == "020302" || results[i].out[0].s3 == "020202") {
                checkValue(i)
                .then(function(HandleValue) {
                    value = HandleValue;
                    addToArray(i, value)
                    .then(function() {
                        if (p == results.length) {
                            resolve("success");
                        }
                        else {
                            p++;
                        }
                    })
                })
            }
            else {
                addToArray(i, value)
                .then(function() {
                    if (p == results.length) {
                        resolve("success");
                    }
                    else {
                        p++;
                    }
                })
            }
        }    
    });
}
    

// a tag handle needs a special execution    
function processTagHandle(number) {
    let i = number;
    let encHandle;
    let key = handle;
    let Title = results[i].out[0].s5;
    let Description = results[i].out[0].s6;
    let Salt = results[i].out[0].s7;
    return new Promise(function(resolve, reject) {
        if (results[i].out[0].s2 == handlehash) {
            if (!Salt) {
                Salt = "null";
            }
            if (results[i].out[0].s3 == "010302" || results[i].out[0].s3 == "020302") {
                create_aes_key_extra_light(key);
            }
            else {
                console.log("no new tag handle");
                create_aes_key(key, Salt);
            }
            decrypt_it(Title);
            Title = decryptedText;
            decrypt_it(Description);
            Description = decryptedText;
            let properties = [];
            properties[0] = key;
            properties[1] = Title;
            properties[2] = Description;
            resolve(properties);
        }
        else {
            if (results[i].out[0].s8 == handlehash) {     
                encHandle = results[i].out[0].s9;
            }
            else if (results[i].out[0].s10 == handlehash) {
                encHandle = results[i].out[0].s11;
            }
            else if (results[i].out[0].s12 == handlehash) {    
                 encHandle = results[i].out[0].s13;
            }
            if (results[i].out[0].s3 == "010302" || results[i].out[0].s3 == "020302") {
                key = hex_sha256(key);
                console.log(key);
                console.log("light encryption");
                create_aes_key_extra_light(key);
            }
            else {
                create_aes_key(handlehash, Salt);
            }
            decrypt_it(encHandle);
            key = decryptedText;
            console.log(key);
            if (results[i].out[0].s3 == "010302" || results[i].out[0].s3 == "020302") {
                create_aes_key_extra_light(key);
            }
            else {
                create_aes_key(key, Salt);
            } 
            decrypt_it(Title);
            Title = decryptedText;
            decrypt_it(Description);
            Description = decryptedText;
            let properties = [];
            properties[0] = key;
            properties[1] = Title;
            properties[2] = Description;
            resolve(properties);
        }
    })
}

// results are sorted due to age and value. Duplicates are deleated    
 
function sortResults() {
    if (resultarray.length > 1) {
        for (let i=0; i<resultarray.length; i++) {
            // if a valid exclusive handle is the first entry, all other entries are deleted. If it has no value, it is deleted itself.
            if (i == 0) {
                if (resultarray[i][0] == "020501") {
                    resultarray.splice(0, 1);
                }
            }
            if ((resultarray[i][0] == '020101' || resultarray[i][0] == '020201' || resultarray[i][0] == '020301' || resultarray[i][0] == '020401' || resultarray[i][0] == '020102' || resultarray[i][0] == '020302') &&       resultarray[i][4] == 0) {
                resultarray.splice(i, 1);
            }
            if (i != 0 && resultarray[i][0] == '020501') {
                resultarray.splice(i, 1);
            }
        }
        // now we check for double entries. If two handle reference to the same txid, the handlewith the lower value is deleted. If both have no value, the older stays.
        for (let i=0; i<resultarray.length; i++) {
           for (let j = 0; j<resultarray.length; j++) {
               if ((resultarray[i][1] == resultarray[j][1]) && (i != j) ) {
                   if ((resultarray[j][0] == '020101' || resultarray[j][0] == '020201' || resultarray[j][0] == '020301' || resultarray[j][0] == '020401' || resultarray[j][0] == '020102' || resultarray[j][0] == '020302') && ( resultarray[i][0] != "020101" || resultarray[i][0] != "020201" || resultarray[i][0] != "020301" || resultarray[i][0] != "020401" || resultarray[i][0] != "020302" || resultarray[i][0] != "020102" )) {
                        resultarray.splice(i, 1);
                        if (i>0) {
                            i = i-1;
                        }
                    }
                    else if ((resultarray[i][0] == '020101' || resultarray[i][0] == '020201' || resultarray[i][0] == '020301' || resultarray[i][0] == '020401' || resultarray[i][0] == '020302' || resultarray[i][0] == '020102') && ( resultarray[j][0] != "020101" || resultarray[j][0] != "020201" || resultarray[j][0] != "020301" || resultarray[j][0] != "020401" || resultarray[j][0] != "020302" || resultarray[j][0] != "020102")) {
                        resultarray.splice(j, 1);
                        if (j>0) {
                            j = j-1;
                        }
                    }
                    else if (resultarray[j][4] >= resultarray[i][4]) {
                        resultarray[j][4] = resultarray[j][4] + resultarray[i][4];
                        resultarray.splice(i, 1);
                        if (i>0) {
                            i = i-1;
                        }
                    }
                    else {
                       resultarray[i][4] = resultarray[j][4] + resultarray[i][4];
                       console.log("del");
                       resultarray.splice(j, 1);
                       if (j>0) {
                            j = j-1;
                        };
                    }
                }
            } 
        }
        resultarray.sort(function(a, b) {
            if (a[4] < b[4]) {
                return  1;
            }
            else if (a[4] > b[4]) {
                return -1;
            }
            else {
            }
            return 0;
        });
    }
}

// finally, reslts are shown    
    
function showResults() {
    document.getElementById("hello").innerHTML = "";
    for (let i=0; i<resultarray.length; i++) {
        word = 0;
        if (i==0 && resultarray[i][0] == "20501" && resultarray[i][4] > 9999999) {
                h31 = "<h3>";
                h32 = "</h3>";
                word = "<br /><strong><span style='color:#008000'> Exclusive Handle! Value " + resultarray[i][4] + "</span></strong>";
        }
        else if (resultarray[i][0] == "020101" || resultarray[i][0] == "020201" || resultarray[i][0] == "020301" || resultarray[i][0] == "020401"  || resultarray[i][0] == "020302" || resultarray[i][0] == "020102") {
            word = "<br /><strong><span style='color:#008000'> value " + resultarray[i][4] + "</span></strong>";
            if (i == 0) {
                h31 = "<h3>";
                h32 = "</h3>";
            }
            else {
                h31 = "<strong>";
                h32 = "</strong><br />"; 
            }
        }
        else if (resultarray[i][0] == "020501") {
            h31 = "<h3>";
            h32 = "</h3>";
            word = "<br /><strong><span style='color:#008000'>Exclusive Handle. Value: " + resultarray[i][4] + "</span></strong>";
        }
        else {
            word = "";
            h31 = "<strong>";
            h32 = "</strong><br />";
        }
        let searchresult = document.createElement("DIV");
        searchresult.setAttribute("class", "search");
        searchresult.innerHTML = h31 + " " + resultarray[i][2] + " " + h32 + resultarray[i][3] + "<br /><em>" + resultarray[i][1] + "</em><br />Lookup with: <a href='https://bico.media/" +resultarray[i][1] + "' target='_blank'> Bico.Media</a> . <a href='https://www.bitcoinfiles.org/" + resultarray[i][1] + "' target='_blank'> BitcoinFiles</a> .  <a href='https://www.bitpaste.app/tx/" + resultarray[i][1] + "' target='_blank'>BitPaste</a> . <a href='bit://19HxigV4QyBv3tHpQVcUEQyq1pzZVdoAut/" + resultarray[i][1] + "' target='_blank'>Bottle</a>" + word + "<br /><br />";
        document.getElementById("hello").appendChild(searchresult);
        
    }
}
    
    
  



</script>
<!--<script src="https://www.moneybutton.com/moneybutton.js"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    /* function stored(payment) {
        window.location = "metahandle-tags.php?handle=" + handle;
    }*/
</script>

<div class="container" id="hello">
    
</div>



<script>
    if (typeof handle !== 'undefined') { 
        document.getElementById("hello").innerHTML = "<img src='https://acegif.com/wp-content/uploads/loading-40.gif' width=200px />";
    };
</script>
</div>
</body>
</html>


<html>
<body>
<pre>loading...</pre>
<?php
$handle = $_GET["handle"];
$handle = hash('sha256', $handle);
$handlehash = "14jzRNXWiyGK651bTrkQkvqi7xuRcLxqdV";
echo "<script>handle=\"" . $handle . "\"; handlehash=\"" . $handlehash . "\";</script>";
?>
<script>
var query = {
  "v": 3,
  "q": {
    "find": {
      "$text": { "$search": handle },
    },
    "limit": 10
  }
}

var b64 = btoa(JSON.stringify(query));
// var url = "https://bitgraph.network/q/" + b64;
//var url = "https://babel.bitdb.network/q/1DHDifPvtPgKFPZMRSxmVHhiPvFmxZwbfh" + b64;
var url = "https://genesis.bitdb.network/q/1FnauZ9aUH2Bex6JzdcV4eNX7oLSSEbxtN/" + b64;


var header = {
  headers: { key: "1KrCDqrudYge6YuGKhnBmSJsBKWSRjv7tz" }
};

fetch(url, header).then(function(r) {
  return r.json()
}).then(function(r) {
  //var result = JSON.stringify(r, null, 2);
  //document.querySelector("pre").innerHTML = result;
  
  let total = r.u.concat(r.c);
  document.querySelector("pre").innerHTML = total[0]["_id"] + " " + total[0]["tx"]["h"] + " " + total[0]["out"][0]["s1"];
  console.log(total)
  
})
</script>
</body>
</html>

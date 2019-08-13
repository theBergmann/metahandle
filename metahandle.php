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

<body class="text-center">
    
    <!-- navbar ... -->
<nav class="navbar navbar-expand-lg navbar-light flex-row-reverse"  style="background-color: white;font-size:20px">
  
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

<div class="info"><br />
          <div class="fav">
             <a href="metahandle.php"><img src="handle-favicon.svg" /></a>
            </div><br /><br />

            <form action='metahandle.php' method='post'>
            <input type='text' name='handle' class='searchinput'></input><br /><br />
            <button class='btn btn-outline-success btn-lg' id='searchbutton' type='submit' formaction='search.php' style='margin-left:1em'>Search</button>&nbsp;&nbsp;
            <button class='btn btn-outline-info btn-lg' id='searchbutton' type='submit' formaction='create.php'>Create</button><br />
            
            </form>
            </div><br /><br />
            
    
            <?php
    
               // connect to database to show popular handles on the frontpage
    
                echo "<h2>Popular Handles*</h2><br />";
                $db = mysqli_connect('', '', '', '');
                $handledb = mysqli_query($db, "SELECT * FROM Handles");
                $tagdb = mysqli_query($db, "SELECT * FROM Tags");
                $publichandles = [];
                while($row = mysqli_fetch_object($handledb)) {
                    $amount = $row->Amount;
                    $thishandle = $row->Handle;
                    $publichandles[] = array("amount" => $amount,
                        "handle" => $thishandle,);
                }
                rsort($publichandles);
                echo "<table style='margin:auto;'>";
                for ($i=0; $i<sizeof($publichandles); $i++) {
                    if (($i == 0) OR (is_int(($i)/2))) {
                        echo "<tr>";
                    }
                    echo "<td style='text-align:center; padding-left:2em;padding-right:2em'><a href='search.php?handle=" . $publichandles[$i]["handle"] . "'>" . $publichandles[$i]["handle"] . " (" . $publichandles[$i]["amount"] . ")</a> &nbsp;&nbsp;&nbsp; </td>";
                        if (is_int(($i+1)/2)) {
                            echo "</tr>";
                        }
                }
                echo "</table><br />";
                $publitags = [];
                while($row = mysqli_fetch_object($tagdb)) {
                    $amount = $row->Amount;
                    $thishandle = $row->Handle;
                    $publictags[] = array(                                     "amount" => $amount,
                        "handle" => $thishandle,);
                }
                rsort($publictags);
                echo "<h2>Popular Tags</h2>";
                echo "<table style='margin:auto'>";
                for ($i=0; $i<sizeof($publictags); $i++) {
                    if (($i == 0) OR (is_int(($i)/2))) {
                        echo "<tr>";
                    }
                    echo "<td style='text-align:center'><a href='search.php?handle=" . $publictags[$i]["handle"] . "'>" . $publictags[$i]["handle"] . " (" . $publictags[$i]["amount"] . ")</a> &nbsp;&nbsp;&nbsp; </td>";
                        if (is_int(($i+1)/2)) {
                            echo "</tr>";
                        }
                }
                echo "</table><br />";
                 echo "<br />*Handles and tags only show up when explicitly allowed to be publicized";
            ?>
</div>
        

<script>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<div id="proxypay"></div><div class="searchfield"><div id="hello" class="search"></div><div id="hello2" class="search"></div><div id="hello3" class="search"></div></div>

</div>
</body>
</html>


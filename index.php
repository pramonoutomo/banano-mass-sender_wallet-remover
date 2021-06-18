<?php include "_config.php";?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Pramono Utomo | PramonoUtomo.com">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Wallet Nodes ID Remover</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas/">

    

    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="offcanvas.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Nodes Wallet Id Remover</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#donate">Buy me a Coffee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://t.me/pramonoutomo">Get In Touch</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="alert('Updated Very Soon :) check back later.');">Github</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="donate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buy Me a Coffee</h5>
      </div>
      <div class="modal-body">
        Coming Soon
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<main class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1">All nodes id shown here are automatically deleted after 24 hours.</h1>
      <small>Nodes id from mass sender script are deleted regularly, please backup the wallet seed to make your money SAFU!</small>
    </div>
  </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Nodes ID Tracked (And not destroyed yet)</h6>
    <?php
    	//get all nodes active
  		$getnodes = $db->query("CALL wallets_getexpired()");
  		while($datanodes = $getnodes->fetch_object()){
        //wallet id
        $wid=$datanodes->wallet_id;
        //wallet nodes
        $waddress=$datanodes->wallet_nodeaddress;
        //status
        if($datanodes->wallet_status==1){
          $wstats="To Be Removed";
        }
        else{
          $wstats="Already Destroyed";
        }
		?>
    <!-- The Data Begin -->
    <div class="d-flex text-muted pt-3">
      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">@<?php echo $waddress;?></strong>
        <?php echo strtoupper(substr($wid,0,12));?>XXXXXXXXXX<?php echo strtoupper(substr($wid,-10));?> | <?php echo $wstats;?>
      </p>
    </div>
    <!-- End Of Each Data -->
    <?php
  		}
  		$db->next_result();
    ?>
    <small class="d-block text-end mt-3">
      <a href="#" onclick="alert('not available for public');">Json Data</a>
    </small>
  </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Public BanaNodes List</h6>
    <div class="d-flex text-muted pt-3">
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark">Banano.cc</strong>
          <a href="https://api-beta.banano.cc/">https://api-beta.banano.cc/</a>
        </div>
        <span class="d-block">Banano Dev</span>
      </div>
    </div>
    <div class="d-flex text-muted pt-3">
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark">Kalium</strong>
          <a href="#">https://kaliumapi.appditto.com/api</a>
        </div>
        <span class="d-block">Banano Dev</span>
      </div>
    </div>
    <div class="d-flex text-muted pt-3">
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark">Banano.id</strong>
          <a href="#">https://nodes.banano.id/api.php</a>
        </div>
        <span class="d-block"><a href="https://t.me/PramonoUtomo" target="blank">@PramonoUtomo</a></span>
      </div>
    </div>
    <small class="d-block text-end mt-3">
      <a href="https://public.banano.live" target="blank">More Public BanaNodes List</a>
    </small>
  </div>
</main>


    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="offcanvas.js"></script>
  </body>
</html>

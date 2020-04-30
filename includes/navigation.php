<?php
$user = current_user();
$c_username = $user['username'];
$c_profile = $user['profile'];
?>

  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="300">
  <meta name="description" content="PH Capture the Flag Website | Practice your Hacking Skills Here | PH Capture the Flag by Pseudo-X | Basic Challenges | All Web CTF Problems">
  <meta name="keywords" content="Password | Hack the Flag | Can You Get the Flag ?? |">
  <meta name="author" content="Developed by John Lester Legaspi | Pseudo-X ">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--meta name="phhacktheflag-TileColor" content="#FFFFFF" />
  <meta name="phhacktheflag-TileImage" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square70x70logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square150x150logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-wide310x150logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square310x310logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <link rel="icon" href="https://i.postimg.cc/7YpjtCsh/23447380.jpg">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/assets/css/all.css"-->
  <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome/css/fontawesome-all.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/global-ctf.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/timeline.css">
  <style type="text/css">
  .notification .badge {
    position: relative;
    top: -10px;
    right: auto;
    padding: 4px 7px;
    border-radius: 50%;
    background: red;
    color: white;
  }
  </style>
</head>
<body>
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark special-color-dark">
    <div class="container">
      <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
            <a href="/challenges" class="nav-link ctf-challenge" category="Challenges">Challenges</a>
          </li>

          <li class="nav-item">
            <a href="/blog" class="nav-link ctf-top-hackers" category="top-hackers">Blog</a>
          </li>

          <li class="nav-item">
            <a href="/tophacker" class="nav-link ctf-top-teams" category="top-teams">Top Hackers</a>
          </li>

          <li class="nav-item">
            <a href="/topteam" class="nav-link ctf-top-hackers" category="top-hackers">Top Team</a>
          </li>

          <li class="nav-item">
            <a href="/inbox" class="nav-link ctf-top-hackers" category="top-hackers">Inbox</a>
          </li>

          <li class="nav-item">
            <a href="/invitation" class="nav-link ctf-top-hackers" category="top-hackers">Invitation</a>
          </li>
        </ul>

      <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav ml-auto nav-flex-icons">

           <a href="/<?php echo $c_username;?>"><img src="/img/<?php echo $c_profile ?>" alt="" class="table-img"></a>
          
          <li class="nav-item">
            <a href="/messages" class="nav-link ctf-top-hackers" category="top-hackers"><i class="fa fa-envelope"></i></a>
          </li>
          
          <li class="nav-item dropdown">
            <?php notifications(); ?>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-success special-color-dark success-color"
              aria-labelledby="navbarDropdownMenuLink-333">
              <a class="dropdown-item text-success" href="/Profile.php">Profile</a>
              <a class="dropdown-item text-success" href="/settings/profile/edit">Settings</a>
              <a class="dropdown-item text-success" href="/terms-and-policy.php">Terms & Policy</a>
              <a class="dropdown-item text-success" href="/terms-and-policy.php">Create Team</a>
              <a class="dropdown-item text-success" href="/terms-and-policy.php">Create Group Chat</a>
              <hr class="hr dark-color">
              <a class="dropdown-item text-success" href="/logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!--/.Navbar -->

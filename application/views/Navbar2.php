<header class="header">
        <img class="logo" src="<?php echo base_url("Assets/logo.jpg"); ?>" />
        <a href="<?php echo site_url('HomePage')  ?>" style = "visibility:hidden;">Homepage</a>
        <h1>Taste of Africa</h1>
        <div id="sessionVariable">
            <!-- <div id="login-signup-button">
                <a class="login" href="#" onclick="window.location.replace('users/login');"><button>Login</button></a>
                <a class="Sign-up" href="#" onclick="window.location.replace('users/registration');"><button>Sign
                        up</button></a>
            </div> -->
            <div id="session-data">
            <img style = "margin-left:1em;" onclick = "displayLogout();" class="logo" src="<?php echo base_url("Assets/PRO.png"); ?>" />
                <p onclick = "displayLogout();" ><b><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></b></p>
                <a href="<?php echo base_url('index.php/HomePage'); ?>" style = "display:none;" id = "logout"> Log Out </a>
            </div>
        </div>
</header>
<script>
        function displayLogout(){
            document.getElementById('logout').style.display = "unset";

        }
</script>
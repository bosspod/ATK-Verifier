<?php
session_start();
include("condb.php");
include("../src/asset/main.php");
$ip = $_SERVER['REMOTE_ADDR'];
$browserAgent = $_SERVER['HTTP_USER_AGENT'];

echo $html5;

echo $head;
?>
<script>
    function showpass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<body>

<?php echo $header; ?>

    <section class="about-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2 class="title mt-100 mb-20">Login System</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section-title">
                        <form name="formlogin" action="checklogin.php" method="POST" id="login" class="form-horizontal">
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" required placeholder="Username" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="password" required placeholder="Password" />
                            </div>
                            <div>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" id="password" onclick="showpass()">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Show Password</span>
                                </label>
                            </div>
                            <div>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" checked="checked" name="remember">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Remember me</span>
                                </label>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="main-btn mt-20" id="btn"><span class="lni-arrow-right-circle"></span> Login </button></br>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="text-center mt-50">
            <small>This website is Secured<i class="lni-shield"></i>Your password has encrypted by "sha1" , "base64" and "md5".<i class="lni-shield"></i>
        </div>
    </section>
    <?php echo $footer; ?>
</body>
</html>
<?php
include("../src/asset/main.php");

echo $html5;

echo $head;

?>

<body>

    <?php echo $header; ?>

    <section class="about-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2 class="title mt-60 mb-70">Login System</h2>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-title text-center">Incorrect username or password</div>
        <div class="mt-25">
            <div>
                <div class="contact-description text-center">Please try again later or contact the administrator.</div>
                <div class="text-center mt-50">
                    <a class="main-btn ml-10 mt-10" href="index.php">Try Again</a>
                    <a class="main-btn ml-10 mt-10" href="../">Home Page</a>
                </div>
    </section>

    <?php echo $footer; ?>

</body>

</html>
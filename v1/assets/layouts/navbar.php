    <?php if (!isset($_SESSION['auth'])) { ?>



        <nav class="navbar navbar-expand-md navbar-light bg-light shadow p-2">



        <?php } else { ?>



            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm p-2">





            <?php } ?>





            <div class="container ">

                <a class="navbar-brand" href="../home">



                    <?php if (!isset($_SESSION['auth'])) { ?>

                        <img src="../assets/images/logo-en-LSGD.png" alt="" width="500" height="70" class="mr-3">

                    <?php } else { ?>

                        <img src="../assets/images/logonotextwhite.png" alt="" width="50" height="50" class="mr-3">

                    <?php } ?>



                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

                    <span class="navbar-toggler-icon"></span>

                </button>





                <div class="collapse navbar-collapse" id="navbarSupportedContent">



                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">



                    </ul>



                    <!-- Right Side Of Navbar -->

                    
                </div>

            </div>

            </nav>
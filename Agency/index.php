<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Close Button and Search Field Example</title>



    <!-- Font Awesome CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">



    <style>

    * {

  padding: 0;

  margin: 0;

  box-sizing: border-box;

}



body {

  height: 100vh;

  display: flex;

  justify-content: center;

  align-items: center;

}





.btn {

  width: 160px;

  height: 50px;

  position: relative;

  -webkit-tap-highlight-color: transparent;

  display: flex;

  align-items: center;

  justify-content: center;

  font-family: 'Dancing Script', cursive;

  font-size: 25px;

  color: #000;

  cursor: pointer;

  background-color: #63a4ff;

  background-image: linear-gradient(315deg, #63a4ff 0%, #83eaf1 74%);

}





.string {

  width: 5px;

  height: 80px;

  border-radius: 0 5px 0 0;

  background: #eee;

  position: absolute;

  right: -5px;

  top: 0;

  transition: 850ms;

}



.string-end {

  width: 8px;

  height: 12px;

  border-radius: 0 0 10px 10px;

  background: #ccc;

  position: absolute;

  right: -6.5px;

  bottom: -42px;

  transition: 850ms;

}











.btn:hover .string {

  height: 60px;

}



.btn:hover .string-end {

  bottom: -22px;

}



.noselect {

  -webkit-touch-callout: none;

    -webkit-user-select: none;

     -khtml-user-select: none;

       -moz-user-select: none;

        -ms-user-select: none;

            user-select: none;

}

a {

  text-decoration: none;

}





.effect01 {

  color: #FFF;

  

  box-shadow:0px 0px 0px 1px #000 inset;

  background-color: #000;

  overflow: hidden;

  position: relative;

  transition: all 0.3s ease-in-out;

}

.effect01:hover {

  

  background-color: #FFF;

  box-shadow:0px 0px 0px 4px #EEE inset;

}



/*btn_text*/

.effect01 span {

  transition: all 0.2s ease-out;

  z-index: 2;

}

.effect01:hover span{

  letter-spacing: 0.13em;

  color: #333;

}



/*highlight*/

.effect01:after {

  background: #FFF;

  border: 0px solid #000;

  content: "";

  height: 155px;

  left: -75px;

  opacity: .8;

  position: absolute;

  top: -50px;

  -webkit-transform: rotate(35deg);

          transform: rotate(35deg);

  width: 50px;

  transition: all 1s cubic-bezier(0.075, 0.82, 0.165, 1);/*easeOutCirc*/

  z-index: 1;

}

.effect01:hover:after {

  background: #FFF;

  border: 20px solid #000;

  opacity: 0;

  left: 120%;

  -webkit-transform: rotate(40deg);

          transform: rotate(40deg);

}





/* textanimation */

.container {

  width: 100%;

  height: 100vh;

  background: #232323;



  display: flex;

  justify-content: center;

  align-items: center;

  

}

  .box {

    width: 250px;

    height: 250px;

    position: relative;

    display: flex;

    justify-content: center;

    flex-direction: column;



    .title {

      width: 100%;

      position: relative;

      display: flex;

      align-items: center;

      height: 50px;



      .block {

        width: 0%;

        height: inherit;

        background: #ffb510;

        position: absolute;

        animation: mainBlock 2s cubic-bezier(.74, .06, .4, .92) forwards;

        display: flex;

      }



      h1 {

        font-family: 'Poppins';

        color: #fff;

        font-size: 32px;

        -webkit-animation: mainFadeIn 2s forwards;

        -o-animation: mainFadeIn 2s forwards;

        animation: mainFadeIn 2s forwards;

        animation-delay: 1.6s;

        opacity: 0;

        display: flex;

        align-items: baseline;

        position: relative;



        span {

          width:0px;

          height: 0px;

          -webkit-border-radius: 50%;

          -moz-border-radius: 50%;

          border-radius: 50%;



          background: #ffb510;

          -webkit-animation: load 0.6s cubic-bezier(.74, .06, .4, .92) forwards;

          animation: popIn 0.8s cubic-bezier(.74, .06, .4, .92) forwards;

          animation-delay: 2s;

          margin-left: 5px;

          margin-top: -10px;

          position: absolute;

          bottom: 13px;

          right: -12px;



        }

      }

    }



    .role {

      width: 100%;

      position: relative;

      display: flex;

      align-items: center;

      height: 30px;

      margin-top: -10px;



      .block {

        width: 0%;

        height: inherit;

        background: #e91e63;

        position: absolute;

        animation: secBlock 2s cubic-bezier(.74, .06, .4, .92) forwards;

        animation-delay: 2s;

        display: flex;

      }



      p {

        animation: secFadeIn 2s forwards;

        animation-delay: 3.2s;

        opacity: 0;

         font-weight: 400;

        font-family: 'Lato';

        color: #ffffff;

        font-size: 12px;

        text-transform: uppercase;

        letter-spacing: 5px;

      }

    }

  }







@keyframes mainBlock {

  0% {

    width: 0%;

    left: 0;



  }

  50% {

    width: 100%;

    left: 0;



  }

  100% {

    width: 0;

    left: 100%;

  }

}



@keyframes secBlock {

  0% {

    width: 0%;

    left: 0;



  }

  50% {

    width: 100%;

    left: 0;



  }

  100% {

    width: 0;

    left: 100%;

  }

}



@keyframes mainFadeIn {

  0% {

    opacity: 0;

  }

  100% {

    opacity: 1;

  }

}





@keyframes popIn {

  0% {

    width: 0px;

    height: 0px;

    background: #e9d856;

    border: 0px solid #ddd;

    opacity: 0;

  }

  50% {

    width: 10px;

    height: 10px;

    background: #e9d856;

    opacity: 1;

    bottom: 45px;

  }

   65% {

      width: 7px;

    height: 7px;

      bottom: 0px;

      width: 15px

   }

   80% {

      width: 10px;

    height: 10px;

      bottom: 20px

   }

  100% {

    width: 7px;

    height: 7px;

    background: #e9d856;

    border: 0px solid #222;

    bottom: 13px;



  }

}



@keyframes secFadeIn {

  0% {

    opacity: 0;

  }

  100% {

    opacity: 0.5;

  }

}



    </style>



</head>



<body>



<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">



<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="box text-center">

                <div class="title">

                    <span class="block"></span>

                    <h1>Register Agency<span></span></h1>

                </div>

                <div class="role">

                    <div class="block"></div>

                    <p>With LSGD</p>

                </div>

                <div class="btn text-center">

                  <div class="bg"></div>

                    <span class="noselect effect01"><a class="btn btn-primary" href="form.php">Click Here</a></span>

                  <div class="string"></div>

                <div class="string-end"></div>

            </div>

            </div>

        </div>

    </div>

</div>





</body>



</html>


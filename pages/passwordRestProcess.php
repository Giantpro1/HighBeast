
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="HighBeast Blog">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Giantpro">
  <meta name="generator" content="HighBeast">
  <link rel="shortcut icon" href="../assets/img/HighBeastImg/beast@.jfif" type="image/x-icon">
  <title>
  HighBeast
  </title>
  <link id="pagestyle" href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/soft-ui-dashboard.min.css">
</head>

<body class="">
      <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/HighBeastImg/theTechRobort.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">Welcome Back </h1>
              <p class="text-lead text-white">"Reset your Password !!"</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0 shadow">
              <div class="card-header text-center pt-4">
              </div>
              <div class="card-body">
                <form id="" role="form text-left">
                <p class="text-danger" id="form_Error"></p>
                  <div class="mb-3">
                    <input type="text" name="" class="form-control" placeholder="Enter digit code send to your email" aria-label="number" aria-describedby="">
                  </div>
                  <div class="mb-3">
                    <input type="text" name="" class="form-control" placeholder="New password" aria-label="password" aria-describedby="">
                  </div>
                  <div class="mb-3">
                    <input type="text" name="" class="form-control" placeholder="Confirm Password" aria-label="password" aria-describedby="">
                  </div>
                  <div class="text-center">
                    <button type="button" id="" class="btn bg-gradient-dark w-100 my-4 mb-2">Reset Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Home
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            profile
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Team
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            companys
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
            Terms & coditions
          </a>
        </div>
        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fa fa-dribbble"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fa fa-twitter"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fa fa-instagram"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fa fa-pinterest"></span>
          </a>
          <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
            <span class="text-lg fa fa-github"></span>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright ?? <script>
              document.write(new Date().getFullYear())
            </script> by giantPro
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/jquery/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/jquery/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#loginHbUserBtn").click(function(e){
        if($("#loginHbUser")[0].checkValidity()){
          e.preventDefault()
          $("#loginHbUserBtn").text("Please Wait...")

          $.ajax({
            url: '',
            method: 'POST',
            data:$("").serialize(),
            success: function(response){
              console.log(response)
              if(response.message === ''){
                window.location = "../index"
              }else{
                $("#form_Error").html(response.message)
              }
            }
          })
        }
      })
    })
  </script>
</body>

</html>
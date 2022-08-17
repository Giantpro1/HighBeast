
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
  <link rel="icon" type="image/png" href="../assets/img/HighBeastImg/beast@.jfif">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
  <title>
    Highest
  </title>

  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->

  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.min.css" rel="stylesheet" />
</head>
    <body>
        <main>
            <section>
                <div class="container my-7">
                    <div class="card shadow">
                        <div class="card-header">
                            <h2>Ulpoad your Post</h2>
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <form action="" id="hbUser_BlogUpload" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <h6>Title for post:</h6>
                                            <p id="upload_Error"></p>
                                            <input type="text" name="hbUser_BlogTit" class="form-control w-100 bg-white" placeholder="Tittle">
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold pt-4 pb-1">Select Ad Category:</h6>
                                            <select name="hbUser_BlogCat" class="form-control w-100 bg-white" id="inputGroupSelect">
                                            <option value="">Select category</option>
                                            <option value="Aviation">Aviation</option>
                                            <option value="Artificial intelligence">Artificial intelligence</option>
                                            <option value="Automobile">Automobile</option>
                                            <option value="wood Works">wood Works</option>
                                            <option value="Construction">Construction</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                       <h6 class="font-weight-bold pt-4 pb-1">Description:</h6>
                                        <textarea name="hbUser_BlogDes" id="" class="form-control bg-white" rows="7"
                                        placeholder="Write details about your product" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="choose-file text-center my-4 py-4 rounded bg-white">
                                    <label for="file-upload">
                                        <span class="d-block font-weight-bold text-dark">Drop files anywhere to upload</span>
                                        <span class="d-block">or</span>
                                        <span class="d-block btn bg-primary text-white my-3 select-files">Select files</span>
                                        <span class="d-block">Maximum upload file size: 500 MB</span>
                                        <input type="file" class="form-control-file d-none" id="file-upload" multiple name="hbUser_BlogImg[]">
                                    </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button class="btn btn-info px-6" id="hbUser_BlogUploadBtn">upload</button>
                                </div>
                            </form>
                                
                            
                    </div>
                </div>
            </section>
        </main>
        <!-- send formData for blogUpload -->


        <script src="../assets/jquery/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/jquery/bootstrap.min.js"></script>
  <script>
            $(document).ready(function(){
                $("#hbUser_BlogUpload").submit(function(e){
                        e.preventDefault()
                        $("#hbUser_BlogUploadBtn").text("pleaseWait...")
                        $.ajax({
                            url: 'http://localhost/DBeast/controller/api/uploadBlog.php',
                            method: 'POST',
                            cache: false,
                            processData: false,
                            contentType: false,
                            data: new FormData(this),
                            success: function(response){
                                console.log(response)
                            }
                        })
                })
            })
        </script>
    </body>
</html>

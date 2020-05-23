<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
  <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="assets/css/cssbootstrap/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/form-elements.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


    <title>PRUEBA FILE</title>
</head>
<body>
    
<form method="post"  enctype="multipart/form-data" action="auxiliarenvio.php">
    
<div class="container-fluid">
    <div class="row">
        <table class="table table-dark border-secondary">
            <tbody>
                <tr>
                    <td><label for="a1">NOMBRE:</label></td>
                    <td><label for="a2">APELLIDO:</label></td>
                    <td><label for="a3">FOTO:</label></td>
                    <td><label for="a4">PDF:</label></td>
                </tr>
                <tr>
                    <td><input class="form-control" type="text" name="a11"></td>
                    <td><input class="form-control" type="text" name="a21"></td>
                    <td>
                        <div class="custom-file">
                            <input id="a31" class="custom-file-input" type="file" name="a31">
                            <label for="a31" class="custom-file-label">FOTO</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="a41">PDF</label>
                            <input id="a41" class="form-control-file" type="file" name="a41">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>

<div class="row">
    <button class="btn btn-success" type="submit">ENVIAR</button>
</div>


<table class="table table-dark">
    <tbody>
        <tr>
            <td><label > Id:</label></td>
            <td><label >NOMBRE:</label></td>
            <td><label >APELLIDO:</label></td>
            <td><label >FOTO:</label></td>
            <td><label >PDF:</label></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>



</form>






<!-- Javascript -->
  <!-- <script src="assets/js/jquery-1.11.1.min.js"></script> -->
  <script src="assets/js/jquery.v3.5.1.js"></script>
  <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
  <script src="assets/js/jsbootstrap/bootstrap.js"></script>
  <!-- <script src="assets/js/jquery.backstretch.min.js"></script> -->
  <!-- <script src="assets/js/retina-1.1.0.min.js"></script> -->
  <!-- <script src="assets/plugins/sweetalert2/core.js"></script>
  <script src="assets/plugins/sweetalert2/sweetalert2.all.js"></script> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="assets/js/jquery.number.js"></script>
  <!-- <script src="assets/js/scripts.js"></script> -->

</body>
</html>
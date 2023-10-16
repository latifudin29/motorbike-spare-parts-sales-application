<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DETA MOTORAGE</title>
    <base href="<?php echo base_url() ?>">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <link rel="stylesheet" href="assets/dist/css/site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="assets/dist/js/site.min.js"></script>
    <style>
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #303641;
        color: #C1C3C6
    }
    </style>
</head>
<body>
    <div class="container">
    <form class="form-signin" role="form" action="app/simpan_reg" method="post">
        <h3 class="form-signin-heading">Silahkan Mendaftar dibawah ini.</h3>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama Lengkap" autocomplete="off" autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-home"></i>
                </div>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" autocomplete="off" autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-phone"></i>
                </div>
                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" autocomplete="off" autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" autofocus />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                <i class=" glyphicon glyphicon-lock "></i>
                </div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
        <br>
        <p>Sudah punya akun?</p>
        <a href="app/login" class="btn btn-lg btn-info btn-block">Login</a>
    </form>

    </div>
    <div class="clearfix"></div>
    <br><br>
</body>
</html>

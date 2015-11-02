<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GeoData</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css"/>

    <style>
        .wrapper {
            width: 50%;
            margin: 100px auto 50px;
        }

        form {
            box-sizing: border-box;
            padding: 35px 40px 35px;
        }
    </style>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
    <?php echo $error; ?>
    <form action="?fetchData" method="GET">
        <div class="form-group">
            <p class="help-block">Update Provider Geodata</p>
            <br>
            <input type="submit" value="Update Providers" name="update">
        </div>
    </form>
</div>
</body>
</html>
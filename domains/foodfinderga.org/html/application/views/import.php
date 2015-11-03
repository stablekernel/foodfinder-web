<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Provider Uploader</title>
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
            background: #eee;
            box-sizing: border-box;
            padding: 35px 40px 35px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
    <?php echo $error; ?>
    <?php echo form_open_multipart('/import/providers'); ?>

    <div class="form-group">
        <p class="help-block">Select Provider File</p>
        <br>
        <input type="file" name="import_csv">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Upload CSV</button>
    </form>
</div>
</body>
</html>
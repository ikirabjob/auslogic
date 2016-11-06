<!doctype html>
<html lang="en">
<head>
    <title>Тестовое задание 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <div class="wrap">
        <?php
        if (isset($errors) && !empty($error)) {
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
        ?>
        <form role="form" action="" method="post">
            <fieldset>
                <legend>Retrieve your phone number</legend>

                <div class="form-group">
                    <label for="email">Enter your e-mail:</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <?php if ($result) { ?>
                    <div class="alert alert-warning" role="alert">
                        The phone number will be e-mailed to you.
                    </div>
                <?php } ?>

                <button class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</body>
</html>
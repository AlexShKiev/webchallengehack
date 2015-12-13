<?php
require 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM wishes ORDER BY id DESC LIMIT 1';
foreach ($pdo->query($sql) as $row) {
    echo '<tr>';
    echo '<tr>' . $row['id'];
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td><</td>';
    echo '</tr>';
}
Database::disconnect();
if ( !empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $emailError = null;
    $mobileError = null;

    // keep track post values

    // validate input
    $valid = true;
    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    if (empty($mobile)) {
        $mobileError = 'Please enter Mobile Number';
        $valid = false;
    }
}

    $name=$row['name'];
    $email=$row['email'];
    ?>
    <form action="" method="post">
        <div class="control-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
            <label class="control-label">Name</label>

            <div class="controls">
                <input name="name" type="text" placeholder="Name" value="<?php echo $email;?>">
                <?php if (!empty($nameError)): ?>
                    <span class="help-inline"><?php echo $nameError; ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success">Send</button>
    <?php
    var_dump($row['email']);

    if (isset($email)) {
        $link = 'http://www.shurov-studio.biz.ua/update.php?id=' . $row['id'];
        $name = $row['name'];
        $email= $row['email'];
        $subject = "Твой друг спрашивает какой новогодний подарок ты хочешь";
        $headers = "Content-type: text/html; charset=utf-8 \r\n";
        $message = '
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv=«Content-Type» content=«text/html; charset=utf-8»>
</head>
<body style="margin:0;">
<table cellspacing="0" cellpadding="0"
       style="width: 100%; font-family: Open Sans, arial, serif; font-size: 16px; line-height: 1.3; color: #999999; background-color: #eeeeee">
    <tbody>
    <tr>
        <td><img src="http://www.shurov-studio.biz.ua/src/images/header__email--blue.png" width="100%" style="margin-bottom: 60px;">
            <table cellspacing="0" cellpadding="0" style="width: 100%; padding:0 80px; margin-bottom:30px;">
                <tbody>
                <tr>
                    <td style="padding: 50px; background-color: #ffffff; box-shadow: 2px 2px 9px -1px rgba(0,0,0,0.18);">
                        <p style="color: #000000; font-size: 24px;">Привет, '.$name.'</p><span style="font-size: 18px;"> С Наступающими Праздниками, твой друг интересуется что ты хочешь<br>получить в подарок на Новый год.<br>И передает поздравление с праздниками!</span>

                        <div style="margin-top: 40px; text-align:center"><a href='.$link.'
                                                                            style="background-color: #267a5a; color:#fff; text-transform: uppercase; text-decoration: none; font-size: 16px; padding:15px 30px; border-radius: 6px; white-space: nowrap;">Отправить
                                пожелание</a></div>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>';
        mail("$email", $subject, $message, $headers,
            "From: party@shurov-studio.biz.ua");
        header("Location: success.php");
    }

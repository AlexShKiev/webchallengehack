<?php
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (!empty($_POST)) {
    $nameError = null;
    $emailError = null;
    $your_emailError = null;


    $gift_first = $_POST['gift_first'];
    $first_giftlink = $_POST['first_giftlink'];
    $gift_hz = $_POST['gift_hz'];
    $gift_love = $_POST['gift_love'];
    $second_gift = $_POST['second_gift'];
    $secind_giftlink = $_POST['secind_giftlink'];
    $third_gift = $_POST['third_gift'];
    $third_giftlink = $_POST['third_giftlink'];


    $valid = true;
    if (empty($gift_first)) {
        $nameError = 'подарок1';
        $valid = false;
    }

    if (empty($first_giftlink)) {
        $emailError = 'введите линк';
        $valid = false;
    }
    if (empty($gift_hz)) {
        $nameError = 'sdfds';
        $valid = false;
    }
    if (empty($gift_love)) {
        $your_emailError = 'sdfdsf';
        $valid = false;
    }
    if (empty($second_gift)) {
        $second_giftError = 'sdfdsf';
        $valid = false;
    }
    if (empty($secind_giftlink)) {
        $secind_giftlinkError = 'sdfdsf';
        $valid = false;
    }
    if (empty($third_gift)) {
        $third_giftError = 'sdfdsf';
        $valid = false;
    }
    if (empty($third_giftlink)) {
        $third_giftlinkError = 'sdfdsf';
        $valid = false;
    }


    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE wishes  set firs_gift = ?, first_giftlink = ?, gift_hz =?, gift_feel =?, second_gift =?,secind_giftlink =?,third_gift=?,third_giftlink =?  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($gift_first, $first_giftlink, $gift_hz, $gift_love, $id));
        Database::disconnect();
        header("Location: happy_sucs.php");

    }
}

?>


<!--<div class="form-actions">-->
<!--    <button type="submit" class="btn btn-success">Отправил блять</button>-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Gift mailer</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="shortcut icon" href="../src/images/fav.ico" type="image/x-icon">

    <script src="../js/jquery-1-11-3.min.js"></script>
    <script src="../js/jquery-clone.min.js"></script>
</head>
<body>
<div class="form-wrap">
    <div class="g-central-block"><h3 class="form__title">Расскажи своему другу, что ты хочешь получить<br>в подарок на
            Новый год</h3>

        <form method="post" class="form">
            <div class="form__row"><label class="form__label">Здесь ты можешь ввести желаемые подарки: (Советуем
                    указывать подарки из разных ценовых категорий)</label>

                <div class="form__col form__col--50 <?php echo !empty($your_emailError) ? 'error' : ''; ?>"><input
                        name="gift_first" type="text"
                        class="form__input" value="<?php echo !empty($gift_first) ? $gift_first : ''; ?>"
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?> >
                </div>
                <div class="form__col form__col--50 <?php echo !empty($your_emailError) ? 'error' : ''; ?>"><input
                        name="second_gift" type="text" class="form__input"
                        value="<?php echo !empty($second_gift) ? $second_gift : ''; ?>"
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?> >
                </div>
                <div class="form__col form__col--50<?php echo !empty($your_emailError) ? 'error' : ''; ?>"><input
                        name="third_gift" type="text" class="form__input"
                        value="<?php echo !empty($third_gift) ? $third_gift : ''; ?>"
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?>>
                </div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--full-width <?php echo !empty($your_emailError) ? 'error' : ''; ?>">
                    <label class="form__label">Если ты не знаешь, что конкретно
                        тебе подарить, то расскажи о своих увлечениях, хобби: (Твоему другу будет проще подобрать тебе
                        подарок)</label><input name="gift_hz" class="form__input"
                                               value="<?php echo !empty($gift_hz) ? $gift_hz : ''; ?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?></div>
            </div>
            <div class="form__row">
                <div class="form__col form__col--full-width <?php echo !empty($your_emailError) ? 'error' : ''; ?>">
                    <label class="form__label">А здесь - ты можешь отправить
                        свои пожелания своему будущему поздравителю :)</label><input name="gift_love"
                                                                                     class="form__input"
                                                                                     value="<?php echo !empty($gift_love) ? $gift_love : ''; ?>">
                    <?php if (!empty($your_emailError)): ?>
                        <span class="help-inline"><?php echo $your_emailError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            $pdo = Database::connect();
            $sql = 'SELECT * FROM wishes ORDER BY id DESC LIMIT 1';
            foreach ($pdo->query($sql) as $row) {
                $row['id'];
                $row['name'];
                $row['email'];
                $row['your_email'];
                $row['your_name'];


            }
            Database::disconnect();

            ?>
            <?php
            if (isset($gift_first)) {
                $link = 'http://www.shurov-studio.biz.ua/update.php?id=' . $row['id'];
                $gift = $_POST['gift_first'];
                $hz_gift = $_POST['gift_hz'];
                $love_gift = $_POST['gift_love'];
                $email = $row['your_email'];
                $from_mail = $row['email'];
                $name = $row['name'];
                $own_name = $row['your_name'];
                $second_gif = $_POST['second_gift'];
                $second_l = $_POST['secind_giftlink'];
                $third_gift = $_POST['third_gift'];
                $third_l = $_POST['third_giftlink'];
                $subject = "Твой друг опредилился с подарком!";
                $headers = "Content-type: text/html; charset=utf-8 \r\n";
                $message = '
        <html>
        <head>
            <meta http-equiv=«Content-Type» content=«text/html; charset=utf-8»>
        </head>
        <body style="margin:0;">

        <table cellspacing="0" cellpadding="0"
               style="width: 100%; font-family: Open Sans, arial, serif; font-size: 16px; line-height: 1.3; color: #999999; background-color: #eeeeee">
            <tbody>
            <tr>
                <td><img src="http://www.shurov-studio.biz.ua/src/images/header__email.png" width="100%" style="margin-bottom: 60px;">
                    <table cellspacing="0" cellpadding="0" style="width: 100%; padding:0 80px; margin-bottom:30px;">
                        <tbody>
                        <tr>
                            <td style="padding: 30px 15px; background-color:#ffffff;box-shadow: 2px 2px 9px -1px rgba(0,0,0,0.18);">
                                <p style="color: #000000; font-size: 24px;"></p><span style="font-size: 16px;"> С Наступающими Праздниками, ' . $own_name . ',  Ваш друг ' . $name . '
<a href="mailto:' . $from_mail . '"  style="color: #99b5a7; text-decoration:none"></a><br>Рассказал(а) Вам, что он(а) мечтает получить на Новый год. <br> <b style="color:#358968"> ' . $gift . ' ,' . $link_gift . ' , ' . $second_gif . ' ,' . $second_l . ',' . $third_l . '</b> <br>И оставвил(а) для Вас пожелание! <br> <br><i style="color:#000000">' . $love_gift . '</i></span>


                            </td>
                        </tr>
                        <tr>
                    <td>
                        <div style="margin-top: 40px; text-align:center">
                        <a share_url="http://www.shurov-studio.biz.ua/" href="http://www.facebook.com/sharer.php?u=http://www.shurov-studio.biz.ua/&t=GiftMailer"
                                                                            style="display:inline-block; margin-right: 50px"><img
                                    src="http://www.shurov-studio.biz.ua/src/images/fb__share.png"></a>
                                    <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
                                    <a href="#"
                                                                                style="display:inline-block;"><img
                                    src="http://www.shurov-studio.biz.ua/src/images/vk__share.png"></a></div>
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
                header("Location: happy_sucs.php");
            }

            ?>
            <button type="submit" class="btn">Отправить</button>
        </form>
    </div>
</div>

<div class="g-central-block">
    <div class="preview">
        <div class="preview__title">Как это работает?</div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--l preview__step--first">
                <div class="preview__sub-title">Шаг 1</div>
                <img src="../../src/images/preview/preview__step_1.svg" width="230" class="preview__img">

                <p class="preview__text">Введи email адреса друзей, которым ты хочешь подарить подарок</p></div>
            <div class="preview__anim-r">
                <img src='../../src/images/preview/arrow-icon.png' , width='150'>
            </div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--r preview__step--first">
                <div class="preview__sub-title">Шаг 2</div>
                <img src="../../src/images/preview/preview__step_2.svg" width="300" class="preview__img">

                <p class="preview__text">Друг получают анонимное письмо о том, что кто-то интересуется новогодним
                    подарком, который он хочет получить</p></div>
            <div class="preview__anim-l">
                <img src='../../src/images/preview/arrow-icon.png' , width='150'>
            </div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--l preview__step--first">
                <div class="preview__sub-title">Шаг 3</div>
                <img src="../../src/images/preview/preview__step_3.svg" width="230" class="preview__img">

                <p class="preview__text">Друг заполняет форму, со своими пожеланиями</p></div>
            <div class="preview__anim-r">
                <img src='../../src/images/preview/arrow-icon.png' , width='150'>
            </div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--r preview__step--first">
                <div class="preview__sub-title">Шаг 4</div>
                <img src="../../src/images/preview/preview__step_4.svg" width="250" class="preview__img">

                <p class="preview__text">Пожелания твоего друга приходят прямо к тебе на почту!</p></div>
            <div class="preview__anim-l">
                <img src='../../src/images/preview/arrow-icon.png' , width='150'>
            </div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--l preview__step--first">
                <div class="preview__sub-title">Шаг 5</div>
                <img src="../../src/images/preview/preview__step_5.svg" width="400" class="preview__img">

                <p class="preview__text">Твой друг получает самый лучший новогодний подарок!</p></div>
        </div>
    </div>
</div>
<div class="footer">© All rights reserved. Created by /var/www 2015.</div>

</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: you
 * Date: 12/12/15
 * Time: 4:26 PM
 */
require 'database.php';

if (!empty($_POST)) {
    $nameError = null;
    $emailError = null;
    $your_emailError = null;
    $your_nameError = null;


    $name = $_POST['name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $your_email = $_POST['your_email'];
    $your_name= $_POST['your_name'];


    $valid = true;
    if (empty($name)) {
        $nameError = 'Пожалуйста,введите имя';
        $valid = false;
    }
    if (empty($your_name)) {
        $nameError = 'Пожалуйста,введите Ваше имя';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    }
    if (empty($your_email)) {
        $your_emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    } else if (!filter_var($your_email, FILTER_VALIDATE_EMAIL)) {
        $your_emailError = 'Пожалуйста,введите существующий Email';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO wishes (name,email,your_email, firs_gift, first_giftlink, gift_hz ,gift_feel,your_name,second_gift,secind_giftlink,third_gift,third_giftlink) values(?, ?, ?,'test', 'test', 'test', 'test', ?, 'test', 'test', 'test','test')";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $email, $your_email, $your_name));
        Database::disconnect();
        header("Location: send.php");
    }
    $pdo = Database::connect();
    $sql = 'SELECT * FROM  ORDER BY id DESC ';
    foreach ($pdo->query($sql) as $row) {
        echo '<td><a class="btn" href="read.php?id='.$row['id'].'">Read</a></td>';
        echo '</tr>';
    }
    Database::disconnect();
}
?>
<!DOCTYPE html><html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Gift mailer</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css"><script src="../js/jquery-1-11-3.min.js"></script>
    <script src="../js/jquery-clone.min.js"></script>
</head>
<body>
<div class="header"><img src="../../src/images/page-header.png" class="header__img">

    <div class="logo"><img src="../../src/images/logo.svg" width="70" class="logo__img"><span class="logo__text">Gift Mailer</span>
    </div>
</div>
<div class="ask-block">
    <div class="g-central-block"><h3 class="ask-block__title">Узнай что хотят твои друзья<br>в подарок на Новый год</h3>
        <button class="btn">Заполни форму</button>
        <div class="ask-block__btn-wrap">
            <button class="btn-share"></button>
        </div>
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
            <div class="preview__anim"><!--img(src='../../src/images/preview/preview__anim_1.svg', width='150')--></div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--r preview__step--first">
                <div class="preview__sub-title">Шаг 2</div>
                <img src="../../src/images/preview/preview__step_2.svg" width="300" class="preview__img">

                <p class="preview__text">Друг получают анонимное письмо о том, что кто-то интересуется новогодним
                    подарком, который он хочет получить</p></div>
            <div class="preview__anim"><!--img(src='../../src/images/preview/preview__anim_2.svg', width='150')--></div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--l preview__step--first">
                <div class="preview__sub-title">Шаг 3</div>
                <img src="../../src/images/preview/preview__step_3.svg" width="230" class="preview__img">

                <p class="preview__text">Друг заполняет форму, со своими пожеланиями</p></div>
            <div class="preview__anim"><!--img(src='../../src/images/preview/preview__anim_1.svg', width='150')--></div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--r preview__step--first">
                <div class="preview__sub-title">Шаг 4</div>
                <img src="../../src/images/preview/preview__step_4.svg" width="250" class="preview__img">

                <p class="preview__text">Пожелания твоего друга приходят прямо к тебе на почту!</p></div>
            <div class="preview__anim"><!--img(src='../../src/images/preview/preview__anim_4.svg', width='150')--></div>
        </div>
        <div class="preview__step-wrap">
            <div class="preview__step preview__step--l preview__step--first">
                <div class="preview__sub-title">Шаг 5</div>
                <img src="../../src/images/preview/preview__step_5.svg" width="400" class="preview__img">

                <p class="preview__text">Твой друг получает самый лучший новогодний подарок!</p></div>
        </div>
    </div>
</div>
<div class="form-wrap">
    <div class="g-central-block"><h3 class="form__title">Узнай что хотят твои друзья<br>в подарок на Новый год</h3>

        <form action="/" class="form">
            <div class="form__row">
                <div class="form__col form__col--full-width"><label for="your_email" class="form__label">Твой
                        E-mail</label><input id="your_email" type="email" class="form__input"></div>
            </div>
            <div class="js-tpl-container">
                <div class="form__row">
                    <div class="form__col form__col--50"><label for="friend_name" class="form__label"> Имя друга</label><input
                            id="friend_name" type="email" class="form__input"></div>
                    <div class="form__col form__col--50"><label for="friend_email" class="form__label">E-mail
                            друга</label><input id="friend_email" type="text" class="form__input"></div>
                </div>
            </div>
            <a href="#" data-copy-tpl="#form-tpl" class="form__clone-tpl js-trigger-clone-tpl">Добавить еще друга</a>
            <script id="form-tpl" type="text/x-template">
                <div
                    class="form__row">
                    <span class="btn-remove js-remove-tpl"></span>
                    <div class="form__col form__col--50">
                        <label for="friend_name" class="form__label"> Имя друга</label>
                        <input id="friend_name" type="email" class="form__input"/>
                    </div>
                    <div class="form__col form__col--50">
                        <label for="friend_email" class="form__label">E-mail друга</label>
                        <input id="friend_email" type="text" class="form__input"/>
                    </div></div>
            </script><button class="btn">Отправить</button></form></div></div>
<div class="container">
    <form class="form-horizontal"  method="post">
            <div class="control-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
                <label class="control-label">Введите имя вашего друга</label>

                <div class="controls">
                    <input name="name" type="text" placeholder="Name" value="<?php echo !empty($name) ? $name : ''; ?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    <?php endif; ?>
                </div>
                <div class="controls">
                    <input name="your_name" type="text" placeholder="Name" value="<?php echo !empty($your_name) ? $your_name : ''; ?>">
                    <?php if (!empty($your_nameError)): ?>
                        <span class="help-inline"><?php echo $your_nameError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($emailError) ? 'error' : ''; ?>">
                <label class="control-label">Email Вашего Друга</label>

                <div class="controls">
                    <input name="email" type="text" placeholder="Email Address"
                           value="<?php echo !empty($email) ? $email : ''; ?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($your_emailError) ? 'error' : ''; ?>">
                <label class="control-label">Ваш Email</label>

                <div class="controls">
                    <input name="your_email" type="text" placeholder="Main Email Address"
                           value="<?php echo !empty($your_email) ? $your_email : ''; ?>">
                    <?php if (!empty($your_emailError)): ?>
                        <span class="help-inline"><?php echo $your_emailError; ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Отправил блять</button>
            </div>
        </form>
    </div>


</div>
</body>
</html>

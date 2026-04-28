<?php
require_once 'config.php';
$stmt = $pdo->query("SELECT * FROM events WHERE ID_evant IN (3, 4, 5) ORDER BY ID_evant ASC");
$events = $stmt->fetchAll();
$events_by_id = [];
foreach ($events as $event) {
    $events_by_id[$event['ID_evant']] = $event;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="darkstyle.css">
    <title>Glavnai</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="darkglavnai.php"><img class="logoimg" src="img/logotip.png" alt="Музей"></a>
            <a class="logoh1" href="darkglavnai.php"><h1 >Исторический Музей Ярославля</h1></a>
        </div>

        <a href="glavnai.php" class="theme-switch" title="Светлая тема">
            ☀️
        </a>
        
        <div class="burger-menu" id="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="nav-menu" id="nav-menu">
            <ul class="navig">
                <li><a href="omuseum.php" class="navigA">О музее</a></li>
                <li><a href="aficha.php" class="navigA">Афиша</a></li>
                <li><a href="posetitelam.php" class="navigA">Посетителям</a></li>
                <li><a href="kontacti.php" class="navigA">Контакты</a></li>
            </ul>
        </nav>
    </header>
    <main class="post">
        <h2>Ближайшие события</h2>
        <div class="postGrid">
            <?php
            $event_images = [
                3 => 'img/2.jpg', 
                4 => 'img/1.jpg',
                5 => 'img/3.jpg'
            ];

            $event_order = [3, 4, 5];
            
            foreach ($event_order as $event_id):
                $event = isset($events_by_id[$event_id]) ? $events_by_id[$event_id] : null;
                if (!$event) continue;
                
                $date_text = '';
                if ($event_id == 3) {
                    $date_text = '15 марта – 30 мая 2026';
                } elseif ($event_id == 4) {
                    $date_text = '02 февраля - 31 января';
                } elseif ($event_id == 5) {
                    $date_text = 'Каждую субботу в 12:00';
                } else {
                    if ($event['Date_start'] && $event['Date_end']) {
                        $start = date('d.m.Y', strtotime($event['Date_start']));
                        $end = date('d.m.Y', strtotime($event['Date_end']));
                        $date_text = $start . ' – ' . $end;
                    } else {
                        $date_text = 'Уточняйте дату';
                    }
                }
                
                $image_path = isset($event_images[$event_id]) ? $event_images[$event_id] : 'img/default.jpg';
            ?>
            <div class="postCard">
                <img src="<?php echo $image_path; ?>" alt="Афиша" class="postimag">
                <h3><?php echo htmlspecialchars($event['Nazvanie']); ?></h3>
                <p class="date"><?php echo htmlspecialchars($date_text); ?></p>
                <p class="descr"><?php echo htmlspecialchars($event['Opisanie']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="allpost">
            <a href="aficha.php" class="button">Все мероприятия →</a>
        </div>
    </main>

<footer>
    <div class="container footercont">
        <div class="contacts">
            <h3>Контакты</h3>
            <address>
                <p>г. Ярославль, ул. Волжская набережная, д. 10</p>
                <p><a href="tel:+74852234567">+7 (4852) 23-45-67</a></p>
                <p><a href="mailto:info@yar-museum.ru">info@yar-museum.ru</a></p>
            </address>
            <p>Мы работаем: ежедневно с 10:00 до 19:00, кроме понедельника</p>
        </div>
        <div class="navigfot">
            <h3>Навигация</h3>
            <ul class="navigfotli">
                <li><a href="darkglavnai.php">Главная</a></li>
                <li><a href="omuseum.php">О музее</a></li>
                <li><a href="aficha.php">Афиша</a></li>
                <li><a href="posetitelam.php">Посетителям</a></li>
                <li><a href="kontacti.php">Контакты</a></li>
            </ul>
        </div>
        <div class="otsiv">
    <h3>Оставить отзыв</h3>
    <form action="otsiv.php" method="post" class="otsiv-form">
        <div class="form-group">
            <label for="email">Ваш email:</label>
            <input type="email" id="email" name="email" placeholder="yourEmail@mail.ru" required>
        </div>
        <div class="form-group">
            <label for="comment">Ваш отзыв:</label>
            <textarea id="comment" name="comment" rows="4" placeholder="Поделитесь впечатлениями..." required></textarea>
        </div>
        <button type="submit" class="submitbtn">Отправить</button>
    </form>
</div>
    </div>
    <div class="footerbot">
        <p>© 2026 Исторический музей Ярославля. Все права защищены.</p>
    </div>
</footer>
<script>
    const burger = document.getElementById('burger-menu');
    const nav = document.getElementById('nav-menu');
    burger?.addEventListener('click', () => {
        burger.classList.toggle('active');
        nav.classList.toggle('active');
    });
</script>
</body>
</html>
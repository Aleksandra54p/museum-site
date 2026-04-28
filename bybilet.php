<?php
require_once 'config.php';
$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;
$event = null;
if ($event_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE ID_evant = ?");
    $stmt->execute([$event_id]);
    $event = $stmt->fetch();
}
if (!$event) {
    header('Location: aficha.php');
    exit;
}
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $familia = trim($_POST['familia']);
    $imya = trim($_POST['imya']);
    $otchestvo = trim($_POST['otchestvo']);
    $email = trim($_POST['email']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $kolvo = (int)$_POST['kolvo'];
    $price = (int)$_POST['price'];
    $errors = [];
    
    if (empty($familia)) $errors[] = 'Введите фамилию';
    if (empty($imya)) $errors[] = 'Введите имя';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Некорректный email';
    if (empty($date)) $errors[] = 'Выберите дату';
    if (empty($time)) $errors[] = 'Выберите время';
    if ($kolvo < 1) $errors[] = 'Выберите количество билетов';
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO booking_ticket (ID_evant, Familia, Imya, Otchectvo, Email, Date, Time, Kolvo_ticket, Price) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$event_id, $familia, $imya, $otchestvo, $email, $date, $time, $kolvo, $price]);
            $success_message = 'Бронирование успешно создано! Мы свяжемся с вами для подтверждения.';

            $_POST = array();
        } catch (PDOException $e) {
            $error_message = 'Ошибка при бронировании: ' . $e->getMessage();
        }
    } else {
        $error_message = implode(', ', $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Бронирование - <?php echo htmlspecialchars($event['Nazvanie']); ?></title>
</head>
<body>
    <div class="info">
        <h3>Забронировать билет: <?php echo htmlspecialchars($event['Nazvanie']); ?></h3>
        <div class="back">
            <a href="aficha.php" class="back-button"> Назад к афише</a>
        </div>
        <form action="" method="post" class="booking">
            <div class="row">
                <div class="form-group">
                    <label for="familia">Фамилия *</label>
                    <input type="text" id="familia" name="familia" value="<?php echo isset($_POST['familia']) ? htmlspecialchars($_POST['familia']) : ''; ?>" placeholder="Иванов" required>
                </div>
                <div class="form-group">
                    <label for="imya">Имя *</label>
                    <input type="text" id="imya" name="imya" value="<?php echo isset($_POST['imya']) ? htmlspecialchars($_POST['imya']) : ''; ?>" placeholder="Иван" required>
                </div>
                <div class="form-group">
                    <label for="otchestvo">Отчество</label>
                    <input type="text" id="otchestvo" name="otchestvo" value="<?php echo isset($_POST['otchestvo']) ? htmlspecialchars($_POST['otchestvo']) : ''; ?>" placeholder="Иванович">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Электронная почта *</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" placeholder="ivanov@mail.ru" required>
            </div>
            
            <div class="form-group">
                <label for="event_name">Выбранное событие</label>
                <input type="text" id="event_name" value="<?php echo htmlspecialchars($event['Nazvanie']); ?>" disabled>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Дата посещения *</label>
                    <input type="date" id="date" name="date" 
                           min="<?php echo $event['Date_start'] ?: date('Y-m-d'); ?>"
                           max="<?php echo $event['Date_end'] ?: ''; ?>"
                           value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label for="time">Время *</label>
                    <select id="time" name="time" required>
                        <option value="" disabled <?php echo !isset($_POST['time']) ? 'selected' : ''; ?>>Выберите время</option>
                        <option value="10:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '10:00') ? 'selected' : ''; ?>>10:00</option>
                        <option value="11:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '11:00') ? 'selected' : ''; ?>>11:00</option>
                        <option value="12:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '12:00') ? 'selected' : ''; ?>>12:00</option>
                        <option value="13:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '13:00') ? 'selected' : ''; ?>>13:00</option>
                        <option value="14:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '14:00') ? 'selected' : ''; ?>>14:00</option>
                        <option value="15:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '15:00') ? 'selected' : ''; ?>>15:00</option>
                        <option value="16:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '16:00') ? 'selected' : ''; ?>>16:00</option>
                        <option value="17:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '17:00') ? 'selected' : ''; ?>>17:00</option>
                        <option value="18:00" <?php echo (isset($_POST['time']) && $_POST['time'] == '18:00') ? 'selected' : ''; ?>>18:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kolvo">Количество билетов *</label>
                    <input type="number" id="kolvo" name="kolvo" min="1" max="10" value="<?php echo isset($_POST['kolvo']) ? (int)$_POST['kolvo'] : 1; ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="price">Стоимость (рублей)</label>
                <input type="text" id="price_display" readonly style="background-color: #f0f0f0; font-weight: bold;">
                <input type="hidden" id="price" name="price" value="">
                <small style="color: #666;">Цена за 1 билет: 
                    <?php 
                    if ($event['Price_min'] == $event['Price_max']) {
                        echo $event['Price_min'] . ' руб.';
                    } else {
                        echo 'от ' . $event['Price_min'] . ' до ' . $event['Price_max'] . ' руб. (зависит от категории билета)';
                    }
                    ?>
                </small>
            </div>
            
            <button type="submit" class="submitbtn">Забронировать</button>
        </form>
    </div>
    
    <script>
        const priceMin = <?php echo $event['Price_min']; ?>;
        const priceMax = <?php echo $event['Price_max']; ?>;
        
        function updatePrice() {
            let kolvo = document.getElementById('kolvo').value;
            kolvo = parseInt(kolvo) || 0;
            
            let priceDisplay = document.getElementById('price_display');
            let priceHidden = document.getElementById('price');
            
            if (priceMin === priceMax) {
                let total = priceMin * kolvo;
                priceDisplay.value = total + ' руб.';
                priceHidden.value = total;
            } else {
                let minTotal = priceMin * kolvo;
                let maxTotal = priceMax * kolvo;
                priceDisplay.value = minTotal + ' - ' + maxTotal + ' руб. (уточняйте на кассе)';
                priceHidden.value = priceMin * kolvo;
            }
        }
        
        document.getElementById('kolvo').addEventListener('input', updatePrice);
        document.getElementById('kolvo').addEventListener('change', updatePrice);
        updatePrice();
    </script>
</body>
</html>
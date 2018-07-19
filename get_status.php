<?

    // Параметры для подключения
    $db_host = "localhost";
    $db_user = ""; // Логин БД
    $db_password = ""; // Пароль БД
    $db_table = ""; // Имя Таблицы БД

    // Подключение к базе данных
    $db = mysql_connect($db_host,$db_user,$db_password) OR DIE("Не могу создать соединение ");

    // Выборка базы
    mysql_select_db("",$db);

    // Установка кодировки соединения
    mysql_query("SET NAMES 'utf8'",$db);

$quer = mysql_query("SELECT * FROM ".$db_table." LIMIT 24 ") ;

	while ($query = mysql_fetch_array ($quer))
	{
    echo  "Клиентов: ".$query["clients"].", Время: ".$query["date"]."        <br>";
    }

?>


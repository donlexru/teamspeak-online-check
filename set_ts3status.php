<?
date_default_timezone_set("Europe/Moscow");
require("config.php");

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


$count = 0;
foreach(array_reverse($roots) as $serv){
    $servip = $roots[$count][0];
    $servport = $roots[$count][1];
	$querypw = $roots[$count][2];
    try{
        $con = TeamSpeak3::factory("serverquery://serveradmin:{$querypw}@{$servip}:{$servport}/");
        $curservers = $con["virtualservers_running_total"];
    }catch(Exception $e){
        echo "Error (ID ".$e->getCode().") <b>".$e->getMessage()."</b> on IP: $servip:$servport<br/>";
    }

    $count++;

    if($curservers < $serv_limit){
        $curport = $servport;
        $curip = $servip;
        $servno = $count;
        break;
    }
}
    //-------------------------------

                                    $count = 0;
                                    $clients = 0;
                                    foreach($roots as $serv){
                                        $servip = $roots[$count][0];
                                        $servport = $roots[$count][1];
										$querypw = $roots[$count][2];
                                        //Create connection
                                        $con = TeamSpeak3::factory("serverquery://serveradmin:{$querypw}@{$servip}:{$servport}/");
                                        // Get info
                                        //$curclients = $con["virtualservers_total_clients_online"];
                                        //$curbytes = ($con["connection_bytes_received_total"] / 1024);

                                        //if($curservers < 1000){
                                            //$class = " class=\"success\"";
                                        //}else{
                                            //$class = " class=\"danger\"";
                                        //}
                                        // Calculate totals
                                        $clients = ($con["virtualservers_total_clients_online"] + $clients);
                                        //$band = ($con["connection_bytes_received_total"] + $con["connection_bytes_sent_total"] + $band);

                                        $count++; // Increment counter

                                        //echo "<tr$class>";
                                            //echo "<td>Сервер №$count</td>";
                                            //echo "<td>".number_format($curclients)."</td>";
                                            //echo "<td>".TeamSpeak3_Helper_Convert::bytes($curbytes)."</td>";
                                            //echo "<td>$servip</td>";
                                        //echo "</tr>";
										

                                    }

$cur_date = getdate();
//$cur_date =  $cur_date["year"]."-".$cur_date["mon"]."-".$cur_date["mday"]."-".$cur_date["hours"]."-".$cur_date["minutes"];
//$cur_date =  $cur_date["hours"]."-".$cur_date["minutes"]."-".$cur_date["mday"]."-".$cur_date["mon"]."-".$cur_date["year"];
$cur_date =  $cur_date["year"]."-".$cur_date["mon"]."-".$cur_date["mday"]."-".$cur_date["hours"]."-".$cur_date["minutes"];

echo "Клиентов всего: ".$clients.", Дата: ".$cur_date;

$result = mysql_query ("INSERT INTO ".$db_table." (clients,date) VALUES ('$clients','$cur_date')");

?>


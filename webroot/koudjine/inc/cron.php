<?php
// Webbax - 24.08.16 - processus pour les backups MySQL sur le FTP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$database = 'pharmanet1';
$user = 'user';
$pass = '';
$host = 'localhost';
$dir = dirname(__FILE__) . '/dump.sql';

//echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);

var_dump($output);

if(isset($_GET['token']) && $_GET['token']=='aaaa'){

    $database[0] ='pharmanet1';
    $user[0] ='root';
    $pass[0] ='';
    $server[0] ='localhost';

    //$database[1] ='';
    //$user[1] ='';
    //$pass[1] ='';
    //$server[1] ='';

    $nb_loop = count($database)-1;
    for($i=0;$i<=$nb_loop;$i++){

        $export_path = $database[$i].'_'.date("Y-m-d-H-i-s").'.gz';
        $command = 'mysqldump --opt -h '.$server[$i].' -u '.$user[$i].' -p'.$pass[$i].' '.$database[$i].' > '.$export_path;
        $output = array();
        exec($command,$output,$worked);
        $msg1 = 'Base de données <b>'.$database[$i].'</b> exporté avec succès vers l\'emplacement <b>'.$export_path.'</b><br/>';
        $msg2 = 'Il y a eu un message d\avertissement durant l\'export de la base <b>'.$database[$i].'</b> vers <b>'.$export_path .'</b><br/>';
        $msg3 = 'Il y a eu un message d\'erreur durant l\'export. Veuillez vérifier vos valeurs : <br/>
                 <br/>
                 <table>
                    <tr>
                        <td>MySQL Database Name:</td>
                        <td><b>'.$database[$i].'</b></td>
                    </tr>
                    <tr>
                        <td>MySQL User Name:</td>
                        <td><b>' .$user[$i] .'</b></td>
                    </tr>
                    <tr>
                        <td>MySQL Password:</td>
                        <td><b>NOTSHOWN</b></td>
                    </tr>
                    <tr>
                        <td>MySQL Host Name:</td>
                        <td><b>' .$server[$i] .'</b></td>
                    </tr>
                </table>
                <br/>';
        echo $worked;

        switch($worked){
        case 0:
            echo 'success';
            break;
        case 1:
            echo 'warning';
            break;
        case 2:
            echo 'Il y a eu un message d\'erreur durant l\'export. Veuillez vérifier vos valeurs : <br/>
                 <br/>
                 <table>
                    <tr>
                        <td>MySQL Database Name:</td>
                        <td><b>'.$database[$i].'</b></td>
                    </tr>
                    <tr>
                        <td>MySQL User Name:</td>
                        <td><b>' .$user[$i] .'</b></td>
                    </tr>
                    <tr>
                        <td>MySQL Password:</td>
                        <td><b>NOTSHOWN</b></td>
                    </tr>
                    <tr>
                        <td>MySQL Host Name:</td>
                        <td><b>' .$server[$i] .'</b></td>
                    </tr>
                </table>
                <br/>';
            break;
        }
    }
    
}

?>
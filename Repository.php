<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 05.05.2019
 * Time: 16:27
 */

class Repository
{
    private $dbUserName = "root";
    private $dbPassword = "";

    public function CheckCredentials($login, $password)
    {
        $link = mysql_connect('http://127.0.0.1/openserver/phpmyadmin/', this . $this->dbUserName, this . $this->dbPassword) or die('Не удалось соединиться: ' . mysql_error());
        mysql_select_db('antony_pub_agency') or die('Не удалось выбрать базу данных');

        $query = 'SELECT * FROM Clients WHERE Login = '.$login.' AND Password = '.$password.';';
        $result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());

        echo "<table>\n";
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";

        mysql_free_result($result);

        mysql_close($link);
    }

}
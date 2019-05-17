<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 14.05.2019
 * Time: 19:49
 */


$user = $_SESSION["User"];
if (isset($user) && $user != null) {
    $rep = new Repository();

    $condition = null;

    if(isset($_POST["text"]) || isset($_POST["gender"]) || isset($_POST["ageFrom"]) || isset($_POST["ageTo"]) || isset($_POST["city"]) || isset($_POST["country"])){
        $condition = "";

        $searchText = $_POST["text"];
        $searchGender = $_POST["gender"];
        $searchAgeFrom = $_POST["ageFrom"];
        $searchAgeTo = $_POST["ageTo"];
        $searchCity = $_POST["city"];
        $searchCountry = $_POST["country"];


        if( $searchText && $searchText != "")
            $condition .= " AND CONCAT(cl.FirstName, ' ', cl.LastName) LIKE '%$searchText%'";
        if($searchGender != "" && $searchGender != null)
            $condition .= " AND cl.Gender = $searchGender";
        if( $searchAgeFrom && $searchAgeFrom != "") {
            $currentYear = date("Y");
            $neededYear = $currentYear - $searchAgeFrom;

            $condition .= " AND cl.DateOfBirth <= '$neededYear'";
        }
        if( $searchAgeTo && $searchAgeTo != "") {
            $currentYear = date("Y");
            $neededYear = $currentYear - $searchAgeTo;

            $condition .= " AND cl.DateOfBirth >= '$neededYear'";
        }
        if( $searchCity && $searchCity != "")
            $condition .= " AND ct.Id = $searchCity";
        if( $searchCountry && $searchCountry != "")
            $condition .= " AND co.Id = $searchCountry";

    }



    $otherUsers = $rep->GetAllOtherUsers($user["Id"], $condition);

    if(!$otherUsers){
        echo '<h3>Не найдено ни одного пользователя</h3>';
    }
    else {

        echo '<div class="overlay_popup"></div>';
        foreach ($otherUsers as $otherUser) {


            echo '<div class="item">';

            echo '<div class="clients_img">
<img src="' . ($otherUser["Image"] ? 'data:image/png;base64,' . base64_encode($otherUser["Image"]) : "assets/images/no-image.png") . '" alt="' . $otherUser["FirstName"] . ' ' . $otherUser["LastName"] . '" width="200" height="200" >
                            </div>';

            echo '<div class="subtitle">' . $otherUser["FirstName"] . ' ' . $otherUser["LastName"] . '</div>';

            $age = null;
            if ($otherUser['DateOfBirth']) {
                $birthDate = explode("-", $otherUser['DateOfBirth']);
                //get age from date or birthdate
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
                    ? ((date("Y") - $birthDate[0]) - 1)
                    : (date("Y") - $birthDate[0]));
            }
            echo '
<div class="text">
' . ($otherUser["About"] ? 'О себе: <p>' . $otherUser["About"] . '</p><br>' : "")
                . ($age ? 'Возраст: ' . $age . '<br>' : "") . '
Пол: ' . ($otherUser["Gender"] == 1 ? "Мужской" : "Женский") . '<br>
Город: ' . $otherUser["City"] . '<br>
Страна: ' . $otherUser["Country"] . '
</div>
<button class="show_popup blue_btn" rel="popup' . $otherUser["Id"] . '">Подробнее</button>';

            echo '</div>';

            echo '
    <div class="popup" id="popup' . $otherUser["Id"] . '">
      <div class="object">
        <p>Телефон: ' . $otherUser["Phone"] . '</p>
        <p>Электронный адрес: ' . $otherUser["Email"] . '</p>
        <h3>Отправить сообщение</h3>
                <form class="m_form" method="post" name="contact" action="app/mail.php">
                <input type="number" value="' . $otherUser["Id"] . '" name="Id" style="display:none;">
                    <div class="form_row_m">
                        <label for="subject">Тема:</label>
                        <input type="text" class="validate-subject required input_field" name="subject" id="subject"/>
                    </div>
                    <div class="form_row_m">
                        <label for="text">Сообщение:</label>
                        <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                    </div>
                    <div class="form_row_m">
                        <input type="submit" value="Send" id="submit" name="submit" class="submit_btn float_l" />
                    </div>
                </form>
      </div>
    </div>';

        }
    }

} else {
    echo "Ошибка авторизации!";
    exit();
}

<?php
namespace CONTROLLER;

class ConnectionToDatabase {

    public function connection() {

        require 'model.php';

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

        return $link;
    }       
}
// global var connections to the DB for functions
$database = new ConnectionToDatabase();
$link = $database->connection();

class Autorization
{
    

    public function __construct() {

        if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {

            global $database, $link;

            $query = "SELECT * FROM users";
            $result = mysqli_query($link, $query) 
                    or die("Ошибка" . mysqli_error($link));

            $array_data = array();

            // getting arrays of usernames and passwords
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $login = $row['login'];
                $password = $row['password'];
                $array_data[] = array(
                    "login" => "$login",
                    "password" => "$password",
                );
                $i++;
            }

            $check_login = false;
            $check_password = false;

            if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
                $login_request = $_REQUEST['login'];
                $password_request = $_REQUEST['password'];
            }                

            if (isset($login_request) && isset($password_request)) {
                if (!empty($login_request)) {
                    if (!empty($password_request)) {
                        foreach ($array_data as $nested_array) {
                            if ($login_request === $nested_array['login']) {
                                $check_login = true;
                                 // function password_verify - Checks if the password matches the hash
                                if (password_verify($password_request, $nested_array['password'])) { 
                                    $check_password = true;
                                    $_SESSION['login'] = $nested_array['login'];
                                    $_SESSION['password'] = $nested_array['password'];
                                    break;
                                }
                            }                   
                        }
                        if ($check_login == false) {
                            echo "<a href='login.php'><---Назад</a><br>";
                            exit("Ошибка! Логин не найден!");
                        }
                        if ($check_password == false) {
                            echo "<a href='login.php?login=$login_request'><---Назад</a><br>";
                            exit("Ошибка! Пароль введён не правильно!");
                        }

                    }  else {
                        echo "<a href='login.php?login=$login_request'><---Назад</a><br>";
                        exit("Ошибка! Пароль не введён!");
                    }
                } else {
                    echo "<a href='login.php'><---Назад</a><br>";
                    exit("Ошибка! Логин не введён!");
                } 
            }    else {
               echo "Авторизируйтесь!</br>";
               echo "<a href='login.php'>Авторизация</a>";
           }
       }           
   }
}

class Login
{
        //destroy SESSIONs
    function login() {

        if(isset($_SESSION['login'])) {
            $_SESSION = [];
            unset($_COOKIE[session_name()]);
            session_destroy();
        }
    }

    public function get_login() {
            // when checking in authorization, so as not to re-enter the login
        if (isset($_GET['login'])) {
            return $_GET['login'];
        }

    }
}    

class Registration
{
        public function existInTheDB() {

            global $database, $link;

            $email = $_POST['e_mail'];
            $login = $_POST['login'];
            $sec_name = $_POST['surname'];
            $fst_name = $_POST['name'];
            $patronymic = $_POST['patronymic'];       


            //check login for presence in the database
            $query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($link, $query) 
                    or die("Ошибка" . mysqli_error($link));

            $row = mysqli_fetch_row($result); // select one row

            if ($row != NULL) {
                echo "<a href='registration.php?e_mail=$email&login=$login&surname=$sec_name&name=$fst_name&patronymic=$patronymic'><---Назад</a><br>";
                exit ("Ошибка! Такой E-mail уже существует!");
            }

            //check login for presence in the database
            $query = "SELECT * FROM users WHERE login='$login'";
            $result = mysqli_query($link, $query) 
                    or die("Ошибка" . mysqli_error($link));

            $row = mysqli_fetch_row($result); // select one row

            if ($row != NULL) {
                echo "<a href='registration.php?e_mail=$email&login=$login&surname=$sec_name&name=$fst_name&patronymic=$patronymic'><---Назад</a><br>";
                exit ("Ошибка! Такой Логин уже существует!");
            }
        }

        public function  addToDatabase($arrayData) {

             global $database, $link;

             $queryInsert = "INSERT INTO users VALUES(NULL,'$arrayData[0]', 
                            '$arrayData[1]', '$arrayData[2]', '$arrayData[3]', 
                            '$arrayData[4]', '$arrayData[5]')";

             $resultInsert = mysqli_query($link, $queryInsert) 
                             or die("Ошибка " . mysqli_error($link));

             mysqli_close($link);

             return $resultInsert;

        }                 
}

class EditAccount {

    public $login;

 
   public function __construct() {

        $this->login = $_SESSION['login'];

    } 

    public function getData() {

        global $database, $link;

        $_login = $this->login;

        $querySelect = "SELECT * FROM users WHERE login='$_login'";
        $resultSelect = mysqli_query($link, $querySelect) 
                        or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_row($resultSelect);
        return $row;

    }

    public function editToDatabase($arrayData) {

            global $database, $link;

            $_login = $this->login;

            $querySelect_id = "SELECT id FROM users WHERE login='$_login'";
            $resultSelect = mysqli_query($link, $querySelect_id) 
                            or die("Ошибка " . mysqli_error($link));
            $result =  mysqli_fetch_array($resultSelect);     

            $queryUpdate = "UPDATE users SET email = '$arrayData[0]', 
                                             login = '$arrayData[1]', 
                                             password = '$arrayData[2]', 
                                             surname = '$arrayData[3]', 
                                             name = '$arrayData[4]', 
                                             patronymic = '$arrayData[5]' 
                                             WHERE id = '$result[0]'";
            $resultUpdate = mysqli_query($link, $queryUpdate) 
                            or die("Ошибка " . mysqli_error($link));

            mysqli_close($link);

            $_SESSION['login'] = $arrayData[1];
            $_SESSION['password'] = $arrayData[2];

            return $resultUpdate;

        } 
    }

    // class for validation data
     class DataCheck {

        public function data_checking()
        {

            global $database, $link;

            // clean
            $e_mail = $this->clean($_POST['e_mail']);
            $login = $this->clean($_POST['login']);
            $password = $_POST['password'];
            $password_rep = $_POST['password_rep'];
            $sec_name = $this->clean($_POST['surname']);
            $fst_name = $this->clean($_POST['name']);
            $patronymic = $this->clean($_POST['patronymic']);            

            // check_length
            $i_1_res = '';
            $i_2_res = '';
            $i_3_res = '';
            $i_4_res = '';
            $i_5_res = '';
            $i_6_res = '';

            if (!empty($e_mail)) {
                $i_1 = $this->check_length($e_mail, 5, 30);
                if($i_1 == false) $i_1_res = "- E_mail менее 5 или более 30 символов<br>";
            }
            if (!empty($login)) {
                $i_2 = $this->check_length($login, 5, 30);
                if($i_2 == false) $i_2_res = "- Логин менее 5 или более 30 символов<br>";
            }
            if (!empty($password)) {
                $i_3 = $this->check_length($password, 6, 50);
                if ($i_3 == false) $i_3_res = "- Пароль менее 6 или более 50 символов<br>";
                elseif ($password != $password_rep) $i_4_res = "- пароли не совпадают<br>";
            }
            if (!empty($sec_name)) {
                $i_4 = $this->check_length($sec_name, 2, 30);
                if($i_4 == false) $i_4_res = "- Фамилия менее 2 или более 30 символов<br>";
            }
            if (!empty($fst_name)) {
                $i_5 = $this->check_length($fst_name, 2, 30);
                if($i_5 == false) $i_5_res = "- Имя менее 2 или более 30 символов<br>";
            }
            if (!empty($patronymic)) {
                $i_6 = $this->check_length($patronymic, 2, 30);
                if($i_6 == false) $i_6_res = "- Отчество менее 2 или более 30 символов<br>";
            }            

            $result = $i_1_res . $i_2_res . $i_3_res . $i_4_res . $i_5_res . $i_6_res;

            return $result;
        }

        public function clean($name) {
            $result = $name;
            $result = trim($result); // delete spaces from start and end line
            $result = stripslashes($result); // delete display symbols
            $result = strip_tags($result); // delete HTML and PHP tags
            $result = htmlspecialchars($result); // transform special symbols in HTML-essence

            return $result;
        }

        public function check_length($value, $min, $max) {

            $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);

            return !$result;
        }

        public function data_Protection($link, $var_protect) {

          $value = htmlentities(mysqli_real_escape_string($link, $var_protect));

          return $value;
      }

       public function data_transfer() {

            global $database, $link;
            
             // $data_check = $this->data_check; // property class (data_check)

            // protection against XSS attack and SQL injection
             $array_data[] = $this->data_Protection($link, $_POST['e_mail']);
             $array_data[]= $this->data_Protection($link, $_POST['login']);
             $array_data[] = $this->data_Protection($link, $_POST['password']);
             $array_data[] = $this->data_Protection($link, $_POST['surname']);
             $array_data[] = $this->data_Protection($link, $_POST['name']);
             $array_data[] = $this->data_Protection($link, $_POST['patronymic']);

            // hashing password
             $array_data[2] = password_hash($_POST['password'], PASSWORD_DEFAULT);

             return $array_data;

         }

         public function get_name() {

            // $data_check = $this->data_check; // property class (data_check)

            return $this->clean($_POST['name']);

        }

        public function get_data() {

            // $data_check = $this->data_check; // property class (data_check)

            $array_data[] = $this->clean($_POST['e_mail']);
            $array_data[] = $this->clean($_POST['login']);
            $array_data[] = $this->clean($_POST['surname']);
            $array_data[] = $this->clean($_POST['name']);
            $array_data[] = $this->clean($_POST['patronymic']);            

            return $array_data;

        }                   
     }

  class Inquiries {

    public function FirstQuery() {

        global $database, $link;

        $querySelect = "SELECT email FROM users GROUP BY email HAVING count(email) > 1";
        $resultSelect = mysqli_query($link, $querySelect) 
                        or die("Ошибка " . mysqli_error($link));
        $row = mysqli_fetch_row($resultSelect);
        return $row;

    }

    public function SecondQuery() {

        global $database, $link;

        $querySelect = "SELECT login FROM users 
                        LEFT JOIN orders ON users.id=orders.user_id 
                        WHERE orders.user_id IS NULL";
        $resultSelect = mysqli_query($link, $querySelect) 
                        or die("Ошибка " . mysqli_error($link));
        while ($row = mysqli_fetch_array($resultSelect,  MYSQLI_NUM )) {
            foreach ($row as $value)
            $array_data[] = $value;
        }
        return $array_data;
    }

    public function ThirdQuery() {

        global $database, $link;

        $querySelect = "SELECT DISTINCT u.login 
                        FROM users u, orders o 
                        WHERE u.id = o.user_id 
                        GROUP BY o.user_id 
                        HAVING count(o.user_id) > 2";
        $resultSelect = mysqli_query($link, $querySelect) 
                        or die("Ошибка " . mysqli_error($link));
         while ($row = mysqli_fetch_array($resultSelect,  MYSQLI_NUM)) {
            foreach ($row as $value)
            $array_data[] = $value;
        }
        return $array_data;
    }
  }

  ?>
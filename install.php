<?php
session_start();
include "functions.php";

$create_table_users = "CREATE TABLE users (
              id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
              login VARCHAR(30) NOT NULL,
              passwd varchar(255) NOT NULL,
              droits INT(2) NOT NULL DEFAULT 0,
              date_register TIMESTAMP)";
$passwd_admin = hash('whirlpool', "root");
$new_user_admin = "INSERT INTO `users` (`login`, `passwd`, `droits`) VALUES ('admin', '".$passwd_admin."', '1')";

$create_table_articles = "CREATE TABLE articles (
                          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          nom VARCHAR(30) NOT NULL,
                          img VARCHAR(50) NOT NULL,
                          price INT(4) NOT NULL DEFAULT 0,
                          lvl INT(2) NOT NULL DEFAULT 0,
                          skill VARCHAR (30))";

$add_default_students = "INSERT INTO `articles` (`nom`, `img`, `price`, `lvl`) VALUES
('Florent Giraud', 'https://cdn.intra.42.fr/userprofil/fgiraud.jpg', 5, 6),
('Alexis Le Naourese', 'https://cdn.intra.42.fr/userprofil/ale-naou.jpg', 5, 5),
('Felix Junior Frimpong', 'https://cdn.intra.42.fr/userprofil/ffrimpon.jpg', 5, 5),
('Thomas Dupont', 'https://cdn.intra.42.fr/userprofil/tdupont.jpg', 5, 2),
('Audrey Boucher', 'https://cdn.intra.42.fr/userprofil/aboucher.jpg', 15, 7),
('Michael Aboukrat', 'https://cdn.intra.42.fr/userprofil/maboukra.jpg', 5, 5)";

$create_table_categories = "CREATE TABLE categories (
                          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          nom VARCHAR(30) NOT NULL)";

$add_default_cat = "INSERT INTO `categories` (`nom`) VALUES ('Ninja du code'),
                                                            ('Enfant de dragon'),
                                                            ('Camouflage'),
                                                            ('Belge'),
                                                            ('Abonne absent')";


$server = "mysql-hypertrading.alwaysdata.net";
$username = "121422";
$passwd = "rootme42";
/*$server = "localhost";
$username = "root";
$passwd = "root";*/
if (!$db = mysqli_connect($server, $username, $passwd))
{
    echo "Failure in connection database initial !";
}
else
{

    if (!mysqli_query($db, "CREATE DATABASE IF NOT EXISTS hypertrading_rush00"))
    {
        echo "Error creation database<br>";
        exit ();
    }
    else
    {
        echo "Creation database ok<br>";
        mysqli_close($db);
    }
    if ($db = db_init()) {
        $requete = mysqli_query($db, "SHOW TABLES LIKE 'users' ");
        if (mysqli_num_rows($requete) != 1) {
            if (mysqli_query($db, $create_table_users))
            {
                echo "Table users ok<br>";
                if (mysqli_query($db, $new_user_admin))
                    echo "Admin account ok<br>";
                else
                    echo "Error creation admin account<br>";
            } else
                echo "Error creation table users<br>";
        }
        else
            echo "Table users already exists<br>";
        $requete = mysqli_query($db, "SHOW TABLES LIKE 'articles'");
        if (mysqli_num_rows($requete) != 1)
        {
            if (mysqli_query($db, $create_table_articles))
            {
                echo "Table articles ok<br>";
                if (mysqli_query($db, $add_default_students))
                    echo "Default Students added<br>";
                else
                    echo "Error creation default students<br>";
            } else
                echo "Error creation table articles<br>";
        }
        else
            echo "Table article already exists<br>";
        $requete = mysqli_query($db, "SHOW TABLES LIKE 'categories'");
        if (mysqli_num_rows($requete) != 1)
        {
            if (mysqli_query($db, $create_table_categories))
            {
                echo "Table categories ok<br>";
                if (mysqli_query($db, $add_default_cat))
                    echo "Default categories created<br>";
                else
                    echo "Error creation default categories<br>";
            }
            else
                echo "Error creation table categories<br>";
        }
        else
            echo "Table categories already exists<br>";
    }
    else
        echo "Failure in connection database vk_ale_rush00 !";
}

?>
<a href="index.php"><button>Allez vers l'index</button></a>
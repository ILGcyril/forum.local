<?php
require_once "../config/config.php";

class forumDB 
{
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $connect;
    private $charset;

    public function __construct()
    {
        //создание подключения, основа класса. константы из forum.local/config/config.php
        $this->host     = HOST;
        $this->user     = USER;
        $this->password = PASSWORD;
        $this->dbname   = DBNAME;
        $this->charset  = CHARSET;
    
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
    
        try {
            $this->connect = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // выбрасывает исключения при ошибках
                PDO::ATTR_EMULATE_PREPARES => false, // настоящие prepared statements
            ]);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public function insertUser($login, $password)
    {
        //запись нового пользователя
        $stmt = $this->connect->prepare("INSERT INTO users (login, password) VALUES (:login, :password);");
        $stmt->bindParam(":login", $login);
        $stmt->bindParam(":password", $password);
        return $stmt->execute();
    }

    public function checkLogin($login)
    {
        //проверка: есть ли пользователь с определенным логином?  (return 0 / return 1)
        $stmt = $this->connect->prepare("SELECT count(*) FROM users WHERE login = :login;");
        $stmt->bindParam(":login", $login);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getUser($login)
    {
        //информация по пользователю по логину
        $stmt = $this->connect->prepare("SELECT id, login, password FROM users WHERE login = :login LIMIT 1;");
        $stmt->bindParam(":login", $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNewPost($user_id, $title, $post) 
    {
        //создание нового поста
        $stmt = $this->connect->prepare("INSERT INTO posts (user_id, title, post) VALUES (:user_id, :title, :post);");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":post", $post);
        return $stmt->execute();
    }

    public function getPosts()
    {
        //вытаскиваем информацию по всем постам. массив со строчками таблицы, где строка - пост.
        $stmt = $this->connect->prepare("SELECT u.login, p.title, p.post 
                                        FROM posts p
                                        JOIN users u ON p.user_id = u.id ORDER BY created_at DESC; ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersPosts($login)
    {
        //все посты определенного юзера
        $stmt = $this->connect->prepare("SELECT p.id, u.login, p.title, p.post 
                                        FROM posts p
                                        JOIN users u ON p.user_id = u.id WHERE u.login = :login ORDER BY created_at DESC; ");
        $stmt->bindParam(":login", $login);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePost($id)
    {
        //удаляем пост по его айди
        $stmt = $this->connect->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $this;
    }

    public function getPostById($id)
    {
        //мы находим пост по АЙДИ ПОСТА, не юзера
        $stmt = $this->connect->prepare("SELECT id, user_id, title, post FROM posts WHERE id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $post)
    {   
        //обновляем пост, его имя и содержание
        $stmt = $this->connect->prepare("UPDATE posts SET title = :title, post = :post WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(":post", $post);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
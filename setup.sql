CREATE database forum;

USE forum;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

create table posts(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id int,
  title varchar(100),
  post varchar(300),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCEs users(id)
);

INSERT INTO users (login, password) VALUES ('admin', '12345');
INSERT INTO posts (user_id, title, post) VALUES (1, 'Первый пост', 'Привет, форум!');
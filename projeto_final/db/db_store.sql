CREATE devstart_store;

USE devstart_store;

CREATE TABLE categories(
  id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(255) NOT NULL
);

CREATE TABLE products(
  id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  description VARCHAR(255) NOT NULL,
  photo VARCHAR(255) NOT NULL,
  value DECIMAL(10,2) NOT NULL,
  category_id INT(11) NOT NULL,
  quantity INT(5) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
);

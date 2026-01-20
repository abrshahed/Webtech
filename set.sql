CREATE DATABASE amarshops;
USE amarshops;

CREATE TABLE seller (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT,
    title VARCHAR(200),
    price DOUBLE,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buyer_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    seller_id INT,
    quantity INT,
    price DOUBLE
);
ALTER TABLE products
ADD FOREIGN KEY (seller_id) REFERENCES seller(id);

ALTER TABLE order_items
ADD FOREIGN KEY (order_id) REFERENCES orders(id),
ADD FOREIGN KEY (product_id) REFERENCES products(id),
ADD FOREIGN KEY (seller_id) REFERENCES seller(id);

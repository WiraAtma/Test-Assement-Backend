-- Create Table

CREATE TABLE Customers (
    customer_id INT PRIMARY KEY,
    customer_name VARCHAR(100),
    email VARCHAR(100),
    city VARCHAR(100)
);

CREATE TABLE Products (
    product_id INT PRIMARY KEY,
    product_name VARCHAR(100),
    price DECIMAL(10,2)
);

CREATE TABLE Orders (
    order_id INT PRIMARY KEY,
    customer_id INT,
    product_id INT,
    order_date DATE,
    quantity INT,
    total_price DECIMAL(10,2),
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

-- Insert Data

INSERT INTO Customers (customer_id, customer_name, email, city) VALUES
(1, 'Alice', 'alice@gmail.com', 'New York'),
(2, 'Bob', 'bob@gmail.com', 'Chicago');

INSERT INTO Products (product_id, product_name, price) VALUES
(101, 'Laptop', 25.00),
(102, 'Phone', 25.00);

INSERT INTO Orders (order_id, customer_id, product_id, order_date, quantity, total_price) VALUES
(1, 1, 101, '2023-01-10', 2, 50.00),
(2, 1, 102, '2023-02-15', 1, 25.00),
(3, 1, 101, '2023-03-22', 5, 125.00);

-- Create Index untuk Meningkatkan Peforma

CREATE INDEX idx_city ON Customers(city);
CREATE INDEX idx_customer_id ON Orders(customer_id);
CREATE INDEX idx_product_id ON Orders(product_id);

-- Query Awal Yang Dimana Kurang Optimal

SELECT c.customer_name, p.product_name, SUM(o.total_price) AS total_spent
FROM Customers c
JOIN Orders o ON c.customer_id = o.customer_id
JOIN Products p ON o.product_id = p.product_id
WHERE c.city = 'New York'
GROUP BY c.customer_name, p.product_name;

-- Query Yang sudah di Optimalisasi Strukturnya Sama Namun Peforma Lebih Baik Karena ada Index

EXPLAIN SELECT c.customer_name, p.product_name, SUM(o.total_price) AS total_spent
FROM Customers c
JOIN Orders o ON c.customer_id = o.customer_id
JOIN Products p ON o.product_id = p.product_id
WHERE c.city = 'New York'
GROUP BY c.customer_name, p.product_name;

USE lyza_system;

SELECT id, productName from products;

-- SELECT * FROM transactions;
-- SELECT SUM(COALESCE(t.totalPrice, 0)) AS total_price 
-- FROM transactions t ;

-- SELECT totalPrice, t.createdAt
-- FROM transactions t
-- WHERE t.createdAt >= DATE_FORMAT(NOW(), '%Y-%m-01') 
--   AND t.createdAt < DATE_FORMAT(NOW() +  INTERVAL 1 MONTH, '%Y-%m-01'); 

-- SELECT SUM(COALESCE(t.totalPrice, 0)) AS total_price
-- FROM transactions t
-- WHERE t.createdAt >= DATE_FORMAT(NOW(), '%Y-%m-01') 
--   AND t.createdAt < DATE_FORMAT(NOW() +  INTERVAL 1 MONTH, '%Y-%m-01'); 

-- SELECT SUM(COALESCE(t.totalPrice, 0)) AS total_price FROM transactions t 
-- WHERE MONTH(t.createdAt) = MONTH(NOW() - INTERVAL 2 MONTH) AND YEAR(t.createdAt) = YEAR(NOW());
-- SELECT SUM(COALESCE(t.totalPrice, 0)) AS total_price FROM transactions t 
-- WHERE MONTH(t.createdAt) = MONTH(NOW() - INTERVAL 1 MONTH) AND YEAR(t.createdAt) = YEAR(NOW());
-- SELECT SUM(COALESCE(t.totalPrice, 0)) AS total_price FROM transactions t 
-- WHERE MONTH(t.createdAt) = MONTH(NOW() - INTERVAL 0 MONTH) AND YEAR(t.createdAt) = YEAR(NOW());
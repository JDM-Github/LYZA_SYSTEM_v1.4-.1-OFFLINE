USE lyza_system;

-- SELECT id, productName from products;

-- ALTER TABLE products
-- ADD COLUMN physicalCount INT DEFAULT NULL;

-- ALTER TABLE products
-- ADD COLUMN investigation VARCHAR(255);

ALTER TABLE products
MODIFY COLUMN physicalCount INT DEFAULT NULL;



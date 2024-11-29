USE lyza_system;
    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Bioflu', 6.0, 20, 'Medicine', 
            'Tablet', 'Phenylephrine Hydrochloride + Chlorphenamine Maleate + Paracetamol', 'bioflu500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 20, 20, '2026-12-30');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Tempra + Forte', 120.0, 10, 'Medicine', 
            'Box', 'Paracetamol', 'tempraforte500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 10, 10, '2027-01-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Lomotil 2mg', 13.0, 10, 'Medicine', 
            'Tablet', 'Loperamide HCI', 'lomotil2mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 10, 10, '2027-02-20');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Rubitussin DM 120ml', 245.0, 5, 'Medicine', 
            'Box', 'Dextromethorphan Hydrobromide + Guaifensin', 'robitussindm120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 5, 5, '2027-03-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Mucosolvan 30mg', 21.0, 10, 'Medicine', 
            'Tablet', 'Ambroxol HCI', 'mucosolvan30mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 10, 10, '2027-04-25');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Advil 200mg', 10.0, 10, 'Medicine', 
            'Tablet', 'Ibuprofen', 'advil200mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 10, 10, '2027-05-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'RiteMED', 7.0, 5, 'Medicine', 
            'Tablet', 'Losartan Potassium + Amlodipine Besilate', 'ritemedlosartan100mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 5, 5, '2027-06-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Comxicla 625mg', 625.0, 5, 'Medicine', 
            'Bottle', 'Co-Amoxiclav', 'comxicla.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 5, 5, '2027-07-20');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Biogesic', 6.0, 10, 'Medicine', 
            'Tablet', 'Paracetamol', 'biogesic500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 10, 10, '2027-08-25');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Symdex D Forte', 7.5, 10, 'Medicine', 
            'Tablet', 'Phenylephrine HCI Chlorphenamine Maleate Paracetamol', 'symdexdforte.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 10, 10, '2027-09-30');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Imodium', 20.0, 5, 'Medicine', 
            'Tablet', 'Loperamide', 'imodium.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 5, 5, '2027-10-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Celixib', 8.0, 2, 'Medicine', 
            'Tablet', 'Celecoxib', 'celixib.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 2, 2, '2027-11-20');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Cherifer 240ml', 395.0, 5, 'Supplement', 
            'Box', 'Cherifer', 'cherifersyrup.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 5, 5, '2027-12-25');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Propan TLC', 435.0, 5, 'Supplement', 
            'Box', 'Propan', 'propantlc.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 5, 5, '2028-01-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Nutrilin 120ml', 35.0, 5, 'Supplement', 
            'Box', 'Nutrilin', 'nutrilin120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 5, 5, '2028-02-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Ceelin Plus', 385.0, 5, 'Supplement', 
            'Box', 'Ascorbic Acid Zinc', 'ceelinplus60ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 5, 5, '2028-03-20');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Growee 120ml', 230.0, 10, 'Supplement', 
            'Box', 'Growee', 'growee120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 10, 10, '2028-04-25');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Bioflu', 6.0, 100, 'Medicine', 
            'Tablet', 'Phenylephrine Hydrochloride + Chlorphenamine Maleate + Paracetamol', 'bioflu500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2025-12-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Tempra + Forte', 120.0, 50, 'Medicine', 
            'Box', 'Paracetamol', 'tempraforte500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 50, 50, '2026-03-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Lomotil 2mg', 13.0, 100, 'Medicine', 
            'Tablet', 'Loperamide HCI', 'lomotil2mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 100, 100, '2025-04-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Rubitussin DM 120ml', 245.0, 30, 'Medicine', 
            'Box', 'Dextromethorphan Hydrobromide + Guaifensin', 'robitussindm120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 30, 30, '2024-11-02');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Mucosolvan 30mg', 21.0, 50, 'Medicine', 
            'Tablet', 'Ambroxol HCI', 'mucosolvan30mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 50, 50, '2026-02-16');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Advil 200mg', 10.0, 100, 'Medicine', 
            'Tablet', 'Ibuprofen', 'advil200mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2024-10-09');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Biogesic', 6.0, 200, 'Medicine', 
            'Tablet', 'Paracetamol', 'biogesic500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 200, 200, '2025-03-06');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Celixib', 8.0, 50, 'Medicine', 
            'Tablet', 'Celecoxib', 'celixib.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 50, 50, '2025-12-30');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Imodium', 20.0, 50, 'Medicine', 
            'Tablet', 'Loperamide', 'imodium.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 50, 50, '2025-08-29');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'RiteMED', 7.0, 50, 'Medicine', 
            'Tablet', 'Losartan Potassium + Amlodipine Besilate', 'ritemedlosartan100mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 50, 50, '2026-02-22');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Rubitussin DM 120ml', 245.0, 50, 'Medicine', 
            'Box', 'Dextromethorphan Hydrobromide + Guaifensin', 'robitussindm120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 50, 50, '2024-11-02');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Mucosolvan 30mg', 21.0, 50, 'Medicine', 
            'Tablet', 'Ambroxol HCI', 'mucosolvan30mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 50, 50, '2026-02-16');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Tempra + Forte', 120.0, 50, 'Medicine', 
            'Box', 'Paracetamol', 'tempraforte500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 50, 50, '2026-03-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Advil 200mg', 10.0, 100, 'Medicine', 
            'Tablet', 'Ibuprofen', 'advil200mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 100, 100, '2024-10-09');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Bioflu', 6.0, 200, 'Medicine', 
            'Tablet', 'Phenylephrine Hydrochloride + Chlorphenamine Maleate + Paracetamol', 'bioflu500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 200, 200, '2025-12-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Tempra + Forte', 120.0, 100, 'Medicine', 
            'Box', 'Paracetamol', 'tempraforte500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2026-03-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Lomotil 2mg', 13.0, 200, 'Medicine', 
            'Tablet', 'Loperamide HCI', 'lomotil2mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 200, 200, '2025-04-15');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Rubitussin DM 120ml', 245.0, 60, 'Medicine', 
            'Box', 'Dextromethorphan Hydrobromide + Guaifensin', 'robitussindm120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 60, 60, '2024-11-02');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Mucosolvan 30mg', 21.0, 100, 'Medicine', 
            'Tablet', 'Ambroxol HCI', 'mucosolvan30mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2026-02-16');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Advil 200mg', 10.0, 200, 'Medicine', 
            'Tablet', 'Ibuprofen', 'advil200mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 200, 200, '2024-10-09');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Symdex D Forte', 7.5, 200, 'Medicine', 
            'Tablet', 'Phenylephrine HCI Chlorphenamine Maleate Paracetamol', 'symdexdforte.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 200, 200, '2024-12-22');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Biogesic', 6.0, 400, 'Medicine', 
            'Tablet', 'Paracetamol', 'biogesic500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 400, 400, '2025-03-06');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Celixib', 8.0, 100, 'Medicine', 
            'Tablet', 'Celecoxib', 'celixib.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 100, 100, '2025-12-30');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Imodium', 20.0, 100, 'Medicine', 
            'Tablet', 'Loperamide', 'imodium.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2025-08-29');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'RiteMED', 7.0, 100, 'Medicine', 
            'Tablet', 'Losartan Potassium + Amlodipine Besilate', 'ritemedlosartan100mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 100, 100, '2026-02-22');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Rubitussin DM 120ml', 245.0, 100, 'Medicine', 
            'Box', 'Dextromethorphan Hydrobromide + Guaifensin', 'robitussindm120ml.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2024-11-02');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (3, 'Mucosolvan 30mg', 21.0, 100, 'Medicine', 
            'Tablet', 'Ambroxol HCI', 'mucosolvan30mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (3, 3, LAST_INSERT_ID(), 100, 100, '2026-02-16');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Tempra + Forte', 120.0, 100, 'Medicine', 
            'Box', 'Paracetamol', 'tempraforte500mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 100, 100, '2026-03-10');
    

    INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
                          productUnit, genericBrand, productImage)
    VALUES (2, 'Advil 200mg', 10.0, 200, 'Medicine', 
            'Tablet', 'Ibuprofen', 'advil200mg.png');
    

    INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
    VALUES (2, 2, LAST_INSERT_ID(), 200, 200, '2024-10-09');
    

USE lyza_system;

SELECT * FROM stockHistory 
                                    WHERE productId = 1
                                    AND discarded = FALSE 
                                    AND expirationDate > NOW() 
                                    ORDER BY expirationDate ASC;
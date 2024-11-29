# # import pandas as pd
# # file_path = 'your_file.xlsx'
# # df = pd.read_excel(file_path)

# # table_name = 'your_table_name'

# # sql_script = f"INSERT INTO {table_name} ({', '.join(df.columns)}) VALUES\n"

# # for index, row in df.iterrows():
# #     values = ', '.join([f"'{str(value)}'" if value is not None else 'NULL' for value in row])
# #     sql_script += f"({values}),\n"

# # sql_script = sql_script.rstrip(',\n') + ';'
# # with open('insert_script.sql', 'w') as f:
# #     f.write(sql_script)

# # # print("SQL script has been generated and saved as insert_script.sql")
# import random
# import json
# import pandas as pd

# # Load the Excel file
# file_path = r"C:\Users\JDM\Documents\TRANSACTION-SAMPLE.xlsx"  # Path to your .xlsx file
# df = pd.read_excel(file_path)

# # Define mappings for branches and staff (replace with actual IDs from your database)
# branch_mapping = {
#     "San Isidro Norte": 3,  # Example branch name to branch ID mapping
#     "San Miguel": 2,  # Example branch name to branch ID mapping
#     # Add more branches here as needed
# }

# staff_mapping = {
#     "San Isidro Norte Staff": 3,  # Example staff name to staff ID mapping
#     "San Miguel Staff": 2
#     # Add more staff here as needed
# }

# # # Generate the SQL script for products and stockHistory inserts
# # sql_script = ""

# # # SQL for inserting products
# # for index, row in df.iterrows():
# #     branch_id = branch_mapping.get(row["Branch"], None)
# #     staff_id = staff_mapping.get(row["Staff Restocked"], None)
    
# #     if not branch_id or not staff_id:
# #         continue  # Skip if branch_id or staff_id is missing
    
# #     product_price = row["Price"]  
# #     product_name = row["Brand Name"]
# #     product_category = row["Category"]
# #     product_unit = row["Unit"]
# #     product_stock = row["Stock or Quantity"]
# #     product_image = row["Image"]
# #     product_generic_brand = row["Generic Name"]
    
# #     # Insert into products table
# #     insert_product_sql = f"""
# #     INSERT INTO products (branchId, productName, productPrice, productStock, productCategory, 
# #                           productUnit, genericBrand, productImage)
# #     VALUES ({branch_id}, '{product_name}', {product_price}, {product_stock}, '{product_category}', 
# #             '{product_unit}', '{product_generic_brand}', '{product_image}');
# #     """
# #     sql_script += insert_product_sql + "\n"
    
# #     # Now, insert into stockHistory table
# #     expiration_date = row["Expiry Date"].strftime('%Y-%m-%d') if isinstance(row["Expiry Date"], pd.Timestamp) else 'NULL'
# #     quantity = row["Stock or Quantity"]
# #     insert_stock_history_sql = f"""
# #     INSERT INTO stockHistory (branchId, staffId, productId, quantity, remainingStock, expirationDate)
# #     VALUES ({branch_id}, {staff_id}, LAST_INSERT_ID(), {quantity}, {quantity}, '{expiration_date}');
# #     """
# #     sql_script += insert_stock_history_sql + "\n"

# # # Save the SQL script to a file
# # with open('insert_script.sql', 'w') as f:
# #     f.write(sql_script)

# # print("SQL script has been generated and saved as insert_script.sql")


# def get_product_id(product_name, generic_brand):
#     # Simulating querying the products table and getting productId based on name or brand
#     # This function should be replaced by a real database query
#     product_id_map = {
#     "Bioflu": 1,
#     "Tempra + Forte": 2,
#     "Lomotil 2mg": 3,
#     "Rubitussin DM 120ml": 4,
#     "Mucosolvan 30mg": 5,
#     "Advil 200mg": 6,
#     "RiteMED": 7,
#     "Comxicla 625mg": 8,
#     "Biogesic": 9,
#     "Symdex D Forte": 10,
#     "Imodium": 11,
#     "Celixib": 12,
#     "Cherifer 240ml": 13,
#     "Propan TLC": 14,
#     "Nutrilin 120ml": 15,
#     "Ceelin Plus": 16,
#     "Growee 120ml": 17,
#     "Tempra + Forte": 19,
#     "Lomotil 2mg": 20,
#     "Rubitussin DM 120ml": 21,
#     "Mucosolvan 30mg": 22,
#     "Advil 200mg": 23,
#     "Biogesic": 24,
#     "Celixib": 25,
#     "Imodium": 26,
#     "RiteMED": 27,
#     "Rubitussin DM 120ml": 28,
#     "Mucosolvan 30mg": 29,
#     "Tempra + Forte": 30,
#     "Advil 200mg": 31,
#     "Bioflu": 32,
#     "Tempra + Forte": 33,
#     "Lomotil 2mg": 34,
#     "Rubitussin DM 120ml": 35,
#     "Mucosolvan 30mg": 36,
#     "Advil 200mg": 37,
#     "Symdex D Forte": 38,
#     "Biogesic": 39,
#     "Celixib": 40,
#     "Imodium": 41,
#     "RiteMED": 42,
#     "Rubitussin DM 120ml": 43,
#     "Mucosolvan 30mg": 44,
#     "Tempra + Forte": 45,
#     "Advil 200mg": 46
# }

#     return product_id_map.get(product_name, None)

# # Generate the SQL script for productOrdered and transactions inserts
# sql_script = ""

# for index, row in df.iterrows():
#     branch_id = branch_mapping.get(row["Branch"], None)
#     staff_id = staff_mapping.get(row["Cashier"], None)
    
#     if not branch_id or not staff_id:
#         continue  # Skip if branch_id or staff_id is missing
    
#     # Process the item list and quantities
#     item_list = row["Item List"].split(', ')
#     qty_per_item = list(map(int, row["Qty per Item"].split(', ')))
    
#     product_ordered_ids = []
#     for item, qty in zip(item_list, qty_per_item):
#         product_id = get_product_id(item, item)  # Get product ID based on product name
#         if product_id:
#             # Insert into productOrdered table
#             insert_product_ordered_sql = f"""
#             INSERT INTO productOrdered (productId, numberProduct)
#             VALUES ({product_id}, {qty});
#             """
#             sql_script += insert_product_ordered_sql + "\n"
#             product_ordered_ids.append(product_id)
    
#     total_amount = row["Total Amount"]
#     discount_added = row["Discount Added"]
#     cash_received = row["Cash Received"]
#     change = row["Change"]
    
#     # Calculate discounts
#     senior_discount = True if row["Discount Type"] == "Senior" else False
#     pwd_discount = True if row["Discount Type"] == "PWD" else False

#     product_ordered_json = json.dumps({"id": product_ordered_ids})
    
#     insert_transaction_sql = f"""
#     INSERT INTO transactions (productOrderedIds, branchId, staffId, totalPrice, cashPrice, changePrice, seniorDiscount, pwdDiscount)
#     VALUES ('{product_ordered_json}', {branch_id}, {staff_id}, {total_amount}, {cash_received}, {change}, {senior_discount}, {pwd_discount});
#     """
#     sql_script += insert_transaction_sql + "\n"


# # Save the SQL script to a file
# with open('insert_transactions_script.sql', 'w') as f:
#     f.write(sql_script)

# print("SQL script for transactions has been generated and saved as insert_transactions_script.sql")
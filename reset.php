<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th.price,
        td.price {
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>QTY</th>
                <th>ITEM</th>
                <th class="price">PRICE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Example Item 1</td>
                <td class="price">$10.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Example Item 2</td>
                <td class="price">$20.00</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Example Item 3</td>
                <td class="price">$30.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>Total</td>
                <td class="price">$60.00</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
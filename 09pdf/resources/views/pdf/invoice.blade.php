<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Factura</h1>
    <p>Fecha: {{ date('d/m/Y') }}</p>
    <p>Cliente: Juan</p>
    <p>Dirección: Calle x</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Laptop</td>
                    <td>1</td>
                    <td>1000</td>
                    <td>1000</td>
                </tr>
        </tbody>
    </table>

    <h2>Total: 1000</h2>
</body>
</html>
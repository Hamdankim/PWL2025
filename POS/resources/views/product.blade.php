<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f8f9fa;
        }
        h2 {
            color: #333;
        }
        .container {
            width: 90%;
            margin: auto;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .product-card {
            width: 30%;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-card h5 {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Category: {{ ucwords(str_replace('-', ' ', $category)) }}</h2>

    @if(empty($products))
        <p>No products found in this category.</p>
    @else
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <h5>{{ $product['name'] }}</h5>
                    <p>Price: Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>

</body>
</html>

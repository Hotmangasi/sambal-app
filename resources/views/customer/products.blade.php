<!DOCTYPE html>
<html lang="en">
<head>
    <title>Produk Sambal</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <div>
        @foreach($products as $product)
            <div>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <img src="{{ $product->image }}" alt="{{ $product->name }}" width="200">
            </div>
        @endforeach
    </div>
</body>
</html>

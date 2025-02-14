<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .tree-overview-container {
    display: flex;
    gap: 20px;
}

.tree-card {
    width: 30%;
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
}

.tree-card img {
    width: 100%;
    height: auto;
}

.tree-detail-container {
    max-width: 800px;
    margin: 0 auto;
}

.tree-images img {
    width: 100%;
    height: auto;
}

        </style>
</head>
<body>
    <div class="tree-detail-container">
        <h1>{{ $tree->common_name }}</h1>
        <div class="tree-images">
            <img src="{{ asset('storage/' . $tree->tree_image) }}" alt="Tree Image">
            <!-- Additional images or gallery can be added here -->
        </div>
        <div class="tree-info">
            <h2>About</h2>
            <p><strong>Family:</strong> {{ $tree->family_name }}</p>
            <p><strong>Species:</strong> {{ $tree->species_name }}</p>
            <p><strong>Location:</strong> {{ $tree->location }}</p>
            <p><strong>Uses:</strong> {{ $tree->tree_uses }}</p>
            <p><strong>Description:</strong> {{ $tree->other_information }}</p>
            <h3>QR Code</h3>
            <img src="{{ asset('storage/' . $tree->qr_code) }}" alt="QR Code">
        </div>
    </div>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Tree</title>
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
    <h1>Tree detiels</h1>
    <div class="tree-overview-container">
        @foreach($trees as $tree)
            <div class="tree-card">
                <img src="{{ asset('storage/' . $tree->tree_image) }}" alt="Tree Image">
                <h3>{{ $tree->common_name }}</h3>
                <p>{{ Str::limit($tree->description, 150) }}</p>
                <a href="{{ route('tree.view', $tree->slug) }}" class="btn btn-primary">Read More</a>
            </div>
        @endforeach
    </div>
    
</body>
</html>

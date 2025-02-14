<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tree->common_name }} - Tree Details</title>
</head>
<body>
    <h1>{{ $tree->common_name }}</h1>
    <p><strong>Family:</strong> {{ $tree->family_name }}</p>
    <p><strong>Species:</strong> {{ $tree->species_name }}</p>
    <p><strong>Location:</strong> {{ $tree->location }}</p>
    <p><strong>Tree Uses:</strong> {{ $tree->tree_uses }}</p>
    <p><strong>Distribution:</strong> {{ $tree->distribution }}</p>
    <p><strong>Other Information:</strong> {{ $tree->other_information }}</p>

    @if ($tree->tree_image)
        <img src="{{ asset('storage/' . $tree->tree_image) }}" alt="Tree Image" width="200">
    @endif

    @if ($tree->qr_code)
        <h3>Scan this QR Code:</h3>
        <img src="{{ asset('storage/' . $tree->qr_code) }}" alt="QR Code" width="200">
    @endif
</body>
</html>

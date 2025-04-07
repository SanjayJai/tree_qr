<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tree Details - Cyberpunk UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        body {
            background: radial-gradient(circle at top, #121212, #000000);
            color: white;
            font-family: 'Orbitron', sans-serif;
            overflow-x: hidden;
        }

        .tree-detail-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(0, 255, 157, 0.4);
            box-shadow: 0px 10px 30px rgba(0, 255, 157, 0.3);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .tree-detail-container:hover {
            transform: scale(1.02);
            box-shadow: 0px 15px 50px rgba(0, 255, 157, 0.6);
        }

        .tree-detail-container h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #00ff9d;
            text-shadow: 0 0 10px #00ff9d, 0 0 20px #00ff9d;
        }

        .tree-images img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        }

        .tree-images img:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 40px rgba(0, 255, 157, 0.5);
        }

        .tree-info {
            margin-top: 20px;
            font-size: 1.2rem;
        }

        .tree-info h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #00eaff;
            text-shadow: 0 0 10px #00eaff;
        }

        .tree-info p {
            margin: 12px 0;
            padding: 12px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            box-shadow: inset 0px 3px 10px rgba(0, 255, 157, 0.2);
            transition: 0.3s ease-in-out;
        }

        .tree-info p:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.02);
        }

        .neon-button {
            display: inline-block;
            background: linear-gradient(90deg, #00ff9d, #00eaff);
            color: black;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: 0.3s ease-in-out;
            box-shadow: 0 0 15px rgba(0, 255, 157, 0.8);
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .neon-button:hover {
            box-shadow: 0 0 20px rgba(0, 255, 157, 1), 0 0 40px rgba(0, 255, 157, 1);
            transform: scale(1.1);
        }

        .qr-container {
            margin-top: 20px;
        }

        .qr-container img {
            width: 150px;
            height: auto;
            border-radius: 10px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0px 5px 15px rgba(0, 255, 157, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .qr-container img:hover {
            transform: scale(1.1);
            box-shadow: 0px 10px 30px rgba(0, 255, 157, 0.5);
        }

        .neon-border {
            border: 2px solid rgba(0, 255, 157, 0.5);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 157, 0.3);
        }

        /* Glowing Animation */
        @keyframes glow {
            0% { box-shadow: 0 0 10px rgba(0, 255, 157, 0.4); }
            50% { box-shadow: 0 0 20px rgba(0, 255, 157, 0.7); }
            100% { box-shadow: 0 0 10px rgba(0, 255, 157, 0.4); }
        }
    </style>
</head>
<body>

    <div class="tree-detail-container">
        <h1>{{ $tree->common_name }}</h1>
        <div class="tree-images">
            <img src="{{ asset('storage/' . $tree->tree_image) }}" alt="Tree Image">
        </div>

        <div class="tree-info">
            <h2>About the Tree</h2>
            <p class="neon-border"><strong>Family:</strong> {{ $tree->family_name }}</p>
            <p class="neon-border"><strong>Species:</strong> {{ $tree->species_name }}</p>
            <p class="neon-border"><strong>Location:</strong> {{ $tree->location }}</p>
            <p class="neon-border"><strong>Uses:</strong> {{ $tree->tree_uses }}</p>
            <p class="neon-border"><strong>Description:</strong> {{ $tree->other_information }}</p>
        </div>

        <div class="qr-container">
            <h3 class="neon-text">Scan QR Code</h3>
            <img src="{{ asset('storage/' . $tree->qr_code) }}" alt="QR Code">
        </div>

        <button class="neon-button">Explore More</button>
    </div>

</body>
</html>

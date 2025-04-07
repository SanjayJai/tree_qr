<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Collection - Cyber UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Basic Page Styles */
        body {
            background: linear-gradient(135deg, #0f0f0f, #1b1b1b);
            color: white;
            font-family: 'Orbitron', sans-serif;
            overflow-x: hidden;
            height: 100vh;
            margin: 0;
        }

        /* Keyframe for page fade-in animation */
        @keyframes pageFadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Applying page fade-in animation */
        body {
            animation: pageFadeIn 1s ease-out;
        }

        /* Glass Card Styles */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0px 5px 15px rgba(0, 255, 157, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .glass-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0px 10px 25px rgba(0, 255, 157, 0.5);
        }
        .glass-card .glass-card-img {
            transition: transform 0.4s ease;
        }
        .glass-card:hover .glass-card-img {
            transform: scale(1.1);
        }

        /* Neon Text */
        .neon-text {
            text-shadow: 0 0 5px #00ff9d, 0 0 10px #00ff9d, 0 0 15px #00ff9d;
            animation: neonGlow 1.5s ease-in-out infinite alternate;
        }
        @keyframes neonGlow {
            0% {
                text-shadow: 0 0 10px #00ff9d, 0 0 20px #00ff9d, 0 0 30px #00ff9d;
            }
            100% {
                text-shadow: 0 0 20px #00ff9d, 0 0 40px #00ff9d, 0 0 50px #00ff9d;
            }
        }

        /* Neon Button */
        .neon-button {
            background: linear-gradient(90deg, #00ff9d, #0085ff);
            color: black;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s ease-in-out;
            box-shadow: 0 0 10px rgba(0, 255, 157, 0.8);
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }
        .neon-button:hover {
            box-shadow: 0 0 20px rgba(0, 255, 157, 1), 0 0 30px rgba(0, 255, 157, 1);
            transform: scale(1.05);
            transition: transform 0.2s ease;
        }

        /* Scroll animation for elements */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom Particle Effect */
        .particle-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: rgba(0, 255, 157, 0.8);
            animation: particleAnimation 2s infinite;
        }
        @keyframes particleAnimation {
            0% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-100px) scale(0.5);
            }
            100% {
                transform: translateY(0) scale(1);
            }
        }

    </style>
</head>
<body>

    <!-- Particle Effect Container -->
    <div class="particle-container">
        <!-- Particles will be dynamically added here -->
    </div>

    <header class="text-center py-8 fade-in" id="header">
        <h1 class="text-4xl neon-text">🌲 Futuristic Tree Collection 🌲</h1>
        <p class="text-gray-400 mt-2">Experience trees in a cyber world</p>
    </header>

    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($trees as $tree)
                <div class="glass-card p-5 rounded-xl overflow-hidden fade-in">
                    <img src="{{ asset('storage/' . $tree->tree_image) }}" alt="Tree Image" class="w-full h-64 object-cover rounded-md glass-card-img">
                    <div class="text-center mt-4">
                        <h3 class="text-xl font-semibold neon-text">{{ $tree->common_name }}</h3>
                        <p class="text-gray-300 mt-2">{{ Str::limit($tree->description, 100) }}</p>
                        <a href="{{ route('tree.view', $tree->slug) }}" class="neon-button inline-block mt-4">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Particle effect logic
        function createParticle() {
            let particle = document.createElement('div');
            particle.classList.add('particle');
            document.querySelector('.particle-container').appendChild(particle);

            let x = Math.random() * window.innerWidth;
            let y = Math.random() * window.innerHeight;
            particle.style.left = `${x}px`;
            particle.style.top = `${y}px`;

            setTimeout(() => {
                particle.remove();
            }, 2000); // Remove after animation duration
        }

        setInterval(createParticle, 100);

        // Scroll reveal animations
        const fadeInElements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        });

        fadeInElements.forEach(element => {
            observer.observe(element);
        });
    </script>
</body>
</html>

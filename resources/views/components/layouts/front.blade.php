<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Blogify' }}</title>

    <!-- Include Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #4F46E5 0%, #7E22CE 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .tag-cloud span {
            transition: all 0.3s ease;
        }

        .tag-cloud span:hover {
            transform: translateY(-2px);
            background-color: #4F46E5;
            color: white;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #4F46E5;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .article-title {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .category-icon {
            transition: all 0.3s ease;
        }

        .category-card:hover .category-icon {
            transform: scale(1.1);
            color: #4F46E5;
        }

        /* Mobile menu styles */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Improved hero section */
        .hero-pattern {
            background-image: radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 55%),
            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 0%, transparent 55%);
        }

        /* Improved cards */
        .article-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Improved sidebar */
        .sidebar-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Improved footer */
        .footer-gradient {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        }

        .page-header-gradient {
            background: linear-gradient(135deg, #4F46E5 0%, #7E22CE 100%);
        }

        .active-filter {
            background-color: #4F46E5;
            color: white;
        }

        .article-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .tag-cloud span {
            transition: all 0.3s ease;
        }

        .tag-cloud span:hover {
            transform: translateY(-2px);
            background-color: #4F46E5;
            color: white;
        }

        .sidebar-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-gray-50">

<livewire:front.home.navigation/>

<!-- Main Content -->
{{ $slot }}

<livewire:front.home.footer/>

<!-- Scripts -->
@livewireScripts

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function () {
        // Front-end only interaction handlers
        window.handleLike = function (button) {
            const likeCount = button.querySelector('span');
            const currentCount = parseInt(likeCount.textContent);
            const icon = button.querySelector('i');

            if (button.classList.contains('text-red-500')) {
                button.classList.remove('text-red-500');
                button.classList.add('text-gray-600');
                icon.classList.remove('fas');
                icon.classList.add('far');
                likeCount.textContent = currentCount - 1;
            } else {
                button.classList.remove('text-gray-600');
                button.classList.add('text-red-500');
                icon.classList.remove('far');
                icon.classList.add('fas');
                likeCount.textContent = currentCount + 1;
            }

            // DYNAMIC: Send like data to backend API
            console.log('Like toggled');
        }

        window.handleComment = function () {
            // DYNAMIC: Open comment modal or redirect to article page
            alert('Comment functionality - integrate with your comment system');
        }

        window.handleShare = function () {
            // DYNAMIC: Open share modal with social media options
            if (navigator.share) {
                navigator.share({
                    title: 'Check out this article',
                    url: window.location.href
                }).catch(() => {
                });
            } else {
                alert('Share functionality - integrate with your sharing system');
            }
        }

        window.handleNewsletter = function (event) {
            event.preventDefault();
            const email = event.target.querySelector('input[type="email"]').value;

            // DYNAMIC: Send email to newsletter service API
            console.log('Newsletter subscription:', email);
            alert('Thank you for subscribing! (Demo mode)');
            event.target.reset();
        }

        window.shareArticle = function (title, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                }).catch(() => {
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                });
            }
        }
    });
</script>

@stack('scripts')
</body>
</html>
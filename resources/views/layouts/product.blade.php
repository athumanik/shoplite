<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Products' }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/fav.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{ $head ?? '' }}

    <style>
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .overlay {
            display: none;
        }

        .overlay.active {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen overflow-hidden">

{{-- @include('product.sidebar') --}}
<!-- Main Content -->
<div class="flex-1 ml-0 lg:ml-64 pt-16 lg:pt-0">
    {{ $slot }}
</div>

<script>
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    document.getElementById("mobile-menu-btn").onclick = () => {
        sidebar.classList.add("active");
        overlay.classList.add("active");
        document.body.style.overflow = "hidden";
    };

    document.getElementById("close-sidebar").onclick = closeSidebar;
    overlay.onclick = closeSidebar;

    function closeSidebar() {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        document.body.style.overflow = "";
    }
</script>
{{-- @include('product.js.product-main') --}}

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 flex justify-between">
    @include('components.aside')
    <main class="flex-1 ml-64 min-h-screen flex justify-center">
        <div class="w-full max-w-6xl p-6">{{$slot}}</div>
    </main>
    @include('components.navigate')
</div>
<script>
    const btn = document.getElementById('userBtn');
    const menu = document.getElementById('userDropDown');
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });
    document.addEventListener('click', (e) => {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
</body>
</html>
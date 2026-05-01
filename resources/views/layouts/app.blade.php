<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/03ed6c0fda.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 flex justify-between">
    <section class="fixed top-0 left-0 w-64 h-full bg-gray-800 p-4 space-y-4">
        <div class="flex justify-center">
            <img class="w-full rounded-full" src="{{asset('storage/images/logo_company.png')}}" alt="logo">
        </div>
        <div>
            <ul>
                <li>
                    <a href="#" class="flex justify-start items-center text-lg rounded-2xl p-4 bg-gray-900 text-white hover:bg-gray-300 hover:font-bold hover:text-black">
                        <i class="fa-solid fa-gauge mr-4"></i> Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <main>
        <div>{{$slot}}</div>
    </main>
    <section>
        <div>
            <img src="" alt="">
            <h2></h2>
            <p></p>
        </div>
        <div>
            <ul>
                <li></li>
            </ul>
        </div>
    </section>
</body>
</html>
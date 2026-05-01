@php
    $items=[
        [
            'label' => 'Correo Electrónico',
            'id' => 'email',
            'type' => 'email',
            'placeholder' => 'example@email.com'
        ],
        [
            'label' => 'Contraseña',
            'id' => 'password',
            'type' => 'password',
            'placeholder' => ''
        ]
    ];
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/03ed6c0fda.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Iniciar Sesión
        </h2>
        <div id="errorBox" class="hidden mb-4 p-3 bg-red-100 text-red-600 rounded-lg text-sm text-center"></div>
        <form id="loginForm" class="space-y-5">
            @foreach ($items as $item)
            <div class="mb-4">
                <label for="{{$item['id']}}" class="block text-sm font-medium text-gray-600 mb-1">
                    {{$item['label']}}
                </label>
                @if ($item['id'] === 'password')
                    <div class="relative">
                        <input id="{{$item['id']}}" type="{{$item['type']}}" autocomplete="current-password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10 transition" placeholder="{{$item['placeholder']}}">
                        <button type="button" id="viewPassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 transition">
                            <i id="iconEye" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                @else
                    <input id="{{$item['id']}}" type="{{$item['type']}}" autocomplete="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="{{$item['placeholder']}}">
                @endif
            </div>
            @endforeach
            <button id="loginBtn" type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 active:scale-[0.98] transition font-medium disabled:opacity-50 flex items-center justify-center gap-2">
                <span id="btnText">Ingresar</span>
            </button>
        </form>
    </div>
</div>
</body>
</html>
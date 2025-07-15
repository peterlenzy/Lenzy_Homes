<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3D View in Laravel</title>
    @vite(['resources/js/3d_view.js'])
</head>
<body>
    <div id="3d-container" style="width: 100%; height: 100vh;"></div>
</body>
</html>

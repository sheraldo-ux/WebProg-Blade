@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>About Us - Our Team</title>
</head>
<body class="h-full" style="background-color: #eae8e0">
    <x-header />
    <main>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <x-about-page :team="[
                [
                    'name' => 'User 1',
                    'role' => 'Full Stack Developer',
                    'image' => 'dummy.png',
                    'facebook' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                ],
                [
                    'name' => 'User 2',
                    'role' => 'UX Designer',
                    'image' => 'dummy.png',
                    'facebook' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                ],
                [
                    'name' => 'User 3',
                    'role' => 'Backend Developer',
                    'image' => 'dummy.png',
                    'facebook' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                ],
                [
                    'name' => 'User 4',
                    'role' => 'Frontend Developer',
                    'image' => 'dummy.png',
                    'facebook' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                ],
                [
                    'name' => 'User 5',
                    'role' => 'Project Manager',
                    'image' => 'dummy.png',
                    'facebook' => '#',
                    'twitter' => '#',
                    'instagram' => '#',
                ],
            ]" />
        </div>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Contact | Science Odyssée Pau</title>
    <style>
        body {
            margin: 0;
            font-family: "Montserrat", sans-serif;
            background-color: #808080; /* Changed to grey */
            color: #ffffff;
        }
        .a {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding-top: 100px; /* Adjusted for navbar */
            box-sizing: border-box;
        }
        .container6 {
            position: relative;
            width: 90%;
            max-width: 1000px;
            top: -200px;
        }
        .image2 {
            width: calc(100% - 200px); /* Adjust the width to account for the shift */
            height: 350px; /* Made the height smaller */
            overflow: hidden;
            position: absolute;
            z-index: 1;
            left: 220px; /* Shifted to the right */
            top: -20px; /* Adjust as needed */
        }
        .image2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .details22 {
            background-color: #ffffff;
            color: #000000;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
            top: 150px; /* Adjust as needed */
            left: -180px; /* Shifted more to the left */
            width: calc(100% - 150px); /* Adjust the width to account for the shift */
            height: 280px;
        }
        .details22 h1 {
            font-size: 32px; /* Increased font size */
            margin-bottom: 20px;
        }
        .details22 p {
            font-size: 20px; /* Increased font size */
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    <main class="a">
        <div class="container6">
            <div class="image2">
                <img src="{{ asset('images/WhatsApp Image 2024-06-05 à 17.28.51_2453c80a.jpg') }}" alt="Child in Lab">
            </div>
            <div class="details22">
                <h1>Al-jisr</h1>
                <p>H96P+JP9 Lycée Moulay Abbdellah</p>
                <p>Bd Modibo Keita, Casablanca</p>
                <p>Tel : 06 61 38 95 66 </p>
                <p>Fix :05 22 56 93 03</p>
            </div>
        </div>
    </main>
</body>
</html>

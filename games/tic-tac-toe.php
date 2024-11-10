<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        
        .cell {
            width: 100px; 
            height: 100px; 
            border: 2px solid #4B5563; 
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-300 font-sans flex flex-col items-center justify-center h-screen">
    <h1 class="text-4xl font-bold mb-8 text-blue-400">Tic-Tac-Toe</h1>
    <div id="tic-tac-toe-board" class="grid grid-cols-3 gap-2">
        <!-- Cells will be populated by JavaScript -->
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
        <div class="cell bg-gray-800 text-center text-5xl flex items-center justify-center cursor-pointer hover:bg-gray-700 transition"></div>
    </div>
    <a href="../index.php" class="text-blue-400 hover:underline">Back to Dashboard</a>

    <script src="../assets/js/tic-tac-toe.js"></script>
</body>
</html>

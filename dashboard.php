<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Daftar Belanja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 20px;
            background: #f5f6fa;
            color: #2f3640;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #353b48;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #e84118;
            text-decoration: none;
            font-weight: bold;
        }

        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #dcdde1;
            border-radius: 6px;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button.add {
            background: #44bd32;
            color: white;
        }

        button.reset {
            background: #e1b12c;
            color: white;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #f1f2f6;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li button {
            background: #e84118;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .welcome {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
            color: #2d3436;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Daftar Belanja Interaktif</h1>
        <div class="welcome">Selamat datang, <strong><?= htmlspecialchars($_SESSION['admin']) ?></strong>!</div>
        <div style="text-align: center;">
            <a href="logout.php">Logout</a>
        </div>

        <div class="input-group">
            <input type="text" id="itemInput" placeholder="Tambah item baru...">
            <button class="add" onclick="tambahItem()">Tambah</button>
            <button class="reset" onclick="resetDaftar()">Reset</button>
        </div>

        <ul id="daftarBelanja"></ul>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", loadData);

    function tambahItem() {
        const input = document.getElementById("itemInput");
        const itemText = input.value.trim();
        if (itemText === "") return;

        fetch("tambah.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "item=" + encodeURIComponent(itemText)
        })
        .then(() => {
            input.value = "";
            loadData();
        });
    }

    function loadData() {
        fetch("ambil.php")
            .then(res => res.json())
            .then(data => {
                const daftar = document.getElementById("daftarBelanja");
                daftar.innerHTML = "";
                data.forEach(item => {
                    const li = document.createElement("li");
                    li.textContent = item.nama_item;

                    const hapusBtn = document.createElement("button");
                    hapusBtn.textContent = "Hapus";
                    hapusBtn.onclick = () => {
                        fetch("hapus.php?id=" + item.id)
                            .then(() => loadData());
                    };

                    li.appendChild(hapusBtn);
                    daftar.appendChild(li);
                });
            });
    }

    function resetDaftar() {
        fetch("hapus.php?reset=1")
            .then(() => loadData());
    }
</script>


</body>
</html>

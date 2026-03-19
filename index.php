<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HelpDesk</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* 1. FONDO DE PANTALLA LOGIN (RUTA CORREGIDA) */
        body {
            /* Al estar en index.php, entramos directo a recursos/ */
            background: url('recursos/img/fondoHelpDesk.webp') no-repeat center center fixed !important;
            background-size: cover !important;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            color: white;
            overflow: hidden;
        }

        /* 2. TARJETA DE LOGIN (GLASSMORPHISM) */
        #contenedor-login {
            background: rgba(13, 17, 23, 0.85) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(46, 204, 113, 0.5) !important;
            border-radius: 20px;
            padding: 50px 40px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.8), 0 0 10px rgba(46, 204, 113, 0.2);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 3. TÍTULO */
        h1 {
            color: #2ecc71 !important;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            text-shadow: 0 0 10px rgba(46, 204, 113, 0.5);
        }

        /* 4. ESTILO DE INPUTS */
        .input-form {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            color: #8b949e;
            font-size: 13px;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            background: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid #30363d !important;
            border-radius: 8px;
            color: white !important;
            outline: none;
            transition: 0.3s;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #2ecc71 !important;
            box-shadow: 0 0 8px rgba(46, 204, 113, 0.3);
        }

        /* 5. BOTÓN */
        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #2ecc71, #27ae60) !important;
            color: #000 !important;
            border: none;
            border-radius: 8px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 15px rgba(46, 204, 113, 0.4);
        }

        button:hover {
            box-shadow: 0 0 25px rgba(46, 204, 113, 0.7);
            transform: scale(1.02);
        }

        #linkContacto {
            color: #2ecc71;
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div id="contenedor-login">
        <i class="fa-solid fa-microchip" style="font-size: 40px; color: #2ecc71; margin-bottom: 10px;"></i>
        <h1>Tryhtech H-K</h1>

        <form action="modulos/login/autenticar.php" method="POST">
            <div class="input-form">
                <label for="usuario"><i class="fa-solid fa-user"></i> Usuario:</label>
                <input type="text" id="usuario" name="usuario" required autofocus>
            </div>

            <div class="input-form">
                <label for="password"><i class="fa-solid fa-lock"></i> Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Entrar al Sistema</button>

            <p style="margin-top: 20px;">
                <a href="#" id="linkContacto">¿Problemas de acceso? Contactar al Admin</a>
            </p>

            <div id="modalContacto" style="display:none; background: #0d1117; border: 1px solid #2ecc71; border-radius: 10px; padding: 15px; margin-top: 15px; text-align: left; font-size: 0.9em;">
                <h3 style="color: #2ecc71; margin-top: 0;">Soporte Técnico</h3>
                <p><strong>Admin:</strong> Axel Hernández</p>
                <p><strong>WhatsApp:</strong> 55-1234-5678</p>
                <p><strong>Correo:</strong> soporte@helpdesk.edu.mx</p>
                <button type="button" onclick="document.getElementById('modalContacto').style.display='none'" style="background: #30363d; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Cerrar</button>
            </div>
        </form>

        <p><small>Proyecto - Ing. de Software | Axel Jimenez</small></p>
    </div>

    <script>
        document.getElementById('linkContacto').onclick = function(e) {
            e.preventDefault();
            let modal = document.getElementById('modalContacto');
            modal.style.display = (modal.style.display === 'none') ? 'block' : 'none';
        }
    </script>

</body>

</html>
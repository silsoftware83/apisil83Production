<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Sil83</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7fa;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .content {
            padding: 40px 30px;
        }

        .content p {
            color: #4a5568;
            line-height: 1.6;
            margin: 0 0 20px;
            font-size: 16px;
        }

        .credentials-box {
            background-color: #f7fafc;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 30px 0;
            border-radius: 4px;
        }

        .credentials-box h2 {
            margin: 0 0 15px;
            color: #2d3748;
            font-size: 18px;
            font-weight: 600;
        }

        .credential-item {
            margin: 12px 0;
            padding: 12px;
            background-color: #ffffff;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        .credential-label {
            font-size: 12px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .credential-value {
            font-size: 16px;
            color: #2d3748;
            font-weight: 500;
            word-break: break-all;
            font-family: 'Courier New', monospace;
        }

        .warning-box {
            background-color: #fff5f5;
            border-left: 4px solid #f56565;
            padding: 20px;
            margin: 30px 0;
            border-radius: 4px;
        }

        .warning-box p {
            color: #742a2a;
            margin: 0;
            font-size: 14px;
        }

        .warning-box strong {
            color: #c53030;
        }

        .cta-button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.2s;
        }

        .cta-button:hover {
            transform: translateY(-2px);
        }

        .tips {
            background-color: #edf2f7;
            padding: 20px;
            border-radius: 6px;
            margin: 30px 0;
        }

        .tips h3 {
            margin: 0 0 15px;
            color: #2d3748;
            font-size: 16px;
            font-weight: 600;
        }

        .tips ul {
            margin: 0;
            padding-left: 20px;
            color: #4a5568;
            font-size: 14px;
            line-height: 1.8;
        }

        .footer {
            background-color: #2d3748;
            padding: 30px;
            text-align: center;
            color: #cbd5e0;
            font-size: 14px;
        }

        .footer a {
            color: #a0aec0;
            text-decoration: none;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 10px;
            display: inline-block;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="header-content">
                <div class="logo">🚀</div>
                <h1>¡Bienvenido a Sil83!</h1>
                <p>Estamos emocionados de tenerte con nosotros</p>
            </div>
        </div>

        <div class="content">
            <p>Hola,</p>
            <p>Tu cuenta ha sido creada exitosamente. A continuación encontrarás tus credenciales de acceso:</p>

            <div class="credentials-box">
                <h2>🔐 Tus Credenciales de Acceso</h2>

                <div class="credential-item">
                    <div class="credential-label">Correo Electrónico</div>
                    <div class="credential-value">{{ $email }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">Contraseña Temporal</div>
                    <div class="credential-value">{{ $password }}</div>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>⚠️ IMPORTANTE:</strong> Por razones de seguridad, guarda estas credenciales en un lugar
                    seguro inmediatamente. Nuestro sistema no almacena tu contraseña en texto plano y no podremos
                    recuperarla después. Te recomendamos cambiarla después de tu primer inicio de sesión.</p>
            </div>

            <center>
                <a href="https://www.sil83.com" class="cta-button">Iniciar Sesión Ahora</a>
            </center>

            <div class="tips">
                <h3>📋 Consejos de Seguridad</h3>
                <ul>

                    <li>No compartas tus credenciales con nadie</li>

                    <li>No uses la misma contraseña en múltiples servicios</li>
                </ul>
            </div>

            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactar a nuestro equipo de soporte.</p>

            <p style="margin-top: 30px;">Saludos cordiales,<br><strong>El equipo de sil83</strong>
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} sil83. Todos los derechos reservados.</p>

        </div>
    </div>
</body>

</html>

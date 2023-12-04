<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Login</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="styleslogin.css">
</head>

<body class="bg-gradient-primary no-scroll">

    <section class="user">
        <div class="user_options-container">
            <div class="user_options-text">
                <div class="user_options-unregistered">
                    <h2 class="user_unregistered-title">¿Aún no formas parte de Messing?</h2>
                    <p class="user_unregistered-text">Únete a nosotros y deja que tu restaurante vaya de boca en boca
                    </p>
                    <button class="user_unregistered-signup" id="signup-button">Sign up</button>
                </div>

                <div class="user_options-registered">
                    <h2 class="user_registered-title">Identifícate!</h2>
                    <p class="user_registered-text">Mira todas las reservas que han hecho</p>
                    <button class="user_registered-login" id="login-button">Login</button>
                </div>
            </div>

            <div class="user_options-forms" id="user_options-forms">
                <div class="user_forms-login">
                    <h2 class="forms_title">Login</h2>
                    <form class="forms_form" action="phps/loginphp.php" method="post">
                        <fieldset class="forms_fieldset">
                            <div class="forms_field">
                                <input type="text" name="restaurante" placeholder="Restaurante"
                                    class="forms_field-input" required autofocus />
                            </div>
                            <div class="forms_field">
                                <input type="email" name="username" placeholder="Username" class="forms_field-input"
                                    required />
                            </div>
                            <div class="forms_field">
                                <input type="password" name="password" placeholder="Password" class="forms_field-input"
                                    required />
                            </div>
                        </fieldset>
                        <div class="forms_buttons">
                            <button type="button" class="forms_buttons-forgot">Forgot password?</button>
                            <button type="submit" class="forms_buttons-action">Login</button>
                        </div>

                    </form>

                </div>
                <div class="user_forms-signup">
                    <h2 class="forms_title">Sign Up</h2>
                    <form class="forms_form">
                        <fieldset class="forms_fieldset">
                            <div class="forms_field">
                                <input type="text" placeholder="Restaurante" class="forms_field-input" required />
                            </div>
                            <div class="forms_field">
                                <input type="email" placeholder="Email" class="forms_field-input" required />
                            </div>
                            <div class="forms_field">
                                <input type="password" placeholder="Password" class="forms_field-input" required />
                            </div>
                        </fieldset>
                        <div class="forms_buttons">
                            <input type="submit" value="Sign up" class="forms_buttons-action">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const signupButton = document.getElementById('signup-button'),
            loginButton = document.getElementById('login-button'),
            userForms = document.getElementById('user_options-forms')

        signupButton.addEventListener('click', () => {
            userForms.classList.remove('bounceRight')
            userForms.classList.add('bounceLeft')
        }, false)

        loginButton.addEventListener('click', () => {
            userForms.classList.remove('bounceLeft')
            userForms.classList.add('bounceRight')
        }, false)

        const signupSubmitButton = document.getElementById('signup-submit');

        signupSubmitButton.addEventListener('click', () => {
            window.location.href = 'indexPC.html';
        }, false);
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.js"></script>

</body>

</html>
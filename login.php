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
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styleslogin.css">
</head>

<body class="bg-gradient-primary no-scroll">
<a href="index.html" class="btn btn-primary " style="position: absolute; top: 50px; left: 50px; background-color:#198754; border-color:black; ">
        <i class="fas fa-arrow-left"></i>
    </a>
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
                    <form action="phps/singin.php" method="post" class="forms_form">
                        <fieldset class="forms_fieldset">
                            <div class="forms_field">
                                <input type="text" placeholder="Restaurante" name="nombre_restaurante" class="forms_field-input" required />
                            </div>
                            <div class="forms_field">
                                <input type="email" placeholder="Email" name="correo_restaurante" class="forms_field-input" required />
                            </div>
                            <div class="forms_field">
                                <input type="password" placeholder="Password" name="password" class="forms_field-input" required />
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
 <style>
 * {
   box-sizing: border-box;
 }

 body {
   font-family: "Montserrat", sans-serif;
   font-size: 12px;
   line-height: 1em;
   background-image: url('img/imgStyleLogin/copas.jpg');
   background-size: cover;
   background-color: transparent; 
 }

 button {
   background-color: transparent;
   padding: 0;
   border: 0;
   outline: 0;
   cursor: pointer;
 }

 input {
   background-color: transparent;
   padding: 0;
   border: 0;
   outline: 0;
 }

 input::placeholder {
   font-size: .85rem;
   font-family: "Montserrat", sans-serif;
   font-weight: 300;
   letter-spacing: .1rem;
   color: #ccc;
 }

 a {
   text-decoration: none;
 }

 button,
 input[type="submit"] {
   border: none;
   outline: none;
   cursor: pointer;
 
 }
 .no-scroll
{

     overflow-y:hidden;
}


 /**
   * Bounce to the left side
   */
 @keyframes bounceLeft {
   0% {
     transform: translate3d(100%, -50%, 0);
   }

   50% {
     transform: translate3d(-30px, -50%, 0);
   }

   100% {
     transform: translate3d(0, -50%, 0);
   }
 }

 /**
   * Bounce to the left side
   */
 @keyframes bounceRight {
   0% {
     transform: translate3d(0, -50%, 0);
   }

   50% {
     transform: translate3d(calc(100% + 30px), -50%, 0);
   }

   100% {
     transform: translate3d(100%, -50%, 0);
   }
 }

 /**
   * Show Sign Up form
   */
 @keyframes showSignUp {
   100% {
     opacity: 1;
     visibility: visible;
     transform: translate3d(0, 0, 0);
   }
 }

 /**
   * Page background
   */
 .user {
   display: flex;
   justify-content: center;
   align-items: center;
   width: 100%;
   height: 100vh;

 }

 .user_options-container {
   position: relative;
   width: 80%;
   background-color: transparent;
 }

 .user_options-text {
   display: flex;
   justify-content: space-between;
   width: 100%;
   background-color: rgba(34, 34, 34, 0.85);
   border-radius: 3px;
 }

 /**
   * Registered and Unregistered user box and text
   */
 .user_options-registered,
 .user_options-unregistered {
   width: 50%;
   padding: 75px 45px;
   color: #fff;
   font-weight: 300;
 }

 .user_registered-title,
 .user_unregistered-title {
   margin-bottom: 15px;
   font-size: 1.66rem;
   line-height: 1em;
 }

 .user_unregistered-text,
 .user_registered-text {
   font-size: .83rem;
   line-height: 1.4em;
 }

 .user_registered-login,
 .user_unregistered-signup {
   margin-top: 30px;
   border: 1px solid #ccc;
   border-radius: 3px;
   padding: 10px 30px;
   color: #fff;
   text-transform: uppercase;
   line-height: 1em;
   letter-spacing: .2rem;
   transition: background-color .2s ease-in-out, color .2s ease-in-out;
 }

 .user_registered-login:hover,
 .user_unregistered-signup:hover {
   color: rgba(34, 34, 34, 0.85);
   background-color: #ccc;
 }

 /**
   * Login and signup forms
   */
 .user_options-forms {
   position: absolute;
   top: 50%;
   left: 30px;
   width: calc(50% - 30px);
   min-height: 420px;
   background-color: #fff;
   border-radius: 3px;
   box-shadow: 2px 0 15px rgba(0, 0, 0, 0.25);
   overflow: hidden;
   transform: translate3d(100%, -50%, 0);
   transition: transform .4s ease-in-out;
 }

 .user_options-forms .user_forms-login {
   transition: opacity .4s ease-in-out, visibility .4s ease-in-out;
 }

 .user_options-forms .forms_title {
   margin-bottom: 45px;
   font-size: 1.5rem;
   font-weight: 500;
   line-height: 1em;
   text-transform: uppercase;
   color: #348669;
   letter-spacing: .1rem;
 }
 

 .user_options-forms .forms_field:not(:last-of-type) {
   margin-bottom: 20px;
 }

 .user_options-forms .forms_field-input {
   width: 100%;
   border-bottom: 1px solid #ccc;
   padding: 6px 20px 6px 6px;
   font-family: "Montserrat", sans-serif;
   font-size: 1rem;
   font-weight: 300;
   color: #348669;
   letter-spacing: .1rem;
   transition: border-color .2s ease-in-out;
 }

 .user_options-forms .forms_field-input:focus {
   border-color: gray;
 }

 .user_options-forms .forms_buttons {
   display: flex;
   justify-content: space-between;
   align-items: center;
   margin-top: 35px;
 }

 .user_options-forms .forms_buttons-forgot {
   font-family: "Montserrat", sans-serif;
   letter-spacing: .1rem;
   color: #ccc;
   text-decoration: underline;
   transition: color .2s ease-in-out;
 }

 .user_options-forms .forms_buttons-forgot:hover {
   color: #b3b3b3;
 }

 .user_options-forms .forms_buttons-action {
   background-color: #348669;
   border-radius: 3px;
   padding: 10px 35px;
   font-size: 1rem;
   font-family: "Montserrat", sans-serif;
   font-weight: 300;
   color: #fff;
   text-transform: uppercase;
   letter-spacing: .1rem;
   transition: background-color .2s ease-in-out;
 }

 .user_options-forms .forms_buttons-action:hover {
   background-color:#348669;
   text-decoration: none;
 }

 .user_options-forms .user_forms-signup,
 .user_options-forms .user_forms-login {
   position: absolute;
   top: 70px;
   left: 40px;
   width: calc(100% - 80px);
   opacity: 0;
   visibility: hidden;
   transition: opacity .4s ease-in-out, visibility .4s ease-in-out, transform .5s ease-in-out;
 }

 .user_options-forms .user_forms-signup {
   transform: translate3d(120px, 0, 0);
 }

 .user_options-forms .user_forms-signup .forms_buttons {
   justify-content: flex-end;
 }

 .user_options-forms .user_forms-login {
   transform: translate3d(0, 0, 0);
   opacity: 1;
   visibility: visible;
 }

 /**
   * Triggers
   */
 .user_options-forms.bounceLeft {
   animation: bounceLeft 1s forwards;
 }

 .user_options-forms.bounceLeft .user_forms-signup {
   animation: showSignUp 1s forwards;
 }

 .user_options-forms.bounceLeft .user_forms-login {
   opacity: 0;
   visibility: hidden;
   transform: translate3d(-120px, 0, 0);
 }

 .user_options-forms.bounceRight {
   animation: bounceRight 1s forwards;
 }

 /**
   * Responsive 990px
   */
 @media screen and (max-width: 990px) {
   .user_options-forms {
     min-height: 350px;
   }

   .user_options-forms .forms_buttons {
     flex-direction: column;
   }

   .user_options-forms .user_forms-login .forms_buttons-action {
     margin-top: 30px;
   }

   .user_options-forms .user_forms-signup,
   .user_options-forms .user_forms-login {
     top: 40px;
   }

   .user_options-registered,
   .user_options-unregistered {
     padding: 50px 45px;
   }
 }

    </style>


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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
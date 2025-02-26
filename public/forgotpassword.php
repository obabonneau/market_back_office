<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--FAVICON -->
    <link rel="icon" type="image/png" href="../public/img/favicon.png">
    <title>BACK OFFICE - MDP oublié</title>

    <!-- ADMIN -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/style2.css">
    <!-- ADMIN -->

    <!-- SCRIPTS GENERALE-->
    <script type="module" src="../public/js/user/forgotPassword.js" defer></script>
    <script type="module" src="../public/js/module/modalFormError.js" defer></script>
</head>

<body class="bg-gradient-primary">

    <main class="container d-flex justify-content-center align-items-center">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">


                            <div class="col-lg-6 p-0">
                                <img class="img-fluid" src="../public/img/login.jpg" alt="Photo de connexion">
                            </div>


                            <div class="col-lg-6 p-0">
                                <div class="p-4 d-flex flex-column justify-content-center" style="flex: 1;">
                                    <div class="text-center">
                                        <h1 class="text-gray-900 mb-4">BACK OFFICE</h1>
                                    </div>

                                    <?php if (!isset($_GET["token"])) : ?>
                                        <form id="formForgotEmail" class="user" method="post" novalidate>

                                            <!-- TOKEN -->
                                            <input id="token" type="hidden" name="token" value="">

                                            <!-- EMAIL -->
                                            <div class="form-group">
                                                <label for="email" class="d-flex justify-content-center text-center">Merci de renseigner votre email<br>pour réinitialiser votre mot de passe</label>
                                                <input id="email" class="form-control form-control-user" type="email" name="email" placeholder="Votre adresse email">
                                                <small id="emailError" class="form-text text-danger"></small>
                                            </div>

                                            <!-- BOUTON -->
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-user btn-block" type="submit">Envoyer</button>
                                                <small id="loginError" class="form-text text-danger text-center mt-2"></small>
                                            </div>

                                        </form>

                                        <div id="message" class="alert alert-success d-none mt-5">
                                            <p class="mb-0 text-center">Un email vous a été envoyé<br> avec les instructions à suivre.</p>
                                        </div>

                                        <div class="text-center mt-3">
                                            <a class="small" href="login.php">Vous avez déjà un compte ?</a>
                                        </div>

                                        <?php else :
                                        //$url = "http://app.local/CEFii_Market/market_back_office/public/index.php?controller=User&action=forgotPasswordCtrl&token=" . $_GET["token"];
                                        $url = "https://www.cefii-developpements.fr/olivier1422/cefii_market/market_back_office/public/index.php?controller=User&action=forgotPasswordCtrl&token=" . $_GET["token"];
                                        $result = json_decode(file_get_contents($url));

                                        if ($result->data) : ?>
                                            <form id="formForgotPassword" class="user" method="post" novalidate>

                                                <!-- TOKEN -->
                                                <input id="token" type="hidden" name="token" value="">

                                                <!-- TOKEN -->
                                                <input id="userToken" type="hidden" name="userToken" value="<?php echo htmlspecialchars($_GET["token"], ENT_QUOTES, "UTF-8"); ?>">

                                                <!-- PASSWORD -->
                                                <div class="form-group mb-0">
                                                    <label for="password" class="d-flex justify-content-center text-center">Entrez votre nouveau mot de passe</label>
                                                    <input id="password" class="form-control form-control-user" type="password" name="password" placeholder="Votre mot de passe">
                                                    <small id="passwordError" class="form-text text-danger"></small>
                                                </div>

                                                <!-- PASSWORD CONFIRMATION -->
                                                <div class="form-group">
                                                    <label for="passwordConfirm" class="d-flex justify-content-center text-center" type="hidden"></label>
                                                    <input id="passwordConfirm" class="form-control form-control-user" type="password" name="confirmPassword" placeholder="Confirmez votre mot de passe">
                                                    <small id="passwordConfirmError" class="form-text text-danger"></small>
                                                </div>

                                                <!-- BOUTON -->
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-user btn-block" type="submit">Réinitialiser</button>
                                                    <small id="loginError" class="form-text text-danger text-center mt-2"></small>
                                                </div>
                                            </form>

                                            <div id="message" class="alert alert-success d-none mt-5">
                                                <p class="mb-0 text-center">Votre mot de passe<br> a été modifié avec succès.</p>
                                            </div>

                                        <?php else : ?>


                                            <div id="message" class="alert alert-danger">
                                                <p class="mb-0 text-center"><?php echo $result->message; ?></p>
                                            </div>


                                            <div class="text-center mt-3">
                                                <a class="small" href="forgotpassword.php">Mot de passe oublié ?</a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="module">
        import { tokenCreate } from "../public/js/module/tokenCreate.js";
        document.addEventListener("DOMContentLoaded", () => {
               tokenCreate().then((token) => {
                document.querySelector("#token").value = token;
            });
        });
    </script>
</body>

</html>
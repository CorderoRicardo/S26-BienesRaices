<?php
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    //autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $email = mysqli_real_escape_string($db, filter_var($email,FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $password);

        if(!$email){
            $errores[] = 'El email no es válido';
        }
        if(!$password){
            $errores[] = 'El password es obligatorio';
        }

        //validaciones backend
        if(empty($errores)){
            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";

            $resultado = mysqli_query($db,$query);

            if($resultado->num_rows){
                $usuario = mysqli_fetch_assoc($resultado);

                //verificar que el password es correcto
                $auth = password_verify($password,$usuario['password']);
                if($auth){
                    //autenticar al usuario 
                    session_start();

                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    header('location: admin/index.php');

                }else{
                    $errores[] = "Password incorrecto";
                }
            }else{
                $errores[] = 'El usuario no existe';
            }
        }

    }

    //header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error; ?></p>
        <?php endforeach; ?>
        <form method="POST" class="formulario" novalidate>
            <fieldset>
                <legend>
                    Email y Password
                </legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu constraseña" id="password">                    
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>

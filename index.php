<?php
    session_start();
    include_once('database/conexao.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Açaí Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="classes.css">
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="./photos/icone.ico" type="image/x-icon">
</head>
<body>
    <header>
        <div class="header_1">
            <a href="promotions/promotions.php" class="line-of-options" style="color: white;">Promoções</a>
            <a href="" class="line-of-options" style="color: white;">Lojas</a>
            <a href="" class="line-of-options" style="color: white;">Ajuda</a>
        </div>
        <?php 
            if(isset($_SESSION['email'])){
                echo "<div class='header_2'>
                        <a href='loja/loja.php' title='Seu Perfil' class='fa-solid fa-user'></a>
                        <a href='login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
                    </div>";
            } else {

                echo "<div class='header_2'>
                        <a href='login/login.php' title='Login' class='fa-solid fa-user'></a>
                    </div>";
            }
            
        ?>
    </header>

    <!-- background 1 e button -->

    <main>
        <section id="background_1"></section>
    </main>

    <!-- Box of buy -->

    <section id="help-in-search">
        <h2 class="title">Produtos que talvez você goste!</h2>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-1.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-2.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-3.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-4.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-1.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-2.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-3.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
        <div class="box">
            <div class='img-settings-size'>
                <img class='img-settings' src="photos/promotions/promotion-4.png" alt="">
            </div>
            <div class="title-of-box">
                <a href="" class="line-of-options">Açaí mão na roda!</a>
            </div>
            <div class="button-size">
                <button class="button">Comprar</button>
            </div>
        </div>
    </section>
    <section class="best-stores">
        <h2 class="title">Melhores lojas</h2>
        <div class="box-stores"></div>
        <div class="box-stores"></div>
        <div class="box-stores"></div>
        <div class="box-stores"></div>
        <div class="box-stores"></div>
    </section>
    <section class="novidades">
        <h2 class="title">Novidades para você!</h2>
        <div class="box-nov">
            <p>Frete Grátis</p>
        </div>
        <div class="box-nov">
            <p>Entrega mais rápidas!</p>
        </div>
        <div class="box-nov">
            <p>Muito mais gostoso!</p>
        </div>
    </section>
    <section class="info">
        <h2 class="title">Tópicos</h2>
        <div class="box">
            <h3 style="text-align: center;">Quais os benefícios do açaí?</h3>
            <p style="text-align: center; padding: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sint dolores aliquid provident
                accusantium nihil culpa ullam incidunt sed cumque dolorum, dolore alias ducimus. Incidunt labore ipsam
                ad eum voluptate.</p>
            <div class="button-size">
                <button class="button">Veja mais</button>
            </div>
        </div>
        <div class="box">
            <h3 style="text-align: center;">Buscamos Motoboy</h3>
            <p style="text-align: center; padding: 10px;">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere voluptate, dolores odit, et ex
                reiciendis, quisquam rerum harum mollitia commodi est. Neque obcaecati consequuntur molestiae modi vel
                sequi aliquam voluptatibus.</p>
            <div class="button-size">
                <button class="button">Veja mais</button>
            </div>
        </div>
        <div class="box">
            <h3 style="text-align: center;">Encontre a Loja mais perto de você!</h3>
            <p style="text-align: center; padding: 10px;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum culpa expedita recusandae deserunt enim
                officiis, voluptates dignissimos dolore esse impedit nisi incidunt illo qui ipsa aliquam quaerat fugiat,
                praesentium laudantium.</p>
            <div class="button-size">
                <button class="button">Veja mais</button>
            </div>
        </div>
        <div class="box">
            <h3 style="text-align: center;">Muito mais cupons para você!</h3>
            <p style="text-align: center; padding: 10px;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum culpa expedita recusandae deserunt enim
                officiis, voluptates dignissimos dolore esse impedit nisi incidunt illo qui ipsa aliquam quaerat fugiat,
                praesentium laudantium.</p>
            <div class="button-size">
                <button class="button">Veja mais</button>
            </div>
        </div>
    </section>
    <footer>
        <div id="opcoes">
            <a href="" class="line-of-options" style="color: white;"><b>Quem somos?</b></a>
            <a href="" class="line-of-options" style="color: white;"><b>Suporte</b></a>
            <a href="" class="line-of-options" style="color: white;"><b>WhatsApp</b></a>
            <a href="" class="line-of-options" style="color: white;"><b>Instagram</b></a>
        </div>
    </footer>
</body>

</html>
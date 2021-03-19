<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            <a target="_blank": href="http://www.facebook.com/MAXIMILIANOFRM" title="NINEFRM">Veterinaria</a>
            <p>Fonseca Romero, Samuel Maximiliano.</p>

            <a class="grey-text text-lighten-4 right" href="<?php echo $_SESSION['id'] ?>"><p>SESIÓN: <?php
                    if (!empty($_SESSION['id'])){
                        print_r($_SESSION['nombre']);
                    }
                    else{
                        echo "SIN SESIÓN ACTIVA";
                    }
                    ?></p></a>
<p></p>
        </div>

    </div>
<!--    <div class="col s12 m7 l6">-->
<!--        <div class="card horizontal">-->
<!--            <div class="card-image">-->
<!--                <img src="https://www.afiliadoshostgator.com/media/banners/mx-web-hosting-descuento-300x250.png">-->
<!--            </div>-->
<!--            <div class="card-stacked">-->
<!--                <div class="card-content black">-->
<!--                    <p>Esta página esta alojada en Hostgator, promoción en el link.</p>-->
<!--                </div>-->
<!--                <div class="card-action ">-->
<!--                    <a style="color:#1d31ff" href="https://www.hostgator.la/1992-21-1-1144.html"><b>PROMOCIÓN</b></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</footer>

<?php
/**
 * Created by PhpStorm.
 * User: Wolter van Donk
 * Date: 6-11-2018
 * Time: 11:44
 */
Function DBconnectie() {
    try {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=wideworldimporters', 'root', '');
        return $dbh;
    } catch (PDOException $e) {
        return ("Error!: " . $e->getMessage() . "<br/>");
    }
}

Function displayModal($title, $text, $close)
{
    ?>
    <script>
        $(function () {
            $("#myModal").modal();//if you want you can have a timeout to hide the window after x seconds
        });
    </script>
    <?php print  '
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">' . $title . '</h4>
                    </div>
                    <div class="modal-body">
                        <p>' . $text . '</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">' . $close . '</button>
                    </div>
                </div>';
}
Function displayHeader() {
    $result = '
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wide World Importers</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/main.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <!-- Custom styles for this template -->
    <link href="css/shop-item.css" rel="stylesheet">
    ';

    return $result;
}

Function displayNavBar() {
    if(!isset($_SESSION['countBestelling']))
    {
        $_SESSION['countBestelling'] = 0;
    }
    $result = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Wide World Importers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="winkelwagen.php">Winkelmand (' . $_SESSION['countBestelling'] . ')</a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
    return $result;
}

function JavaScriptCart()
{
    print'<script>
                    var Cart = {

                        $cart: $( "#cart" ),
                        $qtyFields: $( "input.qty" ),
                        $triggerBtn: $( "#calc" ),
                        $subTotalEl : $( "#subtotal" ),

                        calculate: function() {
                            var total = 0;

                            this.$qtyFields.each(function() {

                                var $field = $( this );
                                var amount = $field.parent().next().text();
                                var amountR = amount.replace( /\s+/g, "" ).replace( /EURO/, "" );
                                var n1 = Number( $field.val() );
                                var n2 = Number( amountR );

                                var sum = n1 * n2;


                                total += sum;

                            });

                            var totalStr = total.toFixed( 2 );
                            var tot = totalStr + " EURO";



                            return tot;
                        },
                        trigger: function() {
                            var self = this;

                            this.$triggerBtn.on( "click", function( e ) {

                                e.preventDefault();

                                var subtotal = self.calculate();

                                self.$subTotalEl.text( subtotal );
                            });


                        },
                        init: function() {

                            this.trigger();

                            this.$triggerBtn.trigger( "click" );

                            this.$cart.submit(function( e ) {

                                e.preventDefault();

                            });


                        }

                    };

                    $(function() {

                        Cart.init();
                    });
                </script>';
}
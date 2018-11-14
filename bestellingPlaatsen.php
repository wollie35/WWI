<?php
require_once "includes/Functions.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?= displayHeader(); ?>
        <link href="css/table.css" rel="stylesheet">
    </head>

    <body>

        <!-- Navigation -->
        <?= displayNavBar(); ?>

        <!-- Page Content -->
        <div class="container">

            <div class="row">
                <div class="col-lg-3">
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <link href="css/betalen.css" rel="stylesheet">

                <!--REVIEW ORDER END-->
            </div>
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <h4>Verzendadres</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Land:</strong></div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="country" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-xs-12">
                            <strong>Voornaam:</strong>
                            <input type="text" name="first_name" class="form-control" value="" />
                        </div>
                        <div class="span1"></div>
                        <div class="col-md-6 col-xs-12">
                            <strong>Achternaam:</strong>
                            <input type="text" name="last_name" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Adres:</strong></div>
                        <div class="col-md-12">
                            <input type="text" name="address" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>City:</strong></div>
                        <div class="col-md-12">
                            <input type="text" name="city" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Postcode:</strong></div>
                        <div class="col-md-12">
                            <input type="text" name="state" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Woonplaats:</strong></div>
                        <div class="col-md-12">
                            <input type="text" name="zip_code" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Telefoonnummer:</strong></div>
                        <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="" /></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Email:</strong></div>
                        <div class="col-md-12"><input type="text" name="email_address" class="form-control" value="" /></div>
                    </div>
                </div>
            </div>
            <!--SHIPPING METHOD END-->
            <!--CREDIT CART PAYMENT-->
            <div class="panel panel-info">
                <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Betalen</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12"><strong>Bank:</strong></div>
                        <div class="col-md-12">
                            <select id="CreditCardType" name="CreditCardType" class="form-control">
                                <option value="5">ABN AMRO</option>
                                <option value="6">ING</option>
                                <option value="7">BUNQ</option>
                                <option value="8">KNAB</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>Credit Card Nummer:</strong></div>
                        <div class="col-md-12"><input type="text" class="form-control" name="car_number" value="" /></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><strong>CVV code:</strong></div>
                        <div class="col-md-12"><input type="text" class="form-control" name="car_code" value="" /></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <strong>Vervaldatum</strong>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="">
                                <option value="">Maand</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="">
                                <option value="">Jaar</option>
                                <option value="2015">2018</option>
                                <option value="2016">2019</option>
                                <option value="2017">2020</option>
                                <option value="2018">2021</option>
                                <option value="2019">2022</option>
                                <option value="2020">2023</option>
                                <option value="2021">2024</option>
                                <option value="2022">2025</option>
                                <option value="2023">2026</option>
                                <option value="2024">2027</option>
                                <option value="2025">2028</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <form method="get" action="includes/bestellingAfronden.php">
                            <button type="submit" class="btn btn-primary btn-submit-fix">Bevestig betaling</button>
                    </div>
                </div>
            </div>
            <!--CREDIT CART PAYMENT END-->
        </div>

    </form>
</div>
<div class="row cart-footer">

</div>
</div>
</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Wide World Importers 2018</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

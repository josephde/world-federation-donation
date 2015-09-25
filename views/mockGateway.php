<?php

/**
 * This file acts as a mock payment gateway page.
 */

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>World Federation of KSIMC Payment System</title>
    <link href="<?=$baseUrl?>assets/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="donation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default panel-donation">
                    <div class="panel-body" id="main-panel">
                        <p class="loading text-center">
                            <img src="<?=$baseUrl?>assets/img/loader.gif" />
                        </p>
                        <h1 class="panel-heading text-center">Payment Details</h1>
                        <div class="col-lg-6">
                            <h2 class="panel-subheading-billing">Contact Details</h2>
                            <label for="contact-email">Email</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your email address" class="form-control" id="contact-email">
                                </div>
                            </div>
                            <label for="contact-phone">Phone</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your phone number" class="form-control" id="contact-phone">
                                </div>
                            </div>
                            <h2 class="panel-subheading-billing">Billing Address</h2>
                            <label for="address-1">Address Line 1</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter first line of your address" class="form-control" id="address-1">
                                </div>
                            </div>
                            <label for="address-2">Address Line 2</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter second line of your address" class="form-control" id="address-2">
                                </div>
                            </div>
                            <label for="address-city">City/Town</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your city or town name" class="form-control" id="address-city">
                                </div>
                            </div>
                            <label for="address-county">County</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your county" class="form-control" id="address-county">
                                </div>
                            </div>
                            <label for="address-country">Country</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <select class="form-control" id="address-country">
                                        <option vlaue="">
                                            United Kingdom
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <label for="address-postcode">Postcode</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your postcode" class="form-control" id="address-postcode">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="panel-subheading-billing">Card Details</h2>
                            <label for="card-name">Name on card</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your name as it appears on your card" class="form-control" id="card-name">
                                </div>
                            </div>
                            <label for="card-type">Country</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <select class="form-control" id="card-type">
                                        <option vlaue="">
                                            Master Card
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <label for="card-number">Card number</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your card number" class="form-control" id="card-number">
                                </div>
                            </div>
                            <label for="card-expire-month">Expiry Date</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="card-expire-month">
                                            <option vlaue="">
                                                01 - January
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="card-expire-year">
                                            <option vlaue="">
                                                2016
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label for="card-start-month">Start Date</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" id="card-start-month">
                                            <option vlaue="">
                                                01 - January
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="card-start-year">
                                            <option vlaue="">
                                                2016
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label for="card-cvv">CVV (Security Code)</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your card's CVV code" class="form-control" id="card-cvv">
                                </div>
                            </div>
                            <label for="card-issue-number">Issue number</label>
                            <div class="form-group">
                                <div class="input-container">
                                    <input type="text" placeholder="Enter your card's issue number" class="form-control" id="card-issue-number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <form method="POST" action="<?=$baseUrl?>">
                                <input type="hidden" name="route" value="thanks">
                                <input type="submit" value="Submit Payment" class="btn btn-primary btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

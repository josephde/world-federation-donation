<?php

/**
 * Use this file to render the thank you page and any associated details.
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
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                <div class="panel panel-default panel-donation">
                    <div class="panel-body" id="main-panel">
                        <p class="loading text-center">
                            <img src="<?=$baseUrl?>assets/img/loader.gif" />
                        </p>
                        <h1 class="text-center">Thanks</h1>
                        <p class="text-center">
                            Your payment has been received.
                        </p>
                        <p class="text-center">
                            <a href="<?=$baseUrl?>">
                                Continue
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

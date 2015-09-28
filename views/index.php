<?php

/**
 * Use this file to render the main donation page
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
                <div class="pull-right">
                    <div class="island--micro">
                        <label for="currency">Currency</label>
                        <select data-bind="options: currencies, optionsText: 'name', value: selectedCurrency"></select>
                    </div>
                </div>

                <div class="clear"></div>

                <div class="panel panel-default panel-donation">
                    <div class="panel-body loading" id="main-panel">
                        <p class="loading text-center">
                            <img src="<?=$baseUrl?>assets/img/loader.gif" />
                        </p>
                        <h1 class="panel-heading text-center">Make a donation or payment</h1>
                        <form action="#" data-bind="submit: addToGeneralFund">
                            <label for="general-donation">Donate to the general fund</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="input-icon-container">
                                            <span class="input-icon" data-bind="text: self.selectedCurrency().symbol"></span>
                                            <input step="any" min="0" type="number" placeholder="Enter an amount" class="form-control" id="general-fund-value">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="submit" class="btn btn-primary btn-block" value="Donate">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="choice-divider">
                            <span class="choice-divider__text">Or</span>
                        </div>

                        <label for="search-campaigns">Search for a campaign or cause</label>
                        <form action="#">
                            <div class="form-group search-input input-icon-container">
                                <span class="input-icon glyphicon glyphicon-search" aria-hidden="true"></span>
                                <input type="search" id="search-campaigns" class="form-control search-campaigns" data-bind="textInput: campaignSearch, valueUpdate: 'afterkeydown'" required="required" autocomplete="off" placeholder="Search for a campaign or cause">
                                <!-- ko if: (campaignSearch().length && showSearchResults) -->
                                    <ul class="search-dropdown list-unstyled"
                                         data-bind="foreach: filteredCampaigns">
                                        <li>
                                            <a class="search-result" data-bind="text: name, click: $parent.selectCampaign"></a>
                                        </li>
                                    </ul>
                                <!-- /ko -->
                            </div>
                        </form>

                        <!-- ko foreach: selectedCampaigns -->
                            <div class="island island--bordered">
                                <button data-bind="click: $parent.deselectCampaign" type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="panel-subheading" data-bind="text: name"></h3>
                                <p class="text--muted" data-bind="text: description">Allows us to apportion funds as necessary to deal with international crises and emergencies.</p>
                                <form action="#" data-bind="submit: $parent.submitCampaignPayment">
                                    <label for="campaign1">Payment</label>
                                    <div class="form-group input-icon-container">
                                        <div class="input-icon-container">
                                            <span class="input-icon" data-bind="text: self.selectedCurrency().symbol"></span>
                                            <input data-bind="textInput: donation, valueUpdate: 'afterkeydown'" type="number" step="any" min="0" required="required" placeholder="Enter an amount" class="form-control">
                                        </div>
                                    </div>
                                    <!-- ko foreach: attributes -->
                                        <label for="campaign1" data-bind="html: title"></label>
                                        <div class="form-group">
                                            <!-- ko if: type === 'textfield' -->
                                                <input data-bind="textInput: value, valueUpdate: 'afterkeydown'" type="text" required="required" class="form-control">
                                            <!-- /ko -->
                                            <!-- ko if: type === 'select' -->
                                                <select data-bind="options: options,
                                                                   optionsText: 'title',
                                                                   optionsValue: 'id',
                                                                   value: $parent.value,
                                                                   optionsCaption: 'Choose...'" class="form-control"></select>
                                            <!-- /ko -->
                                            <!-- ko if: type === 'checkbox' -->
                                                <!-- ko foreach: options -->
                                                    <div class="input-checkbox-container">
                                                        <div class="checkbox-group">
                                                            <input data-bind="checked: selected" type="checkbox" />
                                                            <span data-bind="html: title"></span>
                                                        </div>
                                                    </div>
                                                <!-- /ko -->
                                            <!-- /ko -->
                                        </div>
                                    <!-- /ko -->
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-default btn-block" value="Add to your payments">
                                    </div>
                                </form>
                            </div>
                        <!-- /ko -->

                        <div>
                            <a class="link--underlined" data-bind="click: toggleCampaignList" href="#">
                                <span data-bind="visible: !showAllCampaigns()">Show</span> <span data-bind="visible: showAllCampaigns">Hide</span> all campaigns and causes
                            </a>
                        </div>


                        <div class="island island--bordered" data-bind="visible: showAllCampaigns">
                            <!-- ko foreach: campaigns -->
                                <h3 class="panel-subheading" data-bind="text: name"></h3>
                                <p class="text--muted" data-bind="text: description"></p>
                                <form action="#" data-bind="submit: $parent.submitCampaignPayment">
                                    <label>Payment</label>
                                    <div class="form-group input-icon-container">
                                        <div class="input-icon-container">
                                            <span class="input-icon" data-bind="text: self.selectedCurrency().symbol"></span>
                                            <input data-bind="textInput: donation" type="number" step="any" min="0" placeholder="Enter an amount" class="form-control">
                                        </div>
                                    </div>
                                    <!-- ko foreach: attributes -->
                                        <label for="campaign1" data-bind="html: title"></label>
                                        <div class="form-group">
                                            <!-- ko if: type === 'textfield' -->
                                                <input data-bind="textInput: value, valueUpdate: 'afterkeydown'" type="text" required="required" class="form-control">
                                            <!-- /ko -->
                                            <!-- ko if: type === 'select' -->
                                                <select data-bind="options: options,
                                                                   optionsText: 'title',
                                                                   optionsValue: 'id',
                                                                   value: $parent.value,
                                                                   optionsCaption: 'Choose...'" class="form-control"></select>
                                            <!-- /ko -->
                                            <!-- ko if: type === 'checkbox' -->
                                                <!-- ko foreach: options -->
                                                    <div class="input-checkbox-container">
                                                        <div class="checkbox-group">
                                                            <input data-bind="checked: selected" type="checkbox" />
                                                            <span data-bind="html: title"></span>
                                                        </div>
                                                    </div>
                                                <!-- /ko -->
                                            <!-- /ko -->
                                        </div>
                                    <!-- /ko -->
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-default btn-block" value="Add to your payments">
                                    </div>
                                </form>
                                <hr>
                            <!-- /ko -->
                        </div>

                        <hr>

                        <!-- ko if: donatedCampaigns().length || general().donation() -->
                            <h2 class="heading--bold">Your donations or payments</h2>
                        <!-- /ko -->

                        <!-- ko if: general().donation() -->
                            <div class="island island--bordered island--standout">
                                <button data-bind="click: removeGeneralDonation" type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="panel-subheading" data-bind="text: general().name"></h3>
                                <p class="text--muted" data-bind="text: general().description"></p>
                                <form data-bind="submit: calculateTotal">
                                    <label for="campaign2">Payment</label>
                                    <div class="form-group input-icon-container">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="input-icon-container">
                                                    <span class="input-icon" data-bind="text: self.selectedCurrency().symbol"></span>
                                                    <input data-bind="textInput: general().donation" type="number" step="any" min="0" placeholder="Enter an amount" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="submit" class="btn btn-default btn-block" value="Update">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- /ko -->


                        <!-- ko foreach: donatedCampaigns -->
                            <div class="island island--bordered island--standout">
                                <button data-bind="click: $parent.removeDonation" type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="panel-subheading" data-bind="text: name"></h3>
                                <p class="text--muted" data-bind="text: description"></p>
                                <form data-bind="submit: $parent.calculateTotal">
                                    <label for="campaign2">Payment</label>
                                    <div class="form-group input-icon-container">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="input-icon-container">
                                                    <span class="input-icon" data-bind="text: self.selectedCurrency().symbol"></span>
                                                    <input data-bind="textInput: donation" type="number" step="any" min="0" placeholder="Enter an amount" required="required" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="submit" class="btn btn-default btn-block" value="Update">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ko foreach: attributes -->
                                        <label for="campaign1" data-bind="html: title"></label>
                                        <div class="form-group">
                                            <!-- ko if: type === 'textfield' -->
                                                <input data-bind="textInput: value, valueUpdate: 'afterkeydown'" type="text" required="required" class="form-control">
                                            <!-- /ko -->
                                            <!-- ko if: type === 'select' -->
                                                <select data-bind="options: options,
                                                                   optionsText: 'title',
                                                                   optionsValue: 'id',
                                                                   value: $parent.value,
                                                                   optionsCaption: 'Choose...'" class="form-control"></select>
                                            <!-- /ko -->
                                            <!-- ko if: type === 'checkbox' -->
                                                <!-- ko foreach: options -->
                                                    <div class="input-checkbox-container">
                                                        <div class="checkbox-group">
                                                            <input data-bind="checked: selected" type="checkbox" />
                                                            <span data-bind="html: title"></span>
                                                        </div>
                                                    </div>
                                                <!-- /ko -->
                                            <!-- /ko -->
                                        </div>
                                    <!-- /ko -->
                                </form>
                            </div>
                        <!-- /ko -->

                        <!-- ko if: donatedCampaigns().length || general().donation() -->
                            <div class="pull-right">
                                <div class="text--highlight">
                                    Total: <span data-bind="text: self.selectedCurrency().symbol"></span>
                                    <span data-bind="text: totalDonation()"></span>
                                </div>
                            </div>
                            <form data-bind="submit: makePayment">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Make Payment">
                            </form>
                        <!-- /ko -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="<?=$baseUrl?>" method="POST" id="main-form">
        <input type="text" name="route" value="gotoGateway" />
        <input type="text" name="cart_id" value="<?=session_id()?>" >
        <input type="text" name="currency" value="" />
        <input type="text" name="total" value="" />
        <input type="text" name="totalGeneral" value="" />
        <input type="text" name="totalCampaigns" value="" />
        <div id="totals-campaign-details">

        </div>
    </form>
    <script src="<?=$baseUrl?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?=$baseUrl?>assets/bower_components/knockout/dist/knockout.js"></script>
    <script type="text/javascript">

        window.donation = {
            'currencies': <?=json_encode($currencies)?>,
            'campaignsAll': <?=json_encode($campaignsAll)?>,
            'campaignsGeneral': <?=json_encode($campaignsGeneral)?>,
        };

    </script>
    <script src="assets/js/app.js"></script>
</body>
</html>

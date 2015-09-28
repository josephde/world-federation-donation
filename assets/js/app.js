// ***** UTILITIES AND EXTENDERS  ***** //

ko.utils.stringStartsWith = function(string, startsWith) {
    string = string || "";
    if (startsWith.length > string.length) return false;
    return string.substring(0, startsWith.length) === startsWith;
};

ko.extenders.numeric = function(target, precision) {
    var result = ko.dependentObservable({
        read: function() {
            return target().toFixed(precision);
        },
        write: target
    });

    result.raw = target;
    return result;
};

// Create campaign model
var donationViewModel = function(currencies, general, campaigns) {
    var self = this;
    var i;

    // ***** INSTANTIATE ARRAYS AND VARS  ***** //

    //  Set up observables
    general.donation = ko.observable(0);

    for (i = 0; i < campaigns.length; i++) {

        campaigns[i].donation = ko.observable(0);
    }

    // Currency picker
    self.currencies = ko.observableArray(currencies);

    // Set the default currency
    for (i = 0; i < currencies.length; i++) {

        if (currencies[i].selected) {
            selectedCurrency = ko.observable(self.currencies()[i]);
        }
    }

    // Grand total
    self.totalDonation = ko.observable(0).extend({ numeric: 2});

    // General campaign
    self.general = ko.observable(general);

    // All campaigns
    self.campaigns = ko.observableArray(campaigns);

    // Campaigns that have been selected
    self.selectedCampaigns = ko.observableArray();

     // Campaigns that have been donated to
    self.donatedCampaigns = ko.observableArray();

    self.campaignSearch = ko.observable('');
    self.showSearchResults = ko.observable(true);
    self.showAllCampaigns = ko.observable(false);

    // ***** SEARCH CAMPAIGNS  ***** //

    self.filteredCampaigns = ko.computed(function() {
        self.showSearchResults(true);
        return ko.utils.arrayFilter(campaigns, function(r) {
            return (self.campaignSearch().length === 0 || ko.utils.stringStartsWith(r.name.toLowerCase(), self.campaignSearch().toLowerCase()));
        });
    });

    // ***** ADDING DONATIONS  ***** //

    // After searching, choose a campaign
    self.selectCampaign = function(){
        self.campaignSearch('');
        self.showSearchResults(false);
        // Push campaign to top of selectedCampaigns array
        self.selectedCampaigns.unshift(this);
        self.campaigns.remove(this);
    };

    // Click the 'x' to deselect a campaign
    self.deselectCampaign = function() {
        self.campaigns.push(this);
        self.selectedCampaigns.remove(this);
        self.calculateTotal();
    };

    // After filling in payment field, click 'add to your payments'
    self.submitCampaignPayment = function(){
        self.campaigns.remove(this);
        self.selectedCampaigns.remove(this);
        self.donatedCampaigns.unshift(this);
        self.calculateTotal();
    };

    self.addToGeneralFund = function() {
        var generalFundVal = $('#general-fund-value').val();
        self.general().donation(+ generalFundVal);
        $('#general-fund-value').val('');
        self.calculateTotal();
    };

    // Toggle visibility of all campaigns
    self.toggleCampaignList =  function() {
        self.showAllCampaigns(!self.showAllCampaigns());
    };

    // ***** REMOVING DONATIONS  ***** //

    // Click the 'x' to remove a campaign payment - goes back to selected state
    self.removeDonation = function() {
        self.campaigns.unshift(this);
        self.donatedCampaigns.remove(this);
        self.calculateTotal();
    };

    self.removeGeneralDonation = function() {
        self.general().donation('');
        self.calculateTotal();
    };


    // ***** CALCULATE TOTAL  ***** //

    self.calculateTotal = function() {

        var campaignDetails = $('#totals-campaign-details');

        campaignDetails.empty();

        var obj = self.donatedCampaigns();
        var total = 0;
        for (var i = 0; i < obj.length; i++) {

            total += +obj[i].donation();

            campaignDetails
            .append(
                    $('<input>')
                    .attr('name', 'campaignDetail[' + i + '][id]')
                    .val(obj[i].id)
            )
            .append(
                    $('<input>')
                    .attr('name', 'campaignDetail[' + i + '][total]')
                    .val(+obj[i].donation())
            );
        }
        self.totalDonation(total + self.general().donation());

        //  Update the form
        var mainForm = $('#main-form');
        mainForm.find('input[name=currency]').val(selectedCurrency().name);
        mainForm.find('input[name=total]').val(+self.general().donation() + total);
        mainForm.find('input[name=totalGeneral]').val(+self.general().donation());
        mainForm.find('input[name=totalCampaigns]').val(total);
    };

    // ***** MAKE PAYMENT  ***** //

    self.makePayment = function() {

        $('#main-form').submit();
    };

    // ***** READY  ***** //
    $('#main-panel').removeClass('loading');
};

ko.applyBindings(
    new donationViewModel(
        window.donation.currencies,
        window.donation.campaignsGeneral,
        window.donation.campaignsAll
    )
);

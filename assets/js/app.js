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

var Campaign = function(name, description, department, donation) {
    self.name = name;
    self.description = description;
    self.department = department;
    self.donation = donation;
};

var donationViewModel = function(general, campaigns) {
    var self = this;

    // ***** INSTANTIATE ARRAYS AND VARS  ***** //

    // Currency picker
    self.currencies = ko.observableArray([
        { name: 'GBP', symbol: '£' },
        { name: 'EUR', symbol: '€' },
        { name: 'USD', symbol: '$' }
    ]);

    selectedCurrency = ko.observable();

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
            return (self.campaignSearch().length == 0 || ko.utils.stringStartsWith(r.name.toLowerCase(), self.campaignSearch().toLowerCase()))
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
    }

    // After filling in payment field, click 'add to your payments'
    self.submitCampaignPayment = function(){
        self.campaigns.remove(this);
        self.selectedCampaigns.remove(this);
        self.donatedCampaigns.unshift({
            name: this.name,
            description: this.description,
            donation: this.donation()
        });
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
    }

    self.removeGeneralDonation = function() {
        self.general().donation('');
        self.calculateTotal();
    }


    // ***** CALCULATE TOTAL  ***** //

    self.calculateTotal = function() {
        var obj = self.donatedCampaigns();
        var total = 0;
        for (var i = 0; i < obj.length; i++) {
            total += +obj[i].donation;
        }
        total += +self.general().donation();
        self.totalDonation(total);
    };

    // ***** MAKE PAYMENT  ***** //

    self.makePayment = function() {
        console.log(
            'General fund donation: ' + self.general().donation() + '\n' +
            'Campaigns donated to: ' + self.donatedCampaigns() + '\n' +
            'Donation total: ' + self.totalDonation()
        );

    }

};

var generalCampaignData = {
    name: "General",
    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    department: "Donation",
    donation: ko.observable(0)
};

var campaignsData = [
    {
        name: "Abacus",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable('')
    },
    {
        name: "Biscuit",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable('')
    },
    {
        name: "Crumpet",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable('')
    },
    {
        name: "Yemen Appeal", 
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
        department: "Health",
        donation: ko.observable('')
    },
    {
        name: "Third one", 
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
        department: "Health",
        donation: ko.observable('')
    },
    {
        name: "Water fund", 
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
        department: "Health",
        donation: ko.observable('')
    },
    {
        name: "Tableegh",
        description: "https://www.world-federation.org/content/tableegh",
        department: "Donation",
        donation: ko.observable('')
    },
    {
        name: "Darjeeling",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable('')
    }
];

ko.applyBindings(new donationViewModel(generalCampaignData,campaignsData));

ko.utils.stringStartsWith = function(string, startsWith) {
    string = string || "";
    if (startsWith.length > string.length) return false;
    return string.substring(0, startsWith.length) === startsWith;
};

var Campaign = function(name, description, department, donation) {
    self.name = name;
    self.description = description;
    self.department = department;
    self.donation = donation;
};

var twoDecimalPlaces = function(value) {
    return value.toFixed(2);
}

var donationViewModel = function(campaigns) {
    var self = this;

    // All campaigns
    self.campaigns = ko.observableArray(campaigns);

    // Campaigns that have been selected
    self.selectedCampaigns = ko.observableArray();

     // Campaigns that have been donated to
    self.donatedCampaigns = ko.observableArray();

    self.campaignSearch = ko.observable('');
    self.showSearchResults = ko.observable(true);
    self.showAllCampaigns = ko.observable(false);
    self.generalDonation = ko.observable();

    // Total
    self.total = ko.computed(function(){
        var total = 0;
        total += parseInt(self.generalDonation());
        console.log(self.donatedCampaigns()[0]); // .donation errors
        return total;
    });

    // Search for campaign / cause
    self.filteredCampaigns = ko.computed(function() {
        self.showSearchResults(true);
        return ko.utils.arrayFilter(campaigns, function(r) {
            return (self.campaignSearch().length == 0 || ko.utils.stringStartsWith(r.name.toLowerCase(), self.campaignSearch().toLowerCase()))
        });
    });

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
    }

    // After filling in payment field, click 'add to your payments'
    self.submitCampaignPayment = function(){
        self.selectedCampaigns.remove(this);
        self.donatedCampaigns.unshift({
            name: this.name,
            description: this.description,
            donation: this.donation()
        });
        console.log(self.donatedCampaigns()[0].donation);
    };

    // Toggle visibility of all campaigns
    self.toggleCampaignList =  function() {
        self.showAllCampaigns(!self.showAllCampaigns()); 
    };

    // Click the 'x' to remove a campaign payment - goes back to selected state
    self.removePayment = function() {
        self.selectedCampaigns.push(this);
        self.donatedCampaigns.remove(this);
    }

};


var campaignsData = [
    {
        name: "Abacus",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable(0)
    },
    {
        name: "Biscuit",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable(0)
    },
    {
        name: "Crumpet",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable(0)
    },
    {
        name: "Yemen Appeal", 
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
        department: "Health",
        donation: ko.observable(0)
    },
    {
        name: "Third one", 
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
        department: "Health",
        donation: ko.observable(0)
    },
    {
        name: "Water fund", 
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
        department: "Health",
        donation: ko.observable(0)
    },
    {
        name: "Tableegh",
        description: "https://www.world-federation.org/content/tableegh",
        department: "Donation",
        donation: ko.observable(0)
    },
    {
        name: "Darjeeling",
        description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        department: "Donation",
        donation: ko.observable(0)
    }
];

ko.applyBindings(new donationViewModel(campaignsData));

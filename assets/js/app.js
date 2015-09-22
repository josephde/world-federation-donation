ko.applyBindings(donationViewModel);

function donationViewModel() {
    var self = this;

    // Non-editable catalog data - would come from the server
    self.campaignsData = [
        { 
            name: "Water fund", 
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
            department: "Health"
        },
        { 
            name: "Yemen Appeal", 
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
            department: "Health"
        },
        { 
            name: "Third one", 
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.",
            department: "Health"
        },
        {
            name: "Tableegh",
            description: "https://www.world-federation.org/content/tableegh",
            department: "Donation"
        }
    ];

    // Toggle visibility of all campaigns
    self.showAllCampaigns = ko.observable(false);

    self.toggleCampaignList =  function() {
        self.showAllCampaigns(!self.showAllCampaigns()); 
    };

    self.searchQuery = ko.observable('test');

}
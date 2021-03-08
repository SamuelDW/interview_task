$(document).ready( () => {
    let ecSearchBox = $('#europeanCommunitySearchField'),
        casSearchBox = $('#CASSearchField'),
        substanceNameSearchBox = $('#substanceNameSearchField');

    //Searching on field
    ecSearchBox.on('keyup', () => {
        let searchValue = ecSearchBox.text();
        getSubstances(searchValue)
    });

    casSearchBox.on('keyup', () => {
        let searchValue = casSearchBox.text();
        getSubstances(searchValue)
    });

    substanceNameSearchBox.on('keyup', () => {
        let searchValue = substanceNameSearchBox.text();
        getSubstances(searchValue);
    });

    //Calling function to reduce complexity
    function getSubstances(identifier) {
        //Searches by number, otherwise calls name function
        if(identifier.isInteger(identifier)) {
            $.ajax({
                url: 'substance_number_ajax_search',uniqueIdentifier: casSearchBox ,
                dataType: 'json',
                success: {},
                error: alert(),
            });
        }

        $.ajax({
            url: 'substance_name_ajax_search',
            dataType: 'json',
            success: () => {
            },
            error: () => {
            },
        })
    }
});
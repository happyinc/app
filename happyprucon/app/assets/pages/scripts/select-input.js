var ComponentsTypeahead = function () {

    var handleTwitterTypeahead = function() {

        // Example #1
        // instantiate the bloodhound suggestion engine
        var numbers = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: [
            { num: 'metronic' },
            { num: 'keenthemes' },
            { num: 'metronic theme' },
            { num: 'metronic template' },
            { num: 'keenthemes team' }
          ]
        });
         
        // initialize the bloodhound suggestion engine
        numbers.initialize();
         
        // instantiate the typeahead UI
        if (App.isRTL()) {
          $('#comp').attr("dir", "rtl");  
        }
        $('#comp').typeahead(null, {
          displayKey: 'num',
          hint: (App.isRTL() ? false : true),
          source: numbers.ttAdapter()
        });
        
    }

}();

jQuery(document).ready(function() {    
   ComponentsTypeahead.init(); 
});
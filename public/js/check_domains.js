/*
 * Check availability of domain, 
 * if domain is unavailable, shows a list os optional domains
 * @param {string} domain: the domain we are searching
 * @returns modifies the html to show if domains is available, and shows the price
 * 
 */
function check_domain(domain) {
      
      
      if(!domain){
            domain = $("#domain").val();            
      }
      
      hide_options();
      
      
      url = base_url + "/checkdomain/" + domain;
      $.post(url, function (data) {
            if(data['status'] == true){
                  $("#domain").val(data['domain']);
                  
                  $("#domain-combo").addClass("has-success");
                  $("#domain-combo").removeClass("has-error");
                  
                  $("#domain-cost-addon").removeClass("hidden");                  
                  $("#domain-cost").html(data['cost']);
                  $("#submit-domain").prop("disabled",false);
                  
            }else{
                  $("#domain").val(data['domain']);
                  
                  $("#domain-combo").addClass("has-error");
                  $("#domain-combo").removeClass("has_success");
                  
                  $("#domain-cost-addon").addClass("hidden");
                  $("#domain-options").append(data['options']);
                  $("#domain-message").html(data['message']);
                  $("#submit-domain").prop("disabled",true);
                  show_options();
            }
      });

}

/*
 * Selects an optional domain and add its value to the domain input
 * @param {string} domain: the optional domain
 * @returns {callback to checkdomain}: 
 */
function select_domain_option(domain){
      $("#domain").val(domain);
      check_domain();
}

/*
 * Show the options in the html page
 */
function show_options() {
      $("#domain-options").removeClass("hidden");
      $("#domain-message").removeClass("hidden");
}

/*
 * Hides the options in the html page
 */
function hide_options() {
      $("#domain-options").addClass("hidden");
      $("#domain-message").addClass("hidden");
}
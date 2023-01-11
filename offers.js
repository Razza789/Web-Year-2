window.addEventListener('load', function () {
    "use strict";
 
    const fetchData = function(){
    const URL = 'getOffers.php';
 
    fetch(URL)
    .then(
      
      // Step 1. function needed here to process the response into JSON data     
      function (response) {
        return response.json();
    }
    )
    .then( 
      
      // Step 2. function needed here to do something with the JSON data
      function (json) {
        document.getElementById("recordTitle").innerHTML = "<p>Record Title: "+json.recordTitle+"</p";
        document.getElementById("catDesc").innerHTML = "<p>Category of music: "+json.catDesc+"</p>";
        document.getElementById("recordPrice").innerHTML = "<p>Record Price: £"+json.recordPrice+"</p>";
      }
    )
    .catch(
 
      // Step 3. function needed here to do something if there is an error
      function (err) {
        console.log("Something went wrong!", err);
    }
 
    ); 
    // end of fetch request
}

 
setInterval(fetchData, 5000);
fetchData();

});


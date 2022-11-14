window.onload = function() {

    const  input = document.getElementById('country');
    const  lookUp = document.getElementById('lookup');
    const  city = document.getElementById('city');
    const  result = document.getElementById('result');
    const  httpRequest= new XMLHttpRequest();
    
    lookUp.addEventListener('click', function(event) {
        event.preventDefault();
        const Text = input.value;
        let country = Text.trim();
        const  url = `world.php?country=${country}&context=`;
        httpRequest.onreadystatechange = fetchdata;
	    httpRequest.open('GET', url);
	    httpRequest.send();
        input.value='';

      });
    
    city.addEventListener('click', function(event) {
        event.preventDefault();
        const searchText = input.value;
        let save = searchText.trim();
        const  url = `world.php?country=${save}&context=city`;
        httpRequest.onreadystatechange = fetchdata;
	    httpRequest.open('GET', url);
	    httpRequest.send();
        input.value='';
      });

    function fetchdata(){
        if (httpRequest.readyState === XMLHttpRequest.DONE){
            if (httpRequest.status === 200){
                var response = httpRequest.responseText;
                result.innerHTML= response;
            }
            else{
                result.innerHTML = "Error: This resquest can not be delivered. Please try again.";
            }
        }
    }


}

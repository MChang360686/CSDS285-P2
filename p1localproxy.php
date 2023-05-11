<!DOCTYPE html>
<html>
<head>
<h1>News API proxy</h1>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<div>
<div style="display: inline-block; border: 1px solid black; vertical-align: top; padding: 10px 10px;">
<p>Enter Search Filters</p>
<input type="text" id="what" placeholder="(1) What you Want"><br>
<input type="text" id="where" placeholder="(2) From Where"><br>
<input type="text" id="r" placeholder="(3) Regarding"><br>
<input type="text" id="when" placeholder="(4) From When"><br>
<input type="text" id="sortedby" placeholder="(5) Sort By"><br>

<input type="password" placeholder="(6) Enter API key here" id="key"><br>
<i class="fa-solid fa-eye" id="eye"><input type="checkbox" onclick="toggleVisibility()"></i><br>
<input id="callapi" type="submit" onclick="makeCall();"></input>
</div>
<div style="display: inline-block; border: 1px solid black; vertical-align: top; padding: 2rem 2rem;">
<p>How to use this application</p>
<ol>
<li> Enter filter(s) in the appropriate inputs
<li> Enter API key
<li> Hit button, get results, copy paste to eecslab-22
</ol>
</div>
<div style="display: inline-block; border: 1px solid black; vertical-align: top; padding: 2rem 2rem;">
<p>Hints and Example Commands</p>
<ul>
<li> When searching for people, names go in (3)
<li> top-headlines? (1), country=us& (2) - Get top headlines in the US
<li> everything? (1), q=Apple& (3), from=2023-04-07& (4), sortBy=popularity& (5)
</ul>
</div>
</div>

<br>
<textarea id="displayarea" rows="20" cols="100" style="overflow:auto;" placeholder="JSON objects from API will appear here"></textarea>

<script>

function hideAPIKey(){
//toggle API key visibility
}

function makeCall(){
//define url
var base = 'https://newsapi.org/v2/';
var whatYouWant = document.getElementById('what').value;
var whereYouWant = document.getElementById('where').value;
var reg = document.getElementById('r').value;
var whenYouWant = document.getElementById('when').value;
var sortYouWant = document.getElementById('sortedby').value;
var apikey = document.getElementById('key').value;

let newURL = base + whatYouWant + whereYouWant + reg + whenYouWant + sortYouWant + apikey;

//try catch statement after grabbing modifiers
try {
// Clear display before making a new request 
document.getElementById('displayarea').value = '';
var req = new Request(newURL);
fetch(req).then(req => req.json()).then(data => textdisplay(data.articles));
}
catch (err){
document.getElementById('displayarea').value = 'An error ' + err + ' occured';
}
}


// Function to print out JSON object with article names and links 
function textdisplay(data){
//Add a [ to the beginning of JSON objects
document.getElementById('displayarea').value += "[";

//Nested for loops bc you can't print out an object
for (i=0;i<data.length;i++){
	// Adds items to textarea	
	if(i < (data.length - 1)){
		//Do we need a comma or are we at the end of the array?
		document.getElementById('displayarea').value += (JSON.stringify(data[i]) + ",");
	} else {
		document.getElementById('displayarea').value += JSON.stringify(data[i]);
	}
	

	//Get descriptions in console
	for(j=0;j<data[i].length;j++){
		console.log(data[i].description);
	}
}

//Close off JSON object
document.getElementById('displayarea').value += "]";

}

//Toggle API key visibility
function toggleVisibility() {
  var x = document.getElementById("key");
  //Get API key type, if it's a password turn it to text
  //or vice versa
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<style>
/* The modaluniquea (background) */
.modaluniquea {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* modaluniquea Content */
.modaluniquea-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 90%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.closemodalunqa {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.closemodalunqa:hover,
.closemodalunqa:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modaluniquea-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

.modaluniquea-body {padding: 2px 16px;}

.modaluniquea-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}
</style>
</head>
<body>

<h2>Animated modaluniquea with Header and Footer</h2>

<!-- Trigger/Open The modaluniquea -->
<button id="myBtn">Open modaluniquea</button>

<!-- The modaluniquea -->
<div id="mymodaluniquea" class="modaluniquea">

  <!-- modaluniquea content -->
  <div class="modaluniquea-content">
    <div class="modaluniquea-header">
      <span class="closemodalunqa">×</span>
      <h2>Modify and submit</h2>
    </div>
    <div class="modaluniquea-body">
        <ul>
            <li>article 1<input type="button" onclick="javascript:alert('coming soon')" value="Submit" /></li>
            <li>article 2<input type="button" onclick="javascript:alert('coming soon')" value="Submit" /></li>
            <li>article 3<input type="button" onclick="javascript:alert('coming soon')" value="Submit" /></li>
        
        </ul>
    </div>
    <div class="modaluniquea-footer">
      <h3>Do we even need a footer for this...</h3>
    </div>
  </div>

</div>

<script>
// Get the modaluniquea
var modaluniquea = document.getElementById('mymodaluniquea');

// Get the button that opens the modaluniquea
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modaluniquea
var span = document.getElementsByClassName("closemodalunqa")[0];

// When the user clicks on <span> (x), close the modaluniquea
span.onclick = function() {
    modaluniquea.style.display = "none";
}

// When the user clicks anywhere outside of the modaluniquea, close it
window.onclick = function(event) {
    if (event.target == modaluniquea) {
        modaluniquea.style.display = "none";
    }
}

// When the user clicks the button, open the modaluniquea
window.onload = function() {
    modaluniquea.style.display = "block";
}
</script>

</body>
</html>


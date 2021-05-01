$(document).ready(function() {
    
    
   //online users check  //auto refresh    
  
    function loadUsersOnline() {
        
        $.get("functions.php?usersonline=result", function(data){
            
          $(".online_users").text(data);  
            
            
        }); 
    }
    
    setInterval(function(){
      
        loadUsersOnline();
        
    },500); 
    
    
    // login modal start
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
    // login modal end.
    
    
    
    
    
});
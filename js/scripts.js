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
    
    
    
    
    
    
    
});
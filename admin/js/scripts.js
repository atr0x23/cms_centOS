$(document).ready(function() {
   
    //CKeditor code
ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    
    
    //select all posts checkboxes 
    
$(document).ready(function(){
                  
$('#selectAllboxes').click(function(event){

    if(this.checked) {

   $('.checkBoxes').each(function(){

        this.checked = true;  });
       
    } else {
        
        $('.checkBoxes').each(function(){
        
        this.checked = false;    
            
        });
        
            }
});                      
                   
                        });              
                  
// the loader

var div_box = "<div id='load-screen'><div id='loading'></div></div>";    

$("body").prepend(div_box);    

$('#load-screen').delay(700).fadeOut(600, function(){
    $(this).remove();
});
    
// end of loader
    
    
//online admin-users check  //auto refresh    
  
    function loadAdminsOnline() {
        
        $.get("functions.php?onlineadmins=result", function(data){
            
          $(".adminsonline").text(data);  
            
            
        }); 
    }
    
    setInterval(function(){
      
        loadAdminsOnline();
        
    },1000);

        
    

});
/*	################################################################

	Autor: Marko Domić 2013/0240, tim Elites

	Projekat: LiveTag
	Verzija: 1.0
	
################################################################# */ 



$(document).ready(function (e) {
    $('#sendTopicForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "../php_scripts/topic_send.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                
                var objParsed = jQuery.parseJSON(data);
                var success = objParsed.success;
                var message = objParsed.message;
            
                if(success > 0) {
                
                    alert(message);
                    window.open('index.php', '_self', false);
                } else {
                                        
                    alert(message);
                }                               
            },
            error: function(data){
                alert("error: " + data);                
            }
        });
    }));
});
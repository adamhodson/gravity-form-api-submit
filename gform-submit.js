$('.gform-submit').on('submit', function(e){
        e.preventDefault();
        var formdata = $('.gform-submit').serializeArray();
        console.log('asds')
        var error = false;

        if($('#botcheck').length > 0 && $('#botcheck').val().length > 0){
            window.location = 'https://www.google.com'
        }        

        $('.gform-submit input').each(function(){
            if($(this).hasClass('error')){
                error = true;
            }    
        })
        if(error){
            console.log('invalid')
        }    
        else{            
            $.ajax({
                url: php_array.admin_ajax,
                type: 'POST',
                data:{
                    action: 'create_gf_entry',
                    submitted: formdata,
                    form_id: $(this).attr('data-form-id')                                                                                                      
                },
                beforeSend: function(){
                    console.log('asdsasdasd')
                    $('.gform-submit').append('<div class="loading"><h3>Submitting Your Message</h3><div class="spinner"><div class="bounce-1"></div><div class="bounce-2"></div><div class="bounce-3"></div></div></div>');
                },
                success: function(data){
                    if(data > 0){
                        $('.gform-submit .loading h3').text('Your Message Has Been Submitted');
                        $('<p>Redirecting now...</p>').insertAfter('.gform-submit .loading h3');
                        setTimeout(function(){
                            window.location = php_array.base_url
                        }, 2000)
                        
                    }
                    console.log(data)          
                     
                    // window.location = data                            
                }
            })
        }                 
    })

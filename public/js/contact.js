$(document).ready(function(){
    
    (function($) {
        "use strict";

    
    jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value)
    }, "type the correct answer -_-");

    // validate contactForm form
    $(function() {
        $('#contactForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                subject: {
                    required: true,
                    minlength: 4
                },
                number: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 20
                }
            },
            messages: {
                name: {
                    required: "El nombre es obligatorio",
                    minlength: "El nombre debe contener al menos 2 caracteres"
                },
                subject: {
                    required: "El asunto es obligatorio",
                    minlength: "El asunto debe contener al menos 4 caracteres"
                },
                number: {
                    required: "come on, you have a number, don't you?",
                    minlength: "your Number must consist of at least 5 characters"
                },
                email: {
                    required: "El email es obligatorio"
                },
                message: {
                    required: "El mensaje es obligatorio",
                    minlength: "El mensaje debe contener al menos 20 caracteres"
                }
            },
            submitHandler: function(form) {
                grecaptcha.ready(function() {
                  grecaptcha.execute('6LcjyOIZAAAAADbTe1o5qnWv7GsjGnFW2e-oiLWS', {action: 'submit'}).then(function(token) {
                      $(form).ajaxSubmit({
                    type:"POST",
                    data: $(form).serialize(),
                    url:"welcome/envio_contacto",
                    success: function() {
                        $('#contactForm :input').attr('disabled', 'disabled');
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $(this).find(':input').attr('disabled', 'disabled');
                            $(this).find('label').css('cursor','default');
                            $('#success').fadeIn()
                            $('.modal').modal('hide');
		                	$('#success').modal('show');
                        })
                    },
                    error: function() {
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $('#error').fadeIn()
                            $('.modal').modal('hide');
		                	$('#error').modal('show');
                        })
                    }
                })
                  });
                });
                
            }
        })
    })
        
 })(jQuery)
})
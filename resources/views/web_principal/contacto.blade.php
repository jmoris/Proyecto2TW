@extends('web_principal.layout.app')

@section('contenido')
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h2>INFORMACIÓN DE CONTACTO</h2>
						<div class="page_link">
							<a href="index.html">Home</a>
							<a href="contact.html">CONTACTO</a>
						</div>
						
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
        <!--================Contact Area =================-->
        <section class="contact_area p_120">
            <div class="container">
                <div id="mapBox" class="mapBox" 
                    data-lat="40.701083" 
                    data-lon="-74.1522848" 
                    data-zoom="13" 
                    data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                    data-mlat="40.701083"
                    data-mlon="-74.1522848">
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="contact_info">
                            <div class="info_item">
                                <i class="lnr lnr-home"></i>
                                <h6>Teno, Región del Maule</h6>
                                <p>Las araucarias 025</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-phone-handset"></i>
                                <h6><a href="#">+56 9 12345678</a></h6>
                                <p>Lunes a Viernes - 09:00am a 19:00pm</p>
                            </div>
                            <div class="info_item">
                                <i class="lnr lnr-envelope"></i>
                                <h6><a href="#">jmoris15@alumnos.utalca.cl</a></h6>
                                <p>Envía tu consulta a cualquier hora!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <form class="row contact_form" id="contactForm" novalidate="novalidate">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu nombre">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu correo">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Introduce el asunto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Introduce el mensaje"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" value="submit" class="btn submit_btn">
                                    Enviar información
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--================Contact Area =================-->
        

        
        <!--================Contact Success and Error message Area =================-->
        <div id="success" class="modal modal-message fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                        <h2>Muchas gracias!</h2>
                        <p>Tu mensaje de contacto se envió exitosamente...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals error -->

        <div id="error" class="modal modal-message fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                        <h2>Lo sentimos </h2>
                        <p> Algo ha ocurrido y no se pudo enviar el correo de contacto. </p>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Contact Success and Error message Area =================-->
@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js?render=6LcjyOIZAAAAADbTe1o5qnWv7GsjGnFW2e-oiLWS"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

<script>
    (function($) {
        "use strict";
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
                        $.ajax({
                            data: $(form).serialize(),
                            url: '/contacto',
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        }).done(function(data){
                            if(data.status == 'ok'){
                                $('#contactForm :input').attr('disabled', 'disabled');
                                $('#contactForm').fadeTo( "slow", 1, function() {
                                    $(this).find(':input').attr('disabled', 'disabled');
                                    $(this).find('label').css('cursor','default');
                                    $('#success').fadeIn()
                                    $('.modal').modal('hide');
                                    $('#success').modal('show');
                                });
                            }else{
                                $('#contactForm').fadeTo( "slow", 1, function() {
                                    $('#error').fadeIn()
                                    $('.modal').modal('hide');
                                    $('#error').modal('show');
                                })
                            }
                        });
                    });
                });
            }
        })
    })
        
 })(jQuery)
</script>
@endsection

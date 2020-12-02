@extends('web_principal.layout.app')

@section('contenido')
                <!--================Home Banner Area =================-->
                <section class="home_banner_area">
            <div class="banner_inner">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="home_left_img">
								<img src="img/banner/home-left-1.png" alt="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="banner_content">
								<h5>WEB DE PRESENTACIÓN</h5>
								<h2>Jesús Moris</h2>
								<p>Bienvenido a la web, aqui podras encontrar contenido relacionado a mi vida, ya sean mis estudios basicos, medios y superiores. Ademas, de las diferentes experiencias obtenidas a lo largo de la carrera de Ing. Civil En Computacion.</p>
								<p>
									En el menu superior, aparece el boton INTRANET con el cual podras entrar al sistema de gestión.
								</p>
								
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
<!--================Welcome Area =================-->
<section class="welcome_area p_120" id="about">
        	<div class="container">
        		<div class="row welcome_inner">
        			<div class="col-lg-6">
        				<div class="welcome_text">
        					<h4>UN POCO SOBRE MI</h4>
        					<p>Soy un adulto joven de 23 años, que a lo largo de su vida siempre ha tenido una inclinacion hacia el lado de los computadores, hice mi educación basica en la Escuela San Cristobal de Teno y en el Instituto San Martin de Curico, en el cual tambien hice mi media. En cuanto a mi educación profesional, aun estoy cursando la carrera de Ingenieria Civil en Computacion en la Unviersidad de Talca.</p>
							<h3>Algunos reconocimientos</h3>
							<ul>
								<li>Analista GeneXus for students - v15 2018</li>
								<li>Olimpiadas Chilenas de Informatica (OCI)  2013 y 2014</li>
								<li>Competencia de Robotica UTFSM 2012 y 2013</li>

							</ul>
							
        				</div>
        			</div>
        			<div class="col-lg-6">
        				<div class="tools_expert">
        					<h3>Frameworks con experiencia</h3>
        					<div class="skill_main">
								<div class="skill_item">
									<h4>Laravel <span class="counter">85</span>%</h4>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Django <span class="counter">20</span>%</h4>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Express <span class="counter">40</span>%</h4>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Genexus <span class="counter">70</span>%</h4>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="skill_item">
									<h4>Java Springs <span class="counter">30</span>%</h4>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
		<!--================End Welcome Area =================-->
@endsection
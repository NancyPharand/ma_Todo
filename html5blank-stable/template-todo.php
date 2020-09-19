<?php /* Template Name: Ma todo */ get_header(); ?>

	<div role="main">
		<!-- section -->

	<div class="container" id="section-toast"></div>
	<div class="container" id="section-alert"></div>

	<!-- alert -->
	<div id="template-alert" class="alert alert-dismissible fade show" role="alert" style="display: none">
		<p class="alert-text">Test alert</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
  		</button>
	</div>

	<!-- toast -->
	<div id="template-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
		data-autohide="false">
		<div class="toast-header">
		
			<strong class="mr-auto toast-titre">Bootstrap</strong>
			<small class="toast-temps">11 mins ago</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
  		</div>
		<div class="toast-body">
			
		</div>
	</div>

	<!-- formulaire -->
	<div class="container text-center mt-5">
		<div class="border border-dark bg-light">
			<h3 class="mt-3">Ajouter une tâche</h3>
			<div class="m-5">
				<label for="tâche"></label>
				<input type="text" id="tâche" name="tâche" autofocus>
				<p>
				<button id="add" type="submit" class="btn btn-outline-info btn mt-2"
					value="Submit">Ajouter</button>
				<button id="error" type="bouton" class="btn btn-outline-danger btn mt-2"
					value="Submit">Erreur</button>
				</p>
			</div>
		</div>
  </div>


	<!-- liste de tâches -->
  	<div id="result" class="container text-center mt-4 mb-5">
      <div class="border border-dark bg-light">
        <h4 class="m-3 text-info"><ins>Tâche ajouté</ins></h4>
        <ul id="liste" class="list-group list-unstyled mb-3">
			
		</ul>
      </div>
	</div>

	<!-- template -->
	<li id="listeTache"class="list-group-item bg-light" style="display : none"><span></span></li>

<?php get_footer(); ?>

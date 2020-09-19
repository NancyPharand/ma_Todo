			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'html5blank'); ?>
					<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//html5blank.com" title="HTML5 Blank">HTML5 Blank</a>.
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- script bootstrap -->
		<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
		
		<script type="text/javascript">

		/*function changementCheckbox() {
			let fait = $(this).prop("checked");
			let post_id = $(this).attr('post_id');
			faitTodo(post_id,fait);
			console.log(fait);
		}*/

		//obtient une tâche stockée au serveur
		function obtenirTodos(data, status){
			console.log(data);
			let todos = $('#liste');

			$(data).each(function(position, todo){

				//ajout tâche
				let liClone = $('#listeTache').clone();
				liClone.attr('id', 'todo-'+todo.ID);

				let tâche = liClone.find('span');

				/*let checkbox = $('<input type="checkbox" class="todoFait">');
				checkbox.prop( "checked", todo.fait);
				checkbox.attr('post_id',todo.ID);
				checkbox.change(changementCheckbox);
				liClone.append(checkbox);*/

				tâche.text(todo.post_title);
				tâche.css("font-size", "2em");

				//ajout bouton supprimer
				let btnDelete = $('<button id="btnDelete" type="bouton" class="btn btn-danger btn-sm mt-2 ml-2">Supprimer</button>');
				btnDelete.attr('post_id',todo.ID);
				btnDelete.click(deleteTodo);
				btnDelete.appendTo(liClone);

				//ajout bouton modifier
				let btnEdit = $('<button id="btnEdit" type="bouton" class="btn btn-warning btn-sm mt-2 ml-2">Modifier</button>');
				btnEdit.attr('post_id',todo.ID);
				btnEdit.click(editTodo);
				btnEdit.appendTo(liClone);

				//ajout bouton terminer
				let btnFinish = $('<button id="btnFinish" type="bouton" class="btn btn-success btn-sm mt-2 ml-2">Accomplie</button>');
				btnFinish.appendTo(liClone);

				btnFinish.click(function(){
					tâche.css("text-decoration", "line-through");
				});

				liClone.appendTo(todos);
				liClone.show();
				liClone.addClass('animate__animated animate__flash');
			})
		};

		//ajoute les nouvelles tâches
		function nouveauTodo(data, status){
			console.log(data);
			console.log(status);
			let todos = $('#liste');
			
			if (status == "success"){
				let liClone = $('#listeTache').clone();
				liClone.attr('id', 'todo-'+data.id);
				
				let tâche = liClone.find('span');
				tâche.text(data.titre);
				tâche.css("font-size", "2em");

				//ajout bouton supprimer
				let btnDelete = $('<button id="btnDelete" type="bouton" class="btn btn-danger btn-sm mt-2 ml-2">Supprimer</button>');
				btnDelete.attr('post_id', data.id);
				btnDelete.click(deleteTodo);
				btnDelete.appendTo(liClone);

				//ajout bouton modifier
				let btnEdit = $('<button id="btnEdit" type="bouton" class="btn btn-warning btn-sm mt-2 ml-2">Modifier</button>');
				btnEdit.attr('post_id', data.id);
				btnEdit.click(editTodo);
				btnEdit.appendTo(liClone);

				//ajout bouton terminer
				let btnFinish = $('<button id="btnFinish" type="bouton" class="btn btn-success btn-sm mt-2 ml-2">Accomplie</button>');
				btnFinish.appendTo(liClone);

				btnFinish.click(function(){
					tâche.css("text-decoration", "line-through");
				});

				liClone.appendTo(todos);
				liClone.show();
				liClone.addClass('animate__animated animate__flash');
			}
		}

		/*function faitTodo(data, success) {
			console.log('Fait', data)
		}

		function faitTodo(post_id, fait) {
			$.ajax({
				'url': '/?rest_route=/html5blank-stable/todoFait',
				'method': 'POST',
				'data': { 'id' : post_id, 'fait': fait},
				'success': faitTodo
			});
		}*/

		// supprime une tâche
		function deleteSuccess(data, success) {
			let li = $('#todo-'+data.ID);
			li.addClass('animate__animated animate__backOutRight animate__slow');
			
			let tâche = li.find('span');
			let valeur = $(tâche).text();
			alertMessage("Supprimer - " + valeur);

			li.on('animationend', function() {
               li.remove();
            });
		};

		function deleteTodo() {
			let post_id = $(this).attr('post_id');

			$.ajax({
				'url': '/?rest_route=/html5blank-stable/todo&MON_ID='+post_id,
				'method': 'DELETE',
				'success': deleteSuccess
			});
		}

		function modifierPostReponse(data) {
			let selecteur = $('#todo-'+data.id);
			let li = $(selecteur);
			let valeur = li.find('span');
			valeur.text(data.titre);
			valeur.show();
			let inputText = li.find('input');
			inputText.remove();
		}

		function modifierPost(id, titre) {
			$.ajax({
				'url': '/?rest_route=/html5blank-stable/todo',
				'method': 'POST',
				'data': { 'titre' : titre,
				'id': id
				},
				'success': modifierPostReponse
			});
		}

		// sauvegarde la tâche modifiée
		function saveEdit() {
			let li = $(this).parent();
			let btnEdit = li.find('#btnEdit');
			btnEdit.show();
			let post_id = $(this).attr('post_id');
			let valeur = $(this).val();
			modifierPost(post_id, valeur);
		}

		// click bouton modifier, modifie une tâche
		function editTodo() {
			console.log($(this));
			let post_id = $(this).attr('post_id');
			let li = $(this).parent();

			let btnEdit = li.find('#btnEdit');
			btnEdit.hide();

			let tâche = li.find('span');
			let valeur = tâche.text();
			tâche.hide();
			
			let inputText = $('<input type="text"/>');
			inputText.addClass('form-control');
			inputText.attr('post_id', post_id);
			inputText.animate({fontSize: "2em"});
			inputText.val(valeur);

			inputText.focusout(saveEdit);
			li.append(inputText);
		}

		//function message erreur
		function alertMessage(message, type) {
			let valeurCouleur = "alert-danger";

			if (type !== undefined){
				valeurCouleur = type;
			}

			let alertClone = $('#template-alert').clone();
			alertClone.attr('id', '');
			alertClone.addClass(valeurCouleur);
			let alertText = alertClone.find('.alert-text')
			alertText.text(message);
			$('#section-alert').append(alertClone);
			alertClone.show();
		}

		//function toast message
		function toastMessage(titre, temps, message){
			
			let toastClone = $('#template-toast').clone();
			toastClone.attr('id', "");
			
			console.log(toastClone);

			let titreSection = toastClone.find('.toast-titre');
			titreSection.text(titre);

			let tempsSection = toastClone.find('.toast-temps');
			tempsSection.text(temps);

			let messageSection = toastClone.find('.toast-body');
			messageSection.text(message);

			$('#template-toast').hide();
			toastClone.appendTo('#section-toast');
			toastClone.toast('show');
		}

		//message lier avec la simulation
		function erreurAjax() {
			toastMessage('Ajax', " 1 minute", " Erreur Ajax");
		}

		//simulation erreur				
		function erreurClick() {
			$.ajax({
				url: "https: //goooglee.ca/",
				method: "GET",
				error: erreurAjax
			});
		}

		$(document).ready(function(){

			$.ajax({
				'url' : '/?rest_route=/html5blank-stable/todo',
				'method': 'GET',
				'success': obtenirTodos
			});

			//ajout et afficher la tâche avec bouton ajouter
			$('#add').click(function(){

				let	todoText = $('#tâche').val();
				$('#tâche').val('');

				$.ajax({
					'url': '/?rest_route=/html5blank-stable/todo',
					'method': 'POST',
					'data': { 'titre' : todoText},
					'success': nouveauTodo
				});
			});

			$('#error').click(erreurClick);

			//animer le input texte
			$('#tâche').click(function(){
				$('input').animate({fontSize: "2em"}, 1000);
			});
		});
		</script>
	</body>
</html>

<div id="reglement">
	
	<div id="subtitle"><h3>MODIFIER UN ARTICLE</h3></div>
		<?php
				
				echo form_fieldset('Modifier un article');

				echo validation_errors();
				
					echo form_open('admin/modifyArticle');

					foreach ($article as $row) :
					
						echo form_hidden('rid', set_value('rid', $row->rid));

						echo form_label('Article No :', 'artNo');
						echo form_input('artNo', set_value('artNo', $row->artNo));
						
						echo form_label('Article Name :', 'artName');
						echo form_input('artName', set_value('artName', $row->artName));
						
						echo form_label('Article Body :', 'artBody');
						echo form_textarea('artBody', set_value('artBody', $row->artBody));

					endforeach;

						echo form_submit('submit', 'Submit');

					echo form_close();
				
				echo form_fieldset_close();
			
		?>
</div>

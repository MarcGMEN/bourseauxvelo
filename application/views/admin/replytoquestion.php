<div id="faq">
		<div id="subtitle"><h3>REPONDRE A LA QUESTION</h3></div>

			<p>Utiliser le formulaire ci-dessous pour répondre aux questions :</p>

				<?php echo form_open('admin/replytoquestion'); ?>
		
			<?php foreach ($result as $row): ?>	
				<table>
					<tr>
						<th><?php echo form_label('*Name :', 'name :'); ?></th>
							<?php $name = array(
									'name'	=>	'name',
									'id'	=>	'name',
									'size'	=>	'35',
									'value'	=>	set_value('name', $row->name)
									); ?>
						<td><?php echo form_input($name); ?></td>
						<td class="validation_error"><?php echo form_error('name'); ?></td>
					</tr>
					
					<tr>
						<th><?php echo form_label('*Email :', 'email :'); ?></th>
							<?php $email = array(
									'name'	=>	'email',
									'id'	=>	'email',
									'size'	=>	'35',
									'value'	=>	set_value('email', $row->email)
									); ?>
						<td><?php echo form_input($email); ?></td>
						<td class="validation_error"><?php echo form_error('email'); ?></td>
					</tr>
					
					<tr>
						<th><?php echo form_label('*Question :', 'question'); ?></th>
							<?php $question = array(
									'name'	=>	'question',
									'id'	=>	'question',
									'cols'	=>	'35',
									'rows'	=>	'7',
									'value'	=>	set_value('question', $row->question)
									); ?>

						<td><?php echo form_textarea($question); ?></td>
						<td class="validation_error"><?php echo form_error('question'); ?></td>
					</tr>

					<tr>
						<th><?php echo form_label('*Response :', 'response'); ?></th>
							<?php $response = array(
									'name'	=>	'response',
									'id'	=>	'response',
									'cols'	=>	'35',
									'rows'	=>	'7',
									'value'	=>	set_value('response', $row->response)
									); ?>

						<td><?php echo form_textarea($response); ?></td>
						<td class="validation_error"><?php echo form_error('response'); ?></td>
					</tr>


			
					<tr>
						<th>&nbsp;</th>
						<td>* champs obligatoires (votre adresse mail ne sera pas affiché)</td>
					</tr>
			
						<?php echo form_hidden('faq_id', $row->faq_id); ?>
			
					<tr>
						<th>&nbsp;</th>
						<td><?php echo form_submit('submit', 'Submit'); ?></td>
					</tr>
				</table>	
							
			<?php endforeach; ?>
				
				<?php echo form_close(); ?>		
</div> <!-- end div -->

<div id="viewquestions">

<?php if($this->session->flashdata('message')): ?>
	<div id="confirmation"><?php echo $this->session->flashdata('message'); ?></div>
<?php endif; ?>


<div id="subtitle"><h3>QUESTIONS EN ATTENTE DE REPONSE</h3></div>

<table class="table table-striped">
	<tr>
		<th>Date</th>
		<th>Nom</th>
		<th>Mail</th>
		<th>Question</th>
		<th>Action</th>
	</tr>
	
<?php foreach ($result1 as $row1) : ?>
	
	<tr>
		<td><?php echo @date('d/m/Y', @strtotime($row1->date)); ?></td>
		<td><?php echo $row1->name; ?></td>
		<td><?php echo $row1->email; ?></td>
		<td><?php echo nl2br($row1->question); ?></td>
<td><?php echo anchor("admin/replytoquestion/".$row1->faq_id."/","Répondre"); ?> / <?php echo anchor("admin/deletequestion/".$row1->faq_id."/","Supprimer", array("title"=>"Supprimer", "onclick"=>"return confirm('Confirmer suppression ?')")); ?></td>	
	</tr>
<?php endforeach; ?>

</table>



<div id="subtitle"><h3>QUESTIONS EN ATTENTE DE DE VALIDATION</h3></div>

<table class="table table-striped">
	<tr>
		<th>Date</th>
		<th>Nom</th>
		<th>Mail</th>
		<th>Question</th>
		<th>Réponse</th>
		<th>Action</th>
	</tr>
	
<?php foreach ($result2 as $row2) : ?>
	
	<tr>
		<td><?php echo @date('d/m/Y', @strtotime($row2->date)); ?></td>
		<td><?php echo $row2->name; ?></td>
		<td><?php echo $row2->email; ?></td>
		<td><?php echo nl2br($row2->question); ?></td>
		<td><?php echo nl2br($row2->response); ?></td>
		<td><?php echo anchor("admin/approvequestion/".$row2->faq_id."/","Valider", array("title"=>"Valider", "onclick"=>"return confirm('Confirmer validation ?')")); ?> / <?php echo anchor("admin/deletequestion/".$row2->faq_id."/","Supprimer", array("title"=>"Supprimer", "onclick"=>"return confirm('Confirmer Suppression ?')")); ?></td>
	</tr>
<?php endforeach; ?>

</table>



<div id="subtitle"><h3>QUESTIONS VALIDEES & VISIBLES</h3></div>

<table class="table table-striped">
	<tr>
		<th>Date</th>
		<th>Nom</th>
		<th>Mail</th>
		<th>Question</th>
		<th>Réponse</th>
		<th>Action</th>
	</tr>
	
<?php foreach ($result3 as $row3) : ?>
	
	<tr>
		<td><?php echo @date('d/m/Y', @strtotime($row3->date)); ?></td>
		<td><?php echo $row3->name; ?></td>
		<td><?php echo $row3->email; ?></td>
		<td><?php echo nl2br($row3->question); ?></td>
		<td><?php echo nl2br($row3->response); ?></td>
		<td>	<?php echo anchor("admin/replytoquestion/".$row3->faq_id."/","Modifier"); ?> / 
			<?php echo anchor("admin/deletequestion/".$row3->faq_id."/","Supprimer", array("title"=>"Supprimer", "onclick"=>"return confirm('Confirmer Suppression ?')")); ?> / 
			<?php echo anchor("admin/unapprovequestion/".$row3->faq_id."/","Retirer", array("title"=>"Retirer", "onclick"=>"return confirm('Confirmer retraction ?')")); ?></td>
	</tr>
<?php endforeach; ?>

</table>

</div>

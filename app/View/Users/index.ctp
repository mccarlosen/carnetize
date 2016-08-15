<div id="div-list-users">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>Creado</th>
				<th>Modificado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user) { ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
				<td>
					<a href="users/view/<?php echo $user['User']['id']; ?>">
						<?php echo $user['User']['username']; ?>
					</a>
				</td>
				<td>
					<?php echo $user['User']['created']; ?>
				</td>
				<td>
					<?php echo $user['User']['modified']; ?>
				</td>
				<td>
					<a href="users/view/<?php echo $user['User']['id']; ?>">Ver</a>
					<a href="users/edit/<?php echo $user['User']['id']; ?>">Editar</a>
					<?php
						echo $this->Form->postLink('Eliminar', array('action' => 'delete', $user['User']['id']),
						array('confirm' => 'Está seguro?')
						);
					?>
				</td>
			</tr>
		<?php } unset($user); ?>
		</tbody>
	</table>
</div>

<?php //print_r($posts); ?>

<table>
	<tr>
		<th>Id</th>
		<th>Username</th>
		<th>Created</th>
		<th>Modified</th>
		<th>Acciones</th>
	</tr>
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
	<?php unset($user); ?>
</table>
<a href="users/add">New User</a>
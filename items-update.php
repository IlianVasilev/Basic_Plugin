<?php 
ob_start();
function update_items(){

	global $wpdb;
	$table_name='item_manager';

	$id=$_GET['id'];
	$name=$_POST['name'];
	$content=$_POST['content'];
	$email=$_POST['email'];
	$results['id'] = $wpdb->insert_id;
	$emailconfing=is_email($email);

	


	if (!empty($name && $content && $email)) {
		if (isset($_POST['update'])) {

			if($emailconfing == true){
				$wpdb->update($table_name,array(
					'name'=>$name,
					'content'=>$content,
					'email'=>$email
				),
				array('id'=>$id));
				$message="Item Updated";
			}
			else{
				echo "Email is Not Valid";
			}
			
		}

	}
	elseif (empty($name)){
		echo 'Please enter Name';
	}
	elseif (empty($content)){
		echo "Please enter Content";
	}
	elseif(empty($email)){
		echo "Please enter Email";
	}

	if(isset($_POST['delete'])){

		$delete=$wpdb->query("DELETE FROM $table_name WHERE id=$id");
	}
	

	$results=$wpdb->get_row("SELECT name, content, email FROM $table_name WHERE id=$id");
	
	
	?>
	<div class="wrap">

		<h2>Items</h2>
		<?php if($_POST['delete']){ ?>
		<?php 
		wp_redirect('http://localhost/Login/wordpress/wp-admin/admin.php?page=items_list');
		
		exit();
		?>
		<?php } elseif (isset($message)){
			($_POST['update'])  ?>
			<?php 
			wp_redirect('http://localhost/Login/wordpress/wp-admin/admin.php?page=items_list');
			exit();
			?>
			<?php }else { ?> 
			<form method="POST" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
				<table>
					<tr><th>ID</th><td><input type="text" name="id" value="<?php echo $id; ?>"/>
					</td></tr>
					<tr><th>Name</th><td><input type="text" name="name" value="<?php echo $results->name ?>"/>
					</td></tr>
					<tr><th>Content</th><td><input type="text" name="content" value="<?php echo $results->content ?>"/>
					</td></tr>
					<tr><th>Email</th><td><input type="text" name="email" value="<?php echo $results->email ?>"/>
					</td></tr>
				</table>
				<input type="submit" name="update" value="Save"/>
				<input type="submit" name="delete" value="Delete">
			</form>
			<?php } ?>
		</div>
		<?php 
	}


	?>
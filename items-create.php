<?php 

function items_create(){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$content=$_POST['content'];
	$email=$_POST['email'];
	$emailconfing=is_email($email);

	if (!empty($name && $content && $email)) {
		if (isset($_POST['insert'])) {
			global $wpdb;

		//$table_name=$wpdb->prefix."item_manager";

			if($emailconfing == true){
				$wpdb->insert('item_manager',array(
					'name'=>$name,
					'content'=>$content,
					'email'=>$email
				));
				$message="Item Inserted";
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
	?>

	<div class="wrap">
		<h2>Add New Item</h2>
		<?php
		if (isset($message)) {
			?>
			<div><p><?php echo $message ?> <br />
				<a href="<?php echo admin_url('admin.php?page=items_list'); ?>">Back to item list</a><br>
				<a href="<?php echo admin_url('admin.php?page=items_create'); ?>">Add New </a></p></div>
				<?php 
			}
			else{
				?>
				<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<p>Item Name </p>
					<table>
						<tr>
							<th>Name</th>
							<td><input type="text" name="name" value="<?php echo $name ?>""/></td>
						</tr>
						<tr>
							<th>Content</th>
							<td><input type="text" name="content" value="<?php echo $content ?>"/></td>							
						</tr>
						<tr>
							<th>Email</th>
							<td><input type="text" name="email" value="<?php echo $email ?>"/></td>		
						</tr>
					</table> 
					<input type="submit" name="insert" value="Save" class="button">
					<a href="<?php echo admin_url('admin.php?page=items_list') ?>">Cancel</a>
				</form>
			</div>
			<?php
		}

	}
	?>


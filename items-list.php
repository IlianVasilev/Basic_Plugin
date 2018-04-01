<?php 

function items_list(){
	?>
	<div class="wrap">
		<h2>Items</h2>
		<div>
			<div>
				<a href="<?php echo admin_url('admin.php?page=items_create'); ?>">Add New </a>
			</div>
			<br>
		</div>
		<?php 
		global $wpdb;
		$table_name="item_manager";

		$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
		$limit = 5; 
		$offset = ( $pagenum - 1 ) * $limit;

		$total = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" );
		$num_of_pages = ceil( $total / $limit );

		
		$page_links = paginate_links( array(
			'base' => add_query_arg( 'pagenum', '%#%' ),
			'format' => '',
			'prev_text' => __( '&laquo;', 'text-domain' ),
			'next_text' => __( '&raquo;', 'text-domain' ),
			'total' => $num_of_pages,
			'current' => $pagenum
		) );

		if ( $page_links ) {
			echo '<div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';

		}
		$sort='ASC';
		?>
		<table border="1" style="width: 50% ; padding:15px;" >
			<tr>
				<th><a href="<?php echo admin_url('admin.php?page=items_list&order=id'); ?>">ID</a></th>        
				<th><a href="<?php echo admin_url('admin.php?page=items_list&order=name'); ?>">Name</a></th>
				<th><a href="<?php echo admin_url('admin.php?page=items_list&order=content'); ?>">Content</a></th>
				<th><a href="<?php echo admin_url('admin.php?page=items_list&order=email'); ?>">Email</a></th>

				<?php
				
				
				
				if ($_GET['order']=='id') {
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY id $sort LIMIT $offset, $limit"); 
					?><td><a href="<?php echo admin_url('admin.php?page=items_list&order=idDESC'); ?>">⬇</a></td><?php
					
				}
				elseif ($_GET['order']== 'idDESC'){
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT $offset, $limit");
					?><th><a href="<?php echo admin_url('admin.php?page=items_list&order=id'); ?>">⬆</a></th> <?php 


				}
				elseif ($_GET['order']=='name') {
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY name ASC LIMIT $offset, $limit");
					?><td><a href="<?php echo admin_url('admin.php?page=items_list&order=nameDESC'); ?>">⬇</a></td><?php

				}
				elseif($_GET['order']=='nameDESC'){
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY name DESC LIMIT $offset, $limit");
					?><th><a href="<?php echo admin_url('admin.php?page=items_list&order=name'); ?>">⬆</a></th><?php 

				}
				elseif ($_GET['order']=='content'){
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY content ASC LIMIT $offset, $limit");
					?><td><a href="<?php echo admin_url('admin.php?page=items_list&order=contentDESC'); ?>">⬇</a></td><?php
				}
				elseif($_GET['order']=='contentDESC'){
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY content DESC LIMIT $offset, $limit");
					?><th><a href="<?php echo admin_url('admin.php?page=items_list&order=content'); ?>">⬆</a></th><?php 
				}
				elseif ($_GET['order']== 'email'){
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY email ASC LIMIT $offset,$limit");
					?><td><a href="<?php echo admin_url('admin.php?page=items_list&order=emailDESC'); ?>">⬇</a></td><?php
				}
				elseif($_GET['order']=='emailDESC'){
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY email DESC LIMIT $offset, $limit");
					?><th><a href="<?php echo admin_url('admin.php?page=items_list&order=email'); ?>">⬆</a></th><?php 
				}
				else {	
					$sql=$wpdb->get_results("SELECT * FROM $table_name ORDER BY id LIMIT $offset, $limit");
				}	
			
				?>
			</tr>
			<?php foreach ($sql as $row) { ?>
			<tr>
				<td><?php echo $row->id." "; ?> </td>
				<td><?php echo $row->name. " "; ?> </td>
				<td><?php echo $row->content. " "; ?> </td>
				<td><?php echo $row->email; ?> </td>
				<td><a href="<?php echo admin_url('admin.php?page=update_items&id='.$row->id); ?>">Edit</a></td> 

			</tr> 
			<?php 

		}

			?> 
		</table>
		
		<?php

	}


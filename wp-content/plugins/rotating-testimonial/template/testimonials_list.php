 <div class="wrap">
    <h2>Testimonial List</h2>
    <div style="color: red;"><?php echo isset($_GET["msg"]) ? "Testimonial has been " . $_GET["msg"] . " successfully" : ""; ?></div>
    <div class="tablenav top">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo $this->totalRecord(self::$table_name); ?> items</span>
            <?php echo $this->getPaginationLink(self::$table_name); ?>
        </div>
    </div>
    <table cellspacing="0" class="wp-list-table widefat fixed users">
        <thead>
            <tr>
            	<th>Testimonial ID</th>
                <th>Author Names</th>
                <th>Author Images</th>
                <th>Author's Testimonials</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tfoot>
            <tr>
            	<th>Testimonial ID</th>
                <th>Author Names</th>
                <th>Author Images</th>
                <th>Author's Testimonials</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $tableData = $this->getList(self::$table_name);
			$testimonials= new Testimonials;
			
			if ($tableData && count($tableData) > 0):
                foreach ($tableData as $tabledata):
                    ?>
                    <tr>
                    	<th><?php echo $tabledata->id; ?></th>
                        <th><?php echo $tabledata->author_names; ?></th>
                 
                        <th><img src="<?php echo $this->imagesUri.$tabledata->author_imgs; ?>" width="100px" height="100px"/></th>
                 		<th><?php echo $tabledata->author_testimonials; ?></th>
                        <th><a href="admin.php?page=testimonials_list&action=delete&id=<?php echo $tabledata->id; ?>">Delete</a><?php echo " ";?>
                        	<a href="admin.php?page=testimonials_detail&action=edit&e_id=<?php echo $tabledata->id; ?>">Edit</a> 
                        </th>
                        
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo $this->totalRecord(self::$table_name); ?> items</span>
            <?php echo $this->getPaginationLink(self::$table_name); ?>
        </div>
    </div>
    <br class="clear">
</div>
<script type="text/ecmascript">
	function form_validation()
		{
			var a=document.getElementById('author_name');
			var b=document.getElementById('file');
			var c=document.getElementById('author_testimonial');
			var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
 				
			if(a.value=="")
				{
					alert('Enter Author Name');
					return false;
				}
		<?php if(!isset($_REQUEST['e_id']) && (!isset($_FILES['file']['name']))  )
					{ ?>
			if(b.value=="")
				{
					alert('Author Image Required');
					return false;
				}
			<?php	} ?>
						
			
			if(c.value=="")
				{
					alert('Testimonial Field Required');
					return false;
				}	
				
				return true;	
		}
	function fileSelected() { // get selected file element
    var oFile = document.getElementById('file').files[0];
		
// filter for image files
    var rFilter = /^(image\/bmp|image\/gif|image\/jpeg|image\/png|image\/tiff)$/i;
// get preview element
    var oImage = document.getElementById('preview');
		
// prepare HTML5 FileReader
    var oReader = new FileReader();
    oReader.onload = function(e){
	// e.target.result contains the DataURL which we will use as a source of the image
       oImage.src = e.target.result; };
// read selected file as DataURL
	oReader.readAsDataURL(oFile);
}	
</script>

<div class="wrap">
  <form action="" method="post" enctype="multipart/form-data">
    <h2>Testimonial Detail <a href="admin.php?page=testimonials_list" class="button">Testimonial List</a></h2>
    <table cellspacing="0" class="wp-list-table widefat fixed users" style="width:70%; margin:20px 0px 0px 0px;">
      <thead>
        <tr>
          <th class="thLable">Testimonial Detail</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th class="thLable">Testimonial Detail</th>
          <th>&nbsp;</th>
        </tr>
      </tfoot>
      <tbody>
        <?php	
$tableData = $this->getRecord(self::$table_name,$_REQUEST['e_id']);
$testimonials= new Testimonials;?>
        <tr>
          <th class="thLable">Author Name</th>
          <td>
            <input type="text" name="author_name" value="<?php echo $tableData->author_names;?>" id="author_name"/>
          </td>
        </tr>
        <tr>
          <th class="thLable">Author Image</th>
          <?php if($_REQUEST['e_id'])
					{ ?>
               
          <td><img src="<?php echo $this->imagesUri.$tableData->author_imgs; ?>" width="100px" height="100px" id="preview"/> <br/>
            Replace image from below and then save it<input type="file" name="file"  id="file" onchange="fileSelected();"/>
            <br/>
            </td>
          <?php }
					else{?>
          <td>
            <input type="file" name="file"  id="file"/>
          </td>
          <?php } ?>
        </tr>
        <tr>
          <th class="thLable">Author's Testimonial</th>
          <td>
            <textarea rows="7" cols="35" name="author_testimonial" id="author_testimonial"><?php echo $tableData->author_testimonials?></textarea>
          </td>
        </tr>
        <?php if($_REQUEST['e_id'])
					{ ?>
        <tr>
          <td colspan="2" align="left" >
            <input type="submit" name="update_testimonial" value="update" onclick="return form_validation()" class="button button-primary button-large"/>
          </td>
        </tr>
        <?php }
				else{?>
        <tr>
          <td colspan="2" align="left">
            <input type="submit" name="submit_testimonial" value="submit" onclick="return form_validation()" class="button button-primary button-large"/>
          </td>
        </tr>
        <?php } ?>
        
        <!--      <tr>
                <th class="thLable">Attachment</th>
                <td>
                    <?php
                    $files = explode("/", $tableData->filename);
                    if ($files && is_array($files) && count($files) > 0) {
                        foreach ($files as $file) {
                            if ($file != "") {
                                //echo "<a href='" . get_bloginfo("home") . "/temp_upload/" . $file . "'>" . $file . "</a><br/>";
                            }
                        }
                    }
                    ?>
                </td>
            </tr>-->
      </tbody>
    </table>
  </form>
  <br class="clear">
</div>

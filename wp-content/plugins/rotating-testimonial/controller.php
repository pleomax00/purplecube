<?php
class Testimonials{
	public $pluginUri;
    public $styleUri;
	public $jscriptUri;
	public $imagesUri;
    public $pluginDir;
    public $pluginTmpdir;
    public $pluginName;
    public static $table_name = "";
	public static $table_params = "";
	public static $table_widget = "";
	public static $recordPerpage = 10;
    public $pageNumber = 1;
	public $imagesDir;
	
function __construct() {
		global $frmPluginName,$wpdb;
		self::$table_name=$wpdb->prefix .'testimonials';
		self::$table_params=$wpdb->prefix .'testimonials_params';
		self::$table_widget=$wpdb->prefix .'testimonials_widget';
        $this->pluginName=$frmPluginName;
        $this->pluginDir = dirname(__FILE__) . "/";
        $this->pluginTmpdir.= $this->pluginDir . "template/";
       	$this->pluginUri=WP_CONTENT_URL . "/plugins/".basename(dirname(__FILE__)). "/";
        $this->styleUri=$this->pluginUri . "css/";
		$this->jscriptUri=$this->pluginUri . "js/";
		$this->imagesUri=$this->pluginUri . "images/";
		$this->imagesDir=$this->pluginDir . "images/";
        add_action("admin_menu",array($this,"menu"));
		add_action( 'widgets_init',array($this,'wpb_load_widget'));
		$this->pageNumber=(is_admin() && isset($_GET["pagenum"])) ? $_GET["pagenum"] : 1;
   		add_shortcode('view_testimonial',array($this,'view_testimonials'));
		add_action('init', array($this,'external_files'));
		
}

private function getOffset(){
    return ($this->pageNumber - 1) * self::$recordPerpage;
    }
	
	public static function install_tables(){
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			Testimonials::install_testimonials();
			Testimonials::install_testimonials_params();
			Testimonials::install_testimonials_widget();
			}
	public	function delete_tables() {
		global $wpdb;
     	$delete_table1 = "DROP TABLE IF EXISTS `".self::$table_name."`";
     	$wpdb->query($delete_table1);
     		delete_option("deleted_table1");
		
     	$delete_table2 = "DROP TABLE IF EXISTS `".self::$table_params."`";
     	$wpdb->query($delete_table2);
     		delete_option("deleted_table2");	
		
		
		$delete_table3 = "DROP TABLE IF EXISTS `".self::$table_widget."`";
     	$wpdb->query($delete_table3);
     		delete_option("deleted_table3");	
				
	}
	public static function install_testimonials(){
		global $wpdb;
		$create_table1= "CREATE TABLE IF NOT EXISTS `".self::$table_name."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_names` varchar(128) NOT NULL,
  `author_imgs` varchar(128) NOT NULL,
  `author_testimonials` varchar(2000) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
		dbDelta($create_table1);
		
		$row1 = "SELECT * FROM `".self::$table_name."`";
		if(count($wpdb->get_results($row1)) == 0):
		$insert_data1="INSERT INTO `".self::$table_name."` (`id`, `author_names`, `author_imgs`, `author_testimonials`) VALUES (NULL, 'author1', 'screenshot-7.PNG', 'First Content  is here'), (NULL, 'author2', 'screenshot-8.png', 'Second Content  is here');";
		dbDelta($insert_data1);
		endif;return;
		}
		
	public static  function install_testimonials_params(){
			global $wpdb;
		$create_table2= "CREATE TABLE IF NOT EXISTS `".self::$table_params."` (
  `idOptions` int(11) NOT NULL DEFAULT '1',
  `title` varchar(128) NOT NULL,
  `width` int(128) NOT NULL,
  `height` int(128) NOT NULL,
  `effect` varchar(128) NOT NULL,
  `pagination` varchar(128) NOT NULL,
  `testimonial_ids` varchar(255) NOT NULL,
  `display_plugin_title` varchar(5) NOT NULL,
  `p_font_size` int(128) NOT NULL,
  `p_font_color` varchar(128) NOT NULL,
  `p_font_style` varchar(55) NOT NULL,
  `p_font_weight` varchar(128) NOT NULL,
  `a_font_size` int(128) NOT NULL,
  `a_font_color` varchar(128) NOT NULL,
  `a_font_style` varchar(55) NOT NULL,
  `a_font_weight` varchar(128) NOT NULL,
  `plugin_background` varchar(128) NOT NULL,
  `transition_speed` int(55) NOT NULL,
  `transition_timeout` int(55) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";
		dbDelta($create_table2);
		
		$row2 = "SELECT * FROM `".self::$table_params."`";
		if(count($wpdb->get_results($row2)) == 0):
		$insert_data2="INSERT INTO `".self::$table_params."` (`idOptions`, `title`, `width`, `height`, `effect`, `pagination`, `testimonial_ids` ,`p_font_color`,`a_font_color`, `display_plugin_title`,`transition_speed`,`transition_timeout`) VALUES ('1', 'testimonials', '500', '157', 'scrollUp', 'No', '1,2' ,'000000','000000','yes','2000','2000');";
		dbDelta($insert_data2);
		endif;return;
		}
		
		public static function install_testimonials_widget(){
			global $wpdb;
		$create_table3= "CREATE TABLE IF NOT EXISTS `".self::$table_widget."` (
  `idOptions` int(11) NOT NULL DEFAULT '1' ,
  `title` varchar(128) NOT NULL,
  `width` int(128) NOT NULL,
  `height` int(128) NOT NULL,
  `effect` varchar(128) NOT NULL,
  `testimonial_ids` varchar(255) NOT NULL,
  `display_title` varchar(5) NOT NULL,
  `content_font_size` int(128) NOT NULL,
  `content_font_color` varchar(128) NOT NULL,
  `content_font_style` varchar(55) NOT NULL,
  `content_font_weight` varchar(128) NOT NULL,
  `author_font_size` int(128) NOT NULL,
  `author_font_color` varchar(128) NOT NULL,
  `author_font_style` varchar(55) NOT NULL,
  `author_font_weight` varchar(128) NOT NULL,
	`widget_background` varchar(128) NOT NULL,
	`speed` int(55) NOT NULL,
	`timeout` int(55) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
		
		dbDelta($create_table3);
		$row3 = "SELECT * FROM `".self::$table_widget."`";
		if(count($wpdb->get_results($row3)) == 0):
		$insert_data3= "INSERT INTO  `".self::$table_widget."`(`idOptions`, `title`, `width`, `height`, `effect`, `testimonial_ids`,`content_font_color` ,`author_font_color`,`display_title` ,`speed`,`timeout`) VALUES ('1', 'Testimonial Widget', '240', '130', 'scrollUp', '1,2','000000','000000','yes','2000','2000');";
		dbDelta($insert_data3);
		endif;return;
		}
	
	public function external_files(){
		wp_enqueue_script('jquery-script1','https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		wp_enqueue_script('jquery-script',$this->jscriptUri."jquery.cycle.all.js");
		wp_enqueue_script('javascript',$this->jscriptUri."contentslider.js");
		wp_enqueue_script('javascript-colorpicker',$this->jscriptUri."jscolor.js");
		wp_enqueue_style( 'style-name',$this->styleUri."styles.css");
		}
	
	public function wpb_load_widget() {
		register_widget( 'wpb_widget' );
}  	
	public function menu() {
        add_menu_page($this->pluginName, $this->pluginName, "activate_plugins", "testimonials_list", array($this, "testimonials_list"));
        add_submenu_page("testimonials_list", "Testimonials List", "Testimonials List", "activate_plugins", "testimonials_list", array($this, "testimonials_list"));
		add_submenu_page("testimonials_list", "Add Testimonial", "Add Testimonial ", "activate_plugins", "testimonials_detail", array($this, "testimonials_detail"));
		add_submenu_page("testimonials_list", "Options", "Options", "activate_plugins", "testimonials_options", array($this, "testimonials_options"));
 }

   public function testimonials_list() {
        if (isset($_GET["action"]) && $_GET["action"] == "delete") {
            $this->deleteRecord(self::$table_name, $_GET["id"]);
            $this->redirect("admin.php?page=testimonials_list&msg=deleted");
        	include_once $this->pluginTmpdir . 'testimonials_list.php';
		}
		if (isset($_GET["action"]) && $_GET["action"] == "edit") {
            $this->editRecord(self::$table_name, $_GET["e_id"]);
            $this->redirect("admin.php?page=testimonials_detail&id=".$_GET['e_id']);
			include_once $this->pluginTmpdir . 'testimonials_detail.php';
        }
        include_once $this->pluginTmpdir . 'testimonials_list.php';
    }
	
	public function testimonials_options() {
		if(isset($_POST['save_changes'])){
			$this->getData();
		}
		if(isset($_POST['reset_changes'])){
			$this->resetData();
		}
			include_once $this->pluginTmpdir . 'testimonials_options.php';
		}
		
	public function testimonial_widget(){
		include_once $this->pluginTmpdir . 'rotating-testimonial-widget.php';
		}	
		
	public function testimonials_detail() {
        global $wpdb;
		if(isset($_POST['submit_testimonial']))
		{
			if(isset($_FILES['file']['name']))
				{
					if ($_FILES["file"]["error"] > 0)
						{
							echo "error in uoplading";
						}
					else
					{
						move_uploaded_file($_FILES['file']['tmp_name'],$this->imagesDir.$_FILES['file']['name']);
					}
				}
			$wpdb->insert(self::$table_name, array( 'author_names' => $_POST['author_name'], 'author_imgs' => $_FILES['file']['name'],'author_testimonials' => $_POST['author_testimonial']));
					$this->redirect("admin.php?page=testimonials_list");
		}
		
		if(isset($_POST['update_testimonial']))
		{
			if(isset($_REQUEST['e_id']) && ($_FILES['file']['name'] != ""))
				{
					move_uploaded_file($_FILES['file']['tmp_name'],$this->imagesDir.$_FILES['file']['name']);
					$data_array = array('id' => $_REQUEST['e_id'], 'author_names' => $_POST["author_name"], 'author_imgs' =>$_FILES['file']['name'],'author_testimonials' =>$_POST["author_testimonial"]);
				}
			else
				{
					$data_array = array('id' => $_REQUEST['e_id'], 'author_names' => $_POST["author_name"],'author_testimonials' =>$_POST["author_testimonial"]);
				}	
		$where =array("id"=>$_REQUEST['e_id']);
		$wpdb->update(self::$table_name, $data_array, $where );
		$this->redirect("admin.php?page=testimonials_list&msg=updated");
		}
		include_once $this->pluginTmpdir . 'testimonials_detail.php';
    }

    public function getRecord($table_name = "",$e_id) 
	{
        global $wpdb;
        $sql = "SELECT * FROM `" . $table_name . "` WHERE id='" .$e_id . "' LIMIT 0,1";
        return $wpdb->get_row($sql);
		
    }
	
	public function getParameters($table_params) 
	{
		global $wpdb;
		$sql = "SELECT * FROM `" . $table_params;
        return $wpdb->get_row($sql);
	}
	
	public function getWidgetData($table_widget) 
	{
		global $wpdb;
		$sql = "SELECT * FROM `" . $table_widget;
        return $wpdb->get_row($sql);
	}
	
	public function getData() 
	{
	global $wpdb;
			$changed_data = array('title' => $_REQUEST['testimonial_title'], 'width' => $_POST["testimonial_width"],'height' =>$_POST["testimonial_height"],'effect' =>$_POST["effect"],'pagination' => $_POST["pagination"],'testimonial_ids' => $_POST["monial_ids"],'display_plugin_title' => $_POST["display_plugin_title"],'p_font_size' => $_POST["p_font_size"],'p_font_color' => $_POST["p_font_color"],'p_font_style' => $_POST["p_font_style"],'p_font_weight' => $_POST["p_font_weight"],'a_font_size' => $_POST["a_font_size"],'a_font_color' => $_POST["a_font_color"],'a_font_style' => $_POST["a_font_style"],'a_font_weight' => $_POST["a_font_weight"],'plugin_background' => $_POST["plugin_background"],'transition_speed' => $_POST["transition_speed"],'transition_timeout' => $_POST["transition_timeout"]);
			$where = array('idOptions' => 1);
        	$wpdb->update(self::$table_params,$changed_data, $where);
			$this->redirect("admin.php?page=testimonials_options&msg=changed");
	}
	public function resetData() 
	{
	global $wpdb;
		$reset_data = array('title' => 'testimonials', 'width' => 500,'height' =>157,'effect' =>'scrollUp','pagination' => 'No','testimonial_ids' => '1,2','display_plugin_title' => 'yes','p_font_size' => '','p_font_color' => '000000','p_font_style' =>'','p_font_weight' => '','a_font_size' => '','a_font_color' => '000000','a_font_style' =>'','a_font_weight' =>'','plugin_background' =>'FFFFFF','transition_speed' => 2000,'transition_timeout' => 2000);
			$where = array('idOptions' => 1);
        	$wpdb->update(self::$table_params,$reset_data, $where);
			$this->redirect("admin.php?page=testimonials_options&msg=reset");
	}
	
	public function getList($table_name) {
        global $wpdb;
        $sql = "SELECT * FROM `" . $table_name . "` ORDER BY id DESC LIMIT " . $this->getOffset() . "," . self::$recordPerpage . "";
       	return $wpdb->get_results($sql);
    }

    private function totalRecord($table_name) {
        global $wpdb;
        $sql = "SELECT COUNT(`id`) FROM `" . $table_name . "`";
		return $wpdb->get_var($sql);
    }

    public function getPaginationLink($table_name) {

        $totalRecord = $this->totalRecord($table_name);
        $numberOfpages = ceil($totalRecord / self::$recordPerpage);
        $pageLinks = paginate_links(
                array(
                    'base' => add_query_arg('pagenum', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo;', 'aag'),
                    'next_text' => __('&raquo;', 'aag'),
                    'total' => $numberOfpages,
                    'current' => $this->pageNumber
                )
        );
        return $pageLinks;
    }

    public function deleteRecord($table_name = "", $id = 0) {
        global $wpdb;
        $sql = "DELETE  FROM `" . $table_name . "` WHERE id='" . $id . "'";
        return $wpdb->query($sql);
    }
	
	 public function editRecord($table_name = "", $id = 0) {
        global $wpdb;
			echo $wpdb->update( self::$table_name,  array( 'author_names' => $_POST['author_name'], 'author_imgs' => $_POST['author_img'] ,'author_testimonials' => $_POST['author_testimonial']));
      }
	
	public function redirect($pageUrl) {
        $recirectContent = "<script>";
        $recirectContent.="window.location.href='" . $pageUrl . "'";
        $recirectContent.="</script>";
        echo $recirectContent;
    }
	
	public function view_testimonials() {
		global $wpdb;
	$tableData = $this->getList(self::$table_name);
	$parameters =$this->getParameters(self::$table_params);
	$monial_ids  = $parameters->testimonial_ids;
	$monial_array = explode(",", $monial_ids); 
		if($parameters->width == ""){$parameters->width =500;} 
			print_r("<script language='javascript'>
					$(document).ready(function(){
				$('.testimonial_box') .cycle({
					fx: '$parameters->effect',
					speed: $parameters->transition_speed, 
					timeout:$parameters->transition_timeout,
					width:$parameters->width,
					height:$parameters->height
				});});</script>");
			print_r("<div id='testimonial_main'><div class='testimonial_title'><h2>$parameters->title</h2></div>");

		if($parameters->pagination == 'Yes'): print_r("<div id='slider2' class='sliderwrapper'>");
			else: print_r("<div class='testimonial_box'>"); 
		endif;	

		if ($tableData && count($tableData) > 0):
  			foreach ($monial_array as $monial_ids):
				$query = "SELECT * FROM `" . self::$table_name. "` WHERE id='" .$monial_ids. "'";
		
		if($parameters->pagination == 'Yes'): print_r("<blockquote class='testimonial'><div class='contentdiv' id='pagination'>");
			else: print_r("<blockquote class='testimonial'><div class='testimonial' id='plugin'>");
		endif;

		$tabledata=$wpdb->get_row($query);
		$author_thumbnail = $this->imagesUri.$tabledata->author_imgs;
		print_r("<img src='$author_thumbnail' width='100px' height='100px' /><p>$tabledata->author_testimonials</p><h4>$tabledata->author_names</h4></div></blockquote>");
	endforeach;

		if($parameters->pagination == 'Yes'): 
			print_r("<div id='paginate-slider2' class='pagination'><a href='#' class='prev' style='margin-left: 10px'><b>Prev</b></a>");
			print_r("<a href='#' class='next'><b>Next</b></a></div>");
		endif;
	endif;
		print_r("</div></div>");

if($parameters->pagination == 'Yes'): 
print_r("<script type='text/javascript'>
featuredcontentslider.init({
	id: 'slider2',  //id of main slider DIV
	contentsource: ['inline', ''],
	  //Valid values: ['inline', ''] or ['ajax', 'path_to_file']
	toc: 'markup',  //Valid values: '#increment', 'markup', ['label1', 'label2', etc]
	nextprev: ['Previous', 'Next'],  //labels for 'prev' and 'next' links. Set to '' to hide.
	revealtype: 'click', //Behavior of pagination links to reveal the slides: 'click' or 'mouseover'
	enablefade: [true,0.2],  //[true/false, fadedegree]
	autorotate: [true, $parameters->transition_timeout],  //[true/false, pausetime]
	onChange: function(previndex, curindex, contentdivs){  //event handler fired whenever script changes slide
		//previndex holds index of last slide viewed b4 current (0=1st slide, 1=2nd etc)
		//curindex holds index of currently shown slide (0=1st slide, 1=2nd etc)
	}
})
</script>");endif;?>
<style type='text/css'>
.sliderwrapper, .sliderwrapper .contentdiv, .testimonial_box, .testimonial_box .testimonial {
width:<?php echo $parameters->width;
?>px;
height:<?php echo $parameters->height;
?>px;
}
#plugin p, #pagination p {
font-size:<?php if($parameters->p_font_size==0):echo 15;
else: echo $parameters->p_font_size;
endif;
?>px !important;
color:<?php echo "#".$parameters->p_font_color;
?> !important;
font-style:<?php echo $parameters->p_font_style;
?> !important;
font-weight:<?php echo $parameters->p_font_weight;
?> !important;
}
#plugin h4, #pagination h4 {
font-size:<?php if($parameters->a_font_size==0):echo 15;
else: echo $parameters->a_font_size;
endif;
?>px !important;
color:<?php echo "#".$parameters->a_font_color;
?> !important;
font-style:<?php echo $parameters->a_font_style;
?> !important;
font-weight:<?php echo $parameters->a_font_weight;
?> !important;
}
.testimonial_title h2 {
display:<?php if($parameters->display_plugin_title=='no'):echo "none";
	else:echo "block";
endif;
?>;
}
.sliderwrapper, .sliderwrapper .contentdiv, #testimonial_main blockquote.testimonial {
background:<?php echo "#".$parameters->plugin_background;
?> !important;
}
</style>
<?php }

public function display_widget() { 
	global $wpdb;
		$tableData = $this->getList(self::$table_name);
		$widget_data = $this->getWidgetData(self::$table_widget);
		$array_ids  = $widget_data->testimonial_ids;
		$t_id_array = explode(",", $array_ids);

	if($widget_data->width == ""){$widget_data->width =240;}
	if($widget_data->height == ""){$widget_data->width =130;} 
		print_r("<script language='javascript'>
			$(document).ready(function(){
		$('.widget_box') .cycle({
			fx: '$widget_data->effect',
			speed:$widget_data->speed, 
			timeout:$widget_data->timeout,
			width:$widget_data->width,
			height:$widget_data->height
		});});</script>");
	print_r("<div id='widget_main'><div class='widget_title'><h2>$widget_data->title</h2></div><blockquote class='testimonial'><div class='widget_box'>");	

	if ($tableData && count($tableData) > 0):
   		foreach ($t_id_array as $t):
			print_r("<blockquote class='testimonial'><div class='testimonial' id='widget_quote'>");
				$q = "SELECT * FROM `" . self::$table_name. "` WHERE id='" .$t. "'";
				$tabledata=$wpdb->get_row($q);
				$author_thumbnail = $this->imagesUri.$tabledata->author_imgs;
			print_r("<img src='$author_thumbnail' width='100px' height='100px' /><p class='text'>$tabledata->author_testimonials</p><h4>$tabledata->author_names</h4></div></blockquote>");
		endforeach;
	endif;
			print_r("</div></div>");?>
<style type='text/css'>
#widget_main blockquote.testimonial {
background:<?php echo "#".$widget_data->widget_background;
?> !important;
}
#widget_quote p {
font-size:<?php if($widget_data->content_font_size==0):echo 15;
else: echo $widget_data->content_font_size;
endif;
?>px !important;
color:<?php echo "#".$widget_data->content_font_color;
?> !important;
font-style:<?php echo $widget_data->content_font_style;
?> !important;
font-weight:<?php echo $widget_data->content_font_weight;
?> !important;
}
#widget_quote h4 {
font-size:<?php if($widget_data->author_font_size==0):echo 15;
else: echo $widget_data->author_font_size;
endif;
?>px !important;
color:<?php echo "#".$widget_data->author_font_color;
?> !important;
font-style:<?php echo $widget_data->author_font_style;
?> !important;
font-weight:<?php echo $widget_data->author_font_weight;
?> !important;
}
.widget_title h2 {
display:<?php if($widget_data->display_title=='no'):echo "none";
	else:echo "block";
endif;
?>;
}
</style>
<?php }}



class wpb_widget extends WP_Widget{
function __construct() {
	
	global $frmPluginName,$wpdb;
	$this->pluginName=$frmPluginName;
        $this->pluginDir = dirname(__FILE__) . "/";
        $this->pluginTmpdir.= $this->pluginDir . "template/";
       	$this->pluginUri=WP_CONTENT_URL . "/plugins/".basename(dirname(__FILE__)). "/";
        $this->styleUri=$this->pluginUri . "css/";
		$this->jscriptUri=$this->pluginUri . "js/";
		$this->imagesUri=$this->pluginUri . "images/";
		$this->imagesDir=$this->pluginDir . "images/";
	
	
parent::__construct(
'wpb_widget', 
__('Rotate Testimonials', 'wpb_widget_domain'), 


array( 'description' => __( 'It is is used for displaying testimonials with multiple effects ', 'wpb_widget_domain' ), ) 
); }



public function widget( $args, $instance ) {
$testimonials= new Testimonials();
$testimonials->display_widget();
}
		
	public function form($instance) {
		$defaults = array('title' => __('Testimonials', 'monial'));
       	$instance = wp_parse_args((array) $instance, $defaults);
		include $this->pluginTmpdir . 'rotating-testimonial-widget.php';
	}
	
	

	public function update($new_instance, $old_instance ) {
		global $wpdb;
		$widget_data = array('title' =>$new_instance['title'], 'width' => $new_instance['width'],'height' =>$new_instance['height'],'effect' =>$new_instance['effect_type'],'testimonial_ids' => $new_instance['t_ids'],'display_title' => $new_instance['display_title'],'content_font_size' => $new_instance['content_font_size'],'content_font_color' => $new_instance['content_font_color'],'content_font_style' => $new_instance['content_font_style'],'content_font_weight' => $new_instance['content_font_weight'],'author_font_size' => $new_instance['author_font_size'],'author_font_color' => $new_instance['author_font_color'],'author_font_style' => $new_instance['author_font_style'],'author_font_weight' => $new_instance['author_font_weight'],'widget_background' => $new_instance['widget_background'],'speed' => $new_instance['speed'],'timeout' => $new_instance['timeout']);
		
		$where = array('idOptions' => 1);
		$wpdb->update($wpdb->prefix.'testimonials_widget', $widget_data, $where );
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
		$instance['effect_type'] = ( ! empty( $new_instance['effect_type'] ) ) ? strip_tags( $new_instance['effect_type'] ) : '';
		$instance['t_ids'] = ( ! empty( $new_instance['t_ids'] ) ) ? strip_tags( $new_instance['t_ids'] ) : '';
		$instance['content_font_size'] = ( ! empty( $new_instance['content_font_size'] ) ) ? strip_tags( $new_instance['content_font_size'] ) : '';
		$instance['content_font_color'] = ( ! empty( $new_instance['content_font_color'] ) ) ? strip_tags( $new_instance['content_font_color'] ) : '';
		$instance['content_font_style'] = ( ! empty( $new_instance['content_font_style'] ) ) ? strip_tags( $new_instance['content_font_style'] ) : '';
		$instance['content_font_weight'] = ( ! empty( $new_instance['content_font_weight'] ) ) ? strip_tags( $new_instance['content_font_weight'] ) : '';
		$instance['author_font_size'] = ( ! empty( $new_instance['author_font_size'] ) ) ? strip_tags( $new_instance['author_font_size'] ) : '';
		$instance['author_font_color'] = ( ! empty( $new_instance['author_font_color'] ) ) ? strip_tags( $new_instance['author_font_color'] ) : '';
		$instance['author_font_style'] = ( ! empty( $new_instance['author_font_style'] ) ) ? strip_tags( $new_instance['author_font_style'] ) : '';
		$instance['author_font_weight'] = ( ! empty( $new_instance['author_font_weight'] ) ) ? strip_tags( $new_instance['author_font_weight'] ) : '';
		$instance['display_title'] = ( ! empty( $new_instance['display_title'] ) ) ? strip_tags( $new_instance['display_title'] ) : '';
		$instance['widget_background'] = ( ! empty( $new_instance['widget_background'] ) ) ? strip_tags( $new_instance['widget_background'] ) : '';
		$instance['speed'] = ( ! empty( $new_instance['speed'] ) ) ? strip_tags( $new_instance['speed'] ):'';
		$instance['timeout'] = ( ! empty( $new_instance['timeout'] ) ) ? strip_tags( $new_instance['timeout']):'';
		return $instance;}
}
 $testimonials=new Testimonials();
		



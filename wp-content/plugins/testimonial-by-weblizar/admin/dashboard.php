<div class="page-content">
    <div class="row" id="dashboard">
        <div class="col-xs-12" id="dashboard">
            <h3 class="header smaller lighter blue"><i class="icon-quote-left smaller-80"></i> Testimonial By Weblizar</h3>

            <!--testimonial buttons-->
            <p id="add-new-testimonial-button">
                <button class="btn btn-primary" onclick="return Testimonial('ShowAddNewTestimonialForm', '');">
                    <i class="icon-plus align-top bigger-125"></i>
                    <?php _e("Add New Testimonial", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
                </button>
                <button id="testimonial-settings" class="btn btn-primary" onclick="return Testimonial('ShowSettingsForm', '');">
                    <i class="icon-cogs align-top bigger-125"></i>
                    <?php _e("Settings", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
                </button>
            </p>

            <!--Table header title-->
            <div class="table-header">
                <?php _e("Testimonial", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
            </div>

            <!--table-->
            <div class="table-responsive" id="testimonial-entries-table">
                <div role="grid" class="dataTables_wrapper" id="sample-table-2_wrapper">
                    <!--<div class="row">
                        <div class="col-sm-6">
                            <div id="sample-table-2_length" class="dataTables_length">
                                <label>
                                    Display
                                    <select name="sample-table-2_length" size="1" aria-controls="sample-table-2">
                                        <option value="10" selected="selected">10</option><option value="25">25</option>
                                        <option value="50">50</option><option value="100">100</option>
                                    </select>
                                    records
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="dataTables_filter" id="sample-table-2_filter">
                                <label>Search: <input type="text" aria-controls="sample-table-2"></label>
                            </div>
                        </div>
                    </div>-->

                    <!--fetch all testimonial entries from db-->
                    <?php
                        global $wpdb;
                        $TestimonialTable = $wpdb->prefix . "weblizar_testimonials";
                        $Testimonials = $wpdb->get_results("SELECT * FROM `$TestimonialTable`");
                        //print_r($Testimonials);
                    ?>

                    <table class="table table-striped table-bordered table-hover dataTable" id="sample-table-2" aria-describedby="sample-table-2_info">
                        <thead>
                            <tr role="row">
                                <th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" style="width: 50px;" aria-label="">
                                    <label>
                                        <input type="checkbox" id="checkbox" name="checkbox[]" value="0" class="ace">
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" style="width: 500px;"><?php _e("Testimonial - Name / Company Name - Email - Website", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></th>
                                <th role="columnheader" tabindex="0" aria-controls="sample-table-2" rowspan="1" colspan="1" style="width: 60px; text-align: center;"><?php _e("Status", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></th>
                                <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" style="width: 60px;" aria-label=""></th>
                            </tr>
                        </thead>

                        <?php
                            if(count($Testimonials)) {
                                foreach($Testimonials as $Testimonial) {
                                    $Id = $Testimonial->id;
                                    $Name = $Testimonial->name;
                                    $Designation = $Testimonial->designation;
                                    $Email = $Testimonial->email;
                                    $Website = $Testimonial->website;
                                    $TestimonialText = $Testimonial->testimonial;
                                    $Status = $Testimonial->status;
                        ?>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr class="odd">
                                <td class="center  sorting_1">
                                    <label>
                                        <input type="checkbox" id="checkbox" name="checkbox[]" class="ace" value="<?php echo $Id; ?>">
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td class="">
                                    <blockquote>
                                        <?php echo ucfirst($TestimonialText); ?><br>
                                        <small>
                                            <?php echo ucwords($Name); ?><br>
                                            <cite title="Source Title">
                                                <?php if($Email) { ?> <?php echo "$Email<br>"; } ?>
                                                <?php if($Designation) { echo "<strong>".ucwords($Designation)."</strong> ";  echo _e("at", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); } ?> <a href="<?php echo $Website; ?>" target="_blank"><?php echo $Website; ?></a>
                                            </cite>
                                        </small>
                                    </blockquote>
                                </td>
                                <td align="center" style="vertical-align: middle;">
                                    <?php
                                    if($Status == "pending") $StatusClass = "warning";
                                    if($Status == "published") $StatusClass = "success";
                                    if($Status == "denied") $StatusClass = "danger";
                                    ?>
                                    <span class="label label-xlg label-<?php echo $StatusClass; ?>"><?php echo ucwords($Status); ?></span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                        <a href="#" class="blue" onclick="return Testimonial('View', '<?php echo $Id; ?>');"><i class="icon-zoom-in bigger-130"></i></a>
                                        <a href="#" class="green" onclick="return Testimonial('Update', '<?php echo $Id; ?>');"><i class="icon-pencil bigger-130"></i></a>
                                        <a href="#" class="red" onclick="return Testimonial('Delete', '<?php echo $Id; ?>');"><i class="icon-trash bigger-130"></i></a>
                                    </div>
                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="inline position-relative">
                                            <button data-toggle="dropdown" class="btn btn-minier btn-yellow dropdown-toggle">
                                                <i class="icon-caret-down icon-only bigger-120"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a title="" data-rel="tooltip" class="tooltip-info" href="#" data-original-title="View">
                                                        <span class="blue"><i class="icon-zoom-in bigger-120"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a title="" data-rel="tooltip" class="tooltip-success" href="#" data-original-title="Edit">
                                                        <span class="green"><i class="icon-edit bigger-120"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a title="" data-rel="tooltip" class="tooltip-error" href="#" data-original-title="Delete">
                                                        <span class="red"><i class="icon-trash bigger-120"></i></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                    } //end of foreach
                            ?>
                            <tr class="odd">
                                <td class="center  sorting_1">
                                    <button class="btn btn-grey" title="Delete All" onclick="return Testimonial('DeleteAll', '');">
                                        <i class="icon-trash icon-only" title="Delete All"></i>
                                    </button>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                                } else {
                            ?>
                            <tr class="odd">
                                <td>&nbsp;</td>
                                <td>
                                    <div class="alert alert-danger">
                                        <strong><?php _e("Sorry!", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></strong> <?php _e("No record is found.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                                } //end of else
                            ?>
                        </tbody>
                    </table>

                    <!--pagination-->
                    <!--<div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="sample-table-2_info">
                                Showing 1 to 10 of 23 entries
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                    <li class="prev disabled"><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li>
                                    <li class="next"><a href="#"><i class="icon-double-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <!--testimonial view result div-->
    <div id="testimonial-view-result-div" style="display: none;"></div>

    <!--testimonial update result div-->
    <div id="testimonial-update-result-div" style="display: none;"></div>

    <!--row div for testimonial form-->
    <?php require_once("testimonial-form.php"); ?>

</div>



<!--jQuery Works-->
<script>
function Testimonial(Action, Id){
    //alert(Action + " " + Id);

    //on-click add new testimonial button
    if(Action == "ShowAddNewTestimonialForm") {
        jQuery("#dashboard").hide();
        jQuery("#add-new-testimonial-form").show();
    }

    /**
     * Add Action Ajax
     */
    //on-click go back button at testimonial form
    if(Action == "AddGoBack") {
        jQuery("#add-new-testimonial-form").hide();
        jQuery("#dashboard").show();
    }

    //on-click save button at testimonial form
    if(Action == "Save") {
        jQuery(".tError").hide();

        var Name = jQuery("#name").val();
        var Email = jQuery("#email").val();
        var Website = jQuery("#website").val();
        var Designation = jQuery("#designation").val();
        var Testimonial = jQuery("#testimonial").val();
        var Status = jQuery("#status").val();

        //name
        if(Name == "") {
            jQuery("#name").focus();
            jQuery("#name-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type your name', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
            return false;
        }

        //email
        var EmailRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        /*if(Email == "") {
            jQuery("#email-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type your email', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
            return false;
        }*/
        if(Email) {
            if(EmailRegex.test(Email) == false ) {
                jQuery("#email").focus();
                jQuery("#email-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type valid email', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
                return false;
            }
        }

       

        //testimonial
        if(Testimonial == "") {
            jQuery("#testimonial").focus();
            jQuery("#testimonial-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type your testimonial', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
            return false;
        }

        //check http:// and add if not
        if(Website.substr(0,7) != 'http://'){
            Website = 'http://' + Website;
        }
        if(Website.substr(Website.length-1, 1) != '/'){
            Website = Website + '/';
        }

        var PostData = "Action=" + Action + "&Name=" + Name + "&Email=" + Email + "&Website=" + Website + "&Designation=" + Designation + "&Testimonial=" + Testimonial + "&Status=" + Status;
        jQuery("#save").hide();
        jQuery("#go-back").hide();
        jQuery.ajax({
            dataType : 'html',
            type: 'POST',
            url : location.href,
            cache: false,
            data : PostData,
            complete : function() {  },
            success: function(data) {
                jQuery("#save-success-message").show();
                //location.href = "?page=weblizar-testimonial";
            }
        });
    }

    /**
     * View Action Ajax
     */

    //on-click view button at testimonial dashboard
    if(Action == "View") {
        var PostData = "Action=" + Action + "&Id=" + Id;
        jQuery("#save").hide();
        jQuery.ajax({
            dataType : 'html',
            type: 'POST',
            url : location.href,
            cache: false,
            data : PostData,
            complete : function() {  },
            success: function(Data) {
                Data = jQuery(Data).find('div#testimonial-view-result');
                jQuery("#dashboard").hide();
                jQuery("#testimonial-view-result-div").show();
                jQuery("#testimonial-view-result-div").html(Data);
            }
        });
    }

    //on-click view go back button at testimonial view form
    if(Action == "ViewGoBack") {
        jQuery("#testimonial-view-result-div").hide();
        jQuery("#dashboard").show();
    }

    /**
     * Update Action Ajax
     */
    //on-click update button at testimonial dashboard
    if(Action == "Update") {
        var PostData = "Action=" + Action + "&Id=" + Id;
        jQuery("#save").hide();
        jQuery.ajax({
            dataType : 'html',
            type: 'POST',
            url : location.href,
            cache: false,
            data : PostData,
            complete : function() {  },
            success: function(Data) {
                Data = jQuery(Data).find('div#testimonial-update-result');
                jQuery("#dashboard").hide();
                jQuery("#testimonial-update-result-div").show();
                jQuery("#testimonial-update-result-div").html(Data);
            }
        });
    }

    //on-click update go back button at testimonial update form
    if(Action == "UpdateGoBack") {
        jQuery("#testimonial-update-result").hide();
        jQuery("#dashboard").show();
    }

    //do update after click on Update button on update form
    if(Action == "DoUpdate") {
        jQuery(".tError").hide();
        var Name = jQuery("#name").val();
        var Email = jQuery("#email").val();
        var Website = jQuery("#website").val();
        var Designation = jQuery("#designation").val();
        var Testimonial = jQuery("#testimonial").val();
        var Status = jQuery("#status").val();

        //name
        if(Name == "") {
            jQuery("#name-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type your name', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
            return false;
        }

        //email
        var EmailRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        /*if(Email == "") {
         jQuery("#email-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type your email', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
         return false;
         }*/
        if(Email) {
            if(EmailRegex.test(Email) == false ) {
                jQuery("#email-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type valid email', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
                return false;
            }
        }

      
        //testimonial
        if(Testimonial == "") {
            jQuery("#testimonial-div").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <strong><?php _e('Field Required:', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></strong> <?php _e('Type your testimonial', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
            return false;
        }

        var PostData = "Action=" + Action + "&Id=" + Id + "&Name=" + Name + "&Email=" + Email + "&Website=" + Website + "&Designation=" + Designation + "&Testimonial=" + Testimonial + "&Status=" + Status;
        jQuery("#update").hide();
        jQuery("#update-go-back").hide();
        jQuery.ajax({
            dataType : 'html',
            type: 'POST',
            url : location.href,
            cache: false,
            data : PostData,
            complete : function() {  },
            success: function(data) {
                jQuery("#update-success-message").show();
                //location.href = "?page=weblizar-testimonial";
            }
        });
    }


    /**
     * Delete Action Ajax
     */
    //alert(Action + " " + Id);
    //on-click delete button at testimonial dashboard
    if(Action == "Delete" && Id) {
        if (confirm("Are you sure to delete?")) {
            var PostData = "Action=" + Action + "&Id=" + Id;
            jQuery.ajax({
                dataType : 'html',
                type: 'POST',
                url : location.href,
                cache: false,
                data : PostData,
                complete : function() {  },
                success: function(Data) {
                    jQuery("#dashboard").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <?php _e('Testimonial successfully deleted', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
                    location.href = "?page=weblizar-testimonial";
                }
            });
        }
    }

    //on-click delete all button at testimonial dashboard
    if(Action == "DeleteAll") {
        var SelectedCheckBoxes = jQuery('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        if(SelectedCheckBoxes == "") {
            alert('<?php _e("First select one or more testimonials.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>');
        } else if ( confirm("<?php _e("Are you sure to delete selected testimonials?", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>")) {
            var PostData = "Action=" + Action + "&Id=" + SelectedCheckBoxes;
            jQuery.ajax({
                dataType : 'html',
                type: 'POST',
                url : location.href,
                cache: false,
                data : PostData,
                complete : function() {  },
                success: function(data) {
                    jQuery("#dashboard").after("<div class='tError alert alert-danger'><button class='close' data-dismiss='alert' type='button'><i class='icon-remove'></i></button> <?php _e('Selected Testimonials successfully deleted', 'WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN'); ?></div>");
                    location.href = "?page=weblizar-testimonial";
                }
            });
        }
    }

    /**
     * Testimonial Settings Ajax
     */

    //on-click settings button
    if(Action == "ShowSettingsForm") {
        jQuery("#dashboard").hide();
        jQuery("#testimonial-settings-form").show();
    }

    //on-click settings go back button at testimonial settings form
    if(Action == "SettingsGoBack") {
        jQuery("#testimonial-settings-form").hide();
        jQuery("#dashboard").show();
    }

    //on-click update button at testimonial dashboard
    if(Action == "SaveSettings") {
        var ShortCodeTitle = jQuery("#short-code-title").val();
        var PostData = "Action=" + Action + "&ShortCodeTitle=" + ShortCodeTitle;
        jQuery.ajax({
            dataType : 'html',
            type: 'POST',
            url : location.href,
            cache: false,
            data : PostData,
            complete : function() {  },
            success: function(Data) {
                jQuery("#save-settings").hide();
                jQuery("#settings-go-back").hide();
                jQuery("#settings-success-message").show();
            }
        });
    }
}
//select all check boxes
jQuery('#checkbox').click(function(){
    if(jQuery('#checkbox').is(':checked')) {
        jQuery(":checkbox").prop("checked", true);
    } else {
        jQuery(":checkbox").prop("checked", false);
    }
});
</script>

<?php
//print_r($_POST);
if(isset($_POST['Action'])) {
    global $wpdb;
    $TestimonialTable = $wpdb->prefix . "weblizar_testimonials";
    $Action = $_POST['Action'];


    //Save
    if($Action === "Save") {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Website = $_POST['Website'];
        $Designation = $_POST['Designation'];
        $Testimonial = strip_tags($_POST['Testimonial']);
        $Status = $_POST['Status'];
        $wpdb->query("INSERT INTO `$TestimonialTable` (`id`, `name`, `email`, `testimonial`, `website`, `designation`, `status`) VALUES (NULL, '$Name', '$Email', '$Testimonial', '$Website', '$Designation', '$Status');");
    }

    //Update
    if($Action === "DoUpdate" && $Id) {
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Website = $_POST['Website'];
        $Designation = $_POST['Designation'];
        $TestimonialText = strip_tags($_POST['Testimonial']);
        $Status = $_POST['Status'];
        $wpdb->query("UPDATE `$TestimonialTable` SET `name` = '$Name', `email` = '$Email', `testimonial` = '$TestimonialText', `website` = '$Website', `designation` = '$Designation', `status` = '$Status' WHERE `id` = '$Id';");
    }

    //Delete
    if($Action === "Delete" && $Id) {
        $Id = $_POST['Id'];
        $wpdb->query("DELETE FROM `$TestimonialTable` WHERE `id` = '$Id'");
    }

    //Delete All
    if($Action === "DeleteAll") {
        $Id = $_POST['Id'];
        $Ids = explode(",", $Id);
        if(count($Ids)) {
            for($i = 0; $i < count($Ids); $i++) {
                echo $DelId = $Ids[$i];
                $wpdb->query("DELETE FROM `$TestimonialTable` WHERE `id` = '$DelId'");
            }
        }
    }

    //Save Settings
    if($Action == "SaveSettings") {
        print_r($Action);
        $ShortCodeTitle = $_POST['ShortCodeTitle'];
        $Settings = serialize(array(
            'short_code_title' => $ShortCodeTitle
        ));
        update_option('weblizar_testimonial_settings', $Settings);
    }
}
?>
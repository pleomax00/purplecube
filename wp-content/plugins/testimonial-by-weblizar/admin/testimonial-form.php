<!--add new testimonial-->
<div class="row" id="add-new-testimonial-form" style="display: none;">
    <div class="col-sm-8">
        <div class="widget-box">

            <div class="widget-header">
                <h4><?php _e("Add New Testimonial", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></h4>
                <span class="widget-toolbar">
                    <a data-action="close" href="#" onclick="return Testimonial('ViewGoBack', '');">
                        <i class="icon-remove"></i>
                    </a>
                </span>
            </div>

            <div class="widget-body">
                <div class="widget-main">

                    <label>* <?php _e("Name / Company Name", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="name-div">
                                <input type="text" id="name" class="form-control">
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Type your name / company name here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <label><?php _e("Email", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="email-div">
                                <input type="text" id="email" class="form-control">
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Type your email here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <label><?php _e("Website", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="website-div">
                                <input type="text" id="website" class="form-control">
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Type your website address here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <label><?php _e("Designation", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="designation-div">
                                <input type="text" id="designation" class="form-control">
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Type your designation here. Like CEO, Founder, Doctor, Developer, Programmer etc.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <label>* <?php _e("Testimonial", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="testimonial-div">
                                <textarea id="testimonial" class="form-control" style="height: 160px;"></textarea>
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Type your testimonial about product/service here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <label><?php _e("Status", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="status-div">
                                <select id="status" class="form-control">
                                    <option value="pending"><?php _e("Pending", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></option>
                                    <option value="published"><?php _e("Published", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></option>
                                    <option value="denied"><?php _e("Denied", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></option>
                                </select>
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Select your testimonial status here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <button class="btn btn-success" id="save" onclick="return Testimonial('Save', '');"><i class="icon-save"></i> <?php _e("Save", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                    <button class="btn btn-default" id="go-back" onclick="return Testimonial('AddGoBack', '');"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                    <div id="save-success-message" class="alert alert-success" style="display: none;">
                        <a data-dismiss="alert" class="btn btn-sm" type="button" href="?page=weblizar-testimonial"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></a>
                        <strong><i class="icon-ok"></i> <?php _e("Well Done!", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></strong> <?php _e("New testimonial successfully added.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--view testimonial-->
<?php
    global $wpdb;
    $TestimonialTable = $wpdb->prefix . "weblizar_testimonials";
    if(isset($_POST['Action']) == "View" && isset($_POST['Id'])) {
        $Action = $_POST['Action'];
        $Id = $_POST['Id'];
        if($Action == "View" && $Id) {
            $Testimonial = $wpdb->get_row("SELECT * FROM `$TestimonialTable` WHERE `id` = '$Id'");
            if(count($Testimonial)){
                $Name = $Testimonial->name;
                $Email = $Testimonial->email;
                $Website = $Testimonial->website;
                $Designation = $Testimonial->designation;
                $TestimonialText = $Testimonial->testimonial;
                ?>
                <div class="row" id="testimonial-view-result">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                            <h4 class="smaller">
                                <i class="icon-quote-left smaller-80"></i>
                                <?php _e("Testimonial By", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?> <?php echo ucwords($Name); ?>
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <blockquote>
                                            <p><?php echo $TestimonialText; ?></p>
                                            <small>
                                                <cite title="Source Title"><?php echo ucwords($Name); ?></cite>
                                            </small>
                                        </blockquote>
                                    </div>
                                </div>
                                <hr>
                                <address>
                                    <strong><?php echo ucwords($Name); ?></strong>
                                    <br>
                                    <?php if($Email) { echo $Email; echo "<br>"; } ?>
                                    <?php if($Designation) { echo $Designation; ?> <?php _e("at", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); } ?> <a href="<?php echo $Website; ?>" target="_blank"><?php echo $Website; ?></a>
                                    <br>
                                </address>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-default" id="view-go-back" onclick="return Testimonial('ViewGoBack', '');"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                    <br>
                </div>
                <?php
            } //end of count if
        } //end of view action if
    } //end of view isset if
?>

<?php
/**
 * Update Testimonial Form
 */
if(isset($_POST['Action']) && isset($_POST['Id'])) {
    $Action = $_POST['Action'];
    $Id = $_POST['Id'];
    if($Action == "Update" && $Id) {
        $Testimonial = $wpdb->get_row("SELECT * FROM `$TestimonialTable` WHERE `id` = '$Id'");
        if(count($Testimonial)){
            $Id = $Testimonial->id;
            $Name = $Testimonial->name;
            $Email = $Testimonial->email;
            $Website = $Testimonial->website;
            $Designation = $Testimonial->designation;
            $TestimonialText = htmlspecialchars_decode($Testimonial->testimonial);
            $Status = $Testimonial->status;
            ?>
            <!--update testimonial-->
            <div class="row" id="testimonial-update-result">
                <div class="col-sm-8">
                    <div class="widget-box">

                        <div class="widget-header">
                            <h4><?php _e("Update Testimonial", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></h4>
                            <span class="widget-toolbar">
                                <a data-action="close" href="#" onclick="return Testimonial('UpdateGoBack', '');">
                                    <i class="icon-remove"></i>
                                </a>
                            </span>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">

                                <label>* <?php _e("Name / Company Name", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-11">
                                        <div class="input-group" id="name-div">
                                            <input type="text" id="name" class="form-control" value="<?php echo ucwords($Name); ?>">
                                            <span class="input-group-addon">
                                                <i class="icon-question-sign bigger-110" title="<?php _e("Type your name / company name here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <label><?php _e("Email", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-11">
                                        <div class="input-group" id="email-div">
                                            <input type="text" id="email" class="form-control" value="<?php echo $Email; ?>">
                                            <span class="input-group-addon">
                                                <i class="icon-question-sign bigger-110" title="<?php _e("Type your email here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <label><?php _e("Website", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-11">
                                        <div class="input-group" id="website-div">
                                            <input type="text" id="website" class="form-control" value="<?php echo $Website; ?>">
                                            <span class="input-group-addon">
                                                <i class="icon-question-sign bigger-110" title="<?php _e("Type your website address here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <label><?php _e("Designation", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-11">
                                        <div class="input-group" id="designation-div">
                                            <input type="text" id="designation" class="form-control" value="<?php echo ucwords($Designation); ?>">
                                            <span class="input-group-addon">
                                                <i class="icon-question-sign bigger-110" title="<?php _e("Type your designation here. Like CEO, Founder, Doctor, Developer, Programmer etc.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <label>* <?php _e("Testimonial", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-11">
                                        <div class="input-group" id="testimonial-div">
                                            <textarea id="testimonial" class="form-control" style="height: 160px;"><?php echo ucfirst($TestimonialText); ?></textarea>
                                            <span class="input-group-addon">
                                                <i class="icon-question-sign bigger-110" title="<?php _e("Type your testimonial about product/service here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <label><?php _e("Status", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                                <div class="row">
                                    <div class="col-xs-8 col-sm-11">
                                        <div class="input-group" id="status-div">
                                            <select id="status" class="form-control">
                                                <option value="pending" <?php if($Status == "pending") echo "selected=selected"; ?>><?php _e("Pending", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></option>
                                                <option value="published" <?php if($Status == "published") echo "selected=selected"; ?>><?php _e("Published", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></option>
                                                <option value="denied" <?php if($Status == "denied") echo "selected=selected"; ?>><?php _e("Denied", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></option>
                                            </select>
                                            <span class="input-group-addon">
                                                <i class="icon-question-sign bigger-110" title="<?php _e("Select your testimonial status here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <button class="btn btn-success" id="update" onclick="return Testimonial('DoUpdate', '<?php echo $Id; ?>');"><i class="icon-save"></i> <?php _e("Update", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                                <button class="btn btn-default" id="update-go-back" onclick="return Testimonial('UpdateGoBack', '');"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                                <div id="update-success-message" class="alert alert-success" style="display: none;">
                                    <a data-dismiss="alert" class="btn btn-sm" type="button" href="?page=weblizar-testimonial"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></a>
                                    <strong><i class="icon-ok"></i> <?php _e("Well Done!", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></strong> <?php _e("Testimonial successfully updated.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
                                    <br>
                                </div>
                            </div>
                        </div><!--end of widget-body-->

                    </div>
                </div>
            </div>
            <?php
        } //end count if
    } //end of Action if
} //end of isset if
?>

<!--testimonial settings form div-->
<div id="testimonial-settings-form" style="display: none;">
    <div class="col-sm-8">
        <div class="widget-box">
            <div class="widget-header">
                <h4><?php _e("Testimonial Settings", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></h4>

                <span class="widget-toolbar">
                    <a data-action="close" href="#" onclick="return Testimonial('SettingsGoBack', '');">
                        <i class="icon-remove"></i>
                    </a>
                </span>
            </div>
            <?php
                //default settings
                $Title = __("What Our Customer Says", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN);

                //Get all settings
                $Settings = unserialize(get_option('weblizar_testimonial_settings'));
                $Title = $Settings['short_code_title'];
            ?>
            <div class="widget-body">
                <div class="widget-main">

                    <label><?php _e("Testimonial Title For [WLT] Shortcode", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></label>
                    <div class="row">
                        <div class="col-xs-8 col-sm-11">
                            <div class="input-group" id="name-div">
                                <input type="text" id="short-code-title" class="form-control" placeholder="<?php _e("What Our Customer Says", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>" value="<?php echo $Title; ?>">
                                <span class="input-group-addon">
                                    <i class="icon-question-sign bigger-110" title="<?php _e("Type title for shortcode here", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <button class="btn btn-success" id="save-settings" onclick="return Testimonial('SaveSettings', '');"><i class="icon-save"></i> <?php _e("Save", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                    <button class="btn btn-default" id="settings-go-back" onclick="return Testimonial('SettingsGoBack', '');"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></button>
                    <div id="settings-success-message" class="alert alert-success" style="display: none;">
                        <a data-dismiss="alert" class="btn btn-sm" type="button" href="?page=weblizar-testimonial"><i class="icon-arrow-left"></i> <?php _e("Go Back", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></a>
                        <strong><i class="icon-ok"></i> <?php _e("Well Done!", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?></strong> <?php _e("Testimonial settings successfully saved.", WEBLIZAR_TESTIMONIAL_TEXT_DOMAIN); ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
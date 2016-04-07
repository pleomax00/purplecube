<?php
	global $wpdb;

	$table_name  =  $wpdb->prefix . "poll_wp_Questions";
	$table_name2 =  $wpdb->prefix . "poll_wp_Answers";
	$table_name3 =  $wpdb->prefix . "poll_wp_Results";
	$table_name4 =  $wpdb->prefix . "poll_wp_Settings";
	$table_name5 =  $wpdb->prefix . "poll_wp_position";
	$table_name6 =  $wpdb->prefix . "poll_wp_font_family";
	$table_name7 =  $wpdb->prefix . "poll_wp_Parameters";

	$sql1="DROP table $table_name";
	$sql2="DROP table $table_name2";
	$sql3="DROP table $table_name3";
	$sql4="DROP table $table_name4";
	$sql5="DROP table $table_name5";
	$sql6="DROP table $table_name6";
	$sql7="DROP table $table_name7";

	$wpdb->query($sql1);
	$wpdb->query($sql2);
	$wpdb->query($sql3);
	$wpdb->query($sql4);
	$wpdb->query($sql5);
	$wpdb->query($sql6);
	$wpdb->query($sql7);
?>
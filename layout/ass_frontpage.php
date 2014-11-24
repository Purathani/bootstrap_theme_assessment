<?php
$regions = bootstrap_grid(true, true);
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head >
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses) ?>">
	<?php echo $OUTPUT->standard_top_of_body_html() ?>
	<nav role="navigation" class="navbar navbar-default">
	    <div class="ass_background">
	    <div id="moodle-navbar" class="navbar-collapse collapse">
	    	<a href="<?php echo $CFG->wwwroot;?>">
				<img src="<?php echo $OUTPUT->pix_url('lingel-learning', 'theme'); ?>"  alt=""  />
	    	</a>
	        <?php echo $OUTPUT->custom_menu(); ?>
	        <?php echo $OUTPUT->user_menu(); ?>
	        <ul class="nav pull-right">
	            <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
	        </ul>
	    </div>
	    </div>
	</nav>
<header class="moodleheader">
    <div class="container-fluid">
	    <?php echo $OUTPUT->page_heading(); ?>
	    <header id="page-header" class="clearfix">
        <?php echo $html->heading; ?>
        <div id="page-navbar" class="clearfix">
            <nav class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></nav>
            <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
        </div>
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>
    </div>
</header>
<div id="page" class="container-fluid">
    <div id="page-content" class="row" >
        <div id="region-main" class="<?php echo $regions['content']; ?>">
           <div class="ass_content"> 
            <?php
            echo $OUTPUT->course_content_header();
            echo $OUTPUT->main_content();
            echo $OUTPUT->course_content_footer();
            ?>
           </div>
        </div>
 	    <?php
            echo $OUTPUT->blocks('side-pre', $regions['pre']);
            echo $OUTPUT->blocks('side-post', $regions['post']);
        ?>
    </div>
     <div id="region-pre" class="block-region">
   		<div class="region-content">
       <?php echo $OUTPUT->blocks_for_region('bottom-region') ?>
   		</div>
	</div>
<div class="ass_background">
    <footer id="page-footer">
        <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
        <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </footer>
</div>
    <?php echo $OUTPUT->standard_end_of_body_html() ?>
</div>
</body>
</html>

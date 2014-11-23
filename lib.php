<?php
// This file is part of The Bootstrap 3 Moodle theme
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_bootstrap
 * @copyright  2014 Bas Brands, www.basbrands.nl
 * @authors    Bas Brands, David Scotson
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();


function bootstrap_grid($hassidepre, $hassidepost) {

    if ($hassidepre && $hassidepost) {
        $regions = array('content' => 'col-sm-6 col-sm-push-3 col-lg-8 col-lg-push-2');
        $regions['pre'] = 'col-sm-3 col-sm-pull-6 col-lg-2 col-lg-pull-8';
        $regions['post'] = 'col-sm-3 col-lg-2';
    } else if ($hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-sm-9 col-sm-push-3 col-lg-10 col-lg-push-2');
        $regions['pre'] = 'col-sm-3 col-sm-pull-9 col-lg-2 col-lg-pull-10';
        $regions['post'] = 'emtpy';
    } else if (!$hassidepre && $hassidepost) {
        $regions = array('content' => 'col-sm-9 col-lg-10');
        $regions['pre'] = 'empty';
        $regions['post'] = 'col-sm-3 col-lg-2';
    } else if (!$hassidepre && !$hassidepost) {
        $regions = array('content' => 'col-md-12');
        $regions['pre'] = 'empty';
        $regions['post'] = 'empty';
    }
    
    if ('rtl' === get_string('thisdirection', 'langconfig')) {
        if ($hassidepre && $hassidepost) {
            $regions['pre'] = 'col-sm-3  col-sm-push-3 col-lg-2 col-lg-push-2';
            $regions['post'] = 'col-sm-3 col-sm-pull-9 col-lg-2 col-lg-pull-10';
        } else if ($hassidepre && !$hassidepost) {
            $regions = array('content' => 'col-sm-9 col-lg-10');
            $regions['pre'] = 'col-sm-3 col-lg-2';
            $regions['post'] = 'empty';
        } else if (!$hassidepre && $hassidepost) {
            $regions = array('content' => 'col-sm-9 col-sm-push-3 col-lg-10 col-lg-push-2');
            $regions['pre'] = 'empty';
            $regions['post'] = 'col-sm-3 col-sm-pull-9 col-lg-2 col-lg-pull-10';
        }
    }
    return $regions;
}

/**
 * Loads the JavaScript for the zoom function.
 *
 * @param moodle_page $page Pass in $PAGE.
 */
function theme_bootstrap_initialise_zoom(moodle_page $page) {
    user_preference_allow_ajax_update('theme_bootstrap_zoom', PARAM_TEXT);
    $page->requires->yui_module('moodle-theme_bootstrap-zoom', 'M.theme_bootstrap.zoom.init', array());
}

/**
 * Get the user preference for the zoom function.
 */
function theme_bootstrap_get_zoom() {
    return get_user_preferences('theme_bootstrap_zoom', '');
}


function theme_essential_render_slide($i, $captionoptions) {
    global $PAGE, $OUTPUT;

   /*
     $slideurl = theme_essential_get_setting('slide' . $i . 'url');
    $slideurltarget = theme_essential_get_setting('slide' . $i . 'target');
    $slidetitle = theme_essential_get_setting('slide' . $i, true);
    $slidecaption = theme_essential_get_setting('slide' . $i . 'caption', true);
    $slideextraclass = ($i === 1) ? ' active' : '';
    $slideimagealt = strip_tags(theme_essential_get_setting('slide' . $i, true));
    $slideimage = $OUTPUT->pix_url('default_slide', 'theme');

    * * 
    */
    
     $slideurl = '';
    $slideurltarget = '';
    $slidetitle = '';
    $slidecaption = '';
    $slideextraclass = 'active';
    $slideimagealt = '';
    $slideimage = $OUTPUT->pix_url('default_slide', 'theme');
	
    // Get slide image or fallback to default
    // if (theme_essential_get_setting('slide' . $i . 'image')) {
        // $slideimage = $PAGE->theme->setting_file_url('slide' . $i . 'image', 'slide' . $i . 'image');
    // }

    if ($captionoptions == 0) {
        $slideextraclass .= ' side-caption';
    }
    if ($slideurl) {
        $slide = '<a href="' . $slideurl . '" target="' . $slideurltarget . '" class="item' . $slideextraclass . '">';
    } else {
        $slide = '<div class="item' . $slideextraclass . '">';
    }

    if ($captionoptions == 0) {
        $slide .= '<div class="container-fluid">';
        $slide .= '<div class="row-fluid">';
        
        if ($slidetitle || $slidecaption) {
            $slide .= '<div class="span5 the-side-caption">';
            $slide .= '<div class="the-side-caption-content">';
            $slide .= '<h4>' . $slidetitle . '</h4>';
            $slide .= '<p>' . $slidecaption . '</p>';
            $slide .= '</div>';
            $slide .= '</div>';
            $slide .= '<div class="span7">';
        } else {
            $slide .= '<div class="span10 offset1 nocaption">';
        }
        $slide .= '<div class="carousel-image-container">';
        $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
        $slide .= '</div>';
        $slide .= '</div>';
        
        $slide .= '</div>';
        $slide .= '</div>';
    } else {
        $nocaption = (!($slidetitle || $slidecaption)) ? ' nocaption' : '';
        $slide .= '<div class="carousel-image-container'.$nocaption.'">';
        $slide .= '<img src="' . $slideimage . '" alt="' . $slideimagealt . '" class="carousel-image"/>';
        $slide .= '</div>';

        // Output title and caption if either is present
        if ($slidetitle || $slidecaption) {
            $slide .= '<div class="carousel-caption">';
            $slide .= '<div class="carousel-caption-inner">';
            $slide .= '<h4>' . $slidetitle . '</h4>';
            $slide .= '<p>' . $slidecaption . '</p>';
            $slide .= '</div>';
            $slide .= '</div>';
        }
    }
    $slide .= ($slideurl) ? '</a>' : '</div>';


    return $slide;
}

function theme_essential_render_slide_controls($left) {
    $faleft = 'left';
    $faright = 'right';
    if (!$left) {
        $temp = $faleft;
        $faleft = $faright;
        $faright = $temp;
    }
    $prev = '<a class="left carousel-control" href="#essentialCarousel" data-slide="prev"><i class="fa fa-chevron-circle-' . $faleft . '"></i></a>';
    $next = '<a class="right carousel-control" href="#essentialCarousel" data-slide="next"><i class="fa fa-chevron-circle-' . $faright . '"></i></a>';

    if ($left) {
        return $prev . $next;
    } else {
        return $next . $prev;
    }
}
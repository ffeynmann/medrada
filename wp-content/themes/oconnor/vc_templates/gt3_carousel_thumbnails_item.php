<?php

$defaults = array(
    'image_current' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

echo do_shortcode($content);
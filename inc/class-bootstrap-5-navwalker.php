<?php
/**
 * Custom Nav Walker for Bootstrap 5
 * @package aocndigboi
 */

class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu {

    private $current_item;
    private $dropdown_menu_alignment_values = [
        'dropdown-menu-start',
        'dropdown-menu-end',
        'dropdown-menu-sm-start',
        'dropdown-menu-sm-end',
        'dropdown-menu-md-start',
        'dropdown-menu-md-end',
        'dropdown-menu-lg-start',
        'dropdown-menu-lg-end',
        'dropdown-menu-xl-start',
        'dropdown-menu-xl-end',
        'dropdown-menu-xxl-start',
        'dropdown-menu-xxl-end'
    ];

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $dropdown_menu_class = [];

        foreach ((array) $this->current_item->classes as $class) {
            if (in_array($class, $this->dropdown_menu_alignment_values)) {
                $dropdown_menu_class[] = $class;
            }
        }

        $indent = str_repeat("\t", $depth);
        $submenu_class = ($depth > 0) ? ' dropdown-submenu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu_class " . esc_attr(implode(" ", $dropdown_menu_class)) . " depth_$depth\">\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $this->current_item = $item;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;

        if ($args->walker->has_children) {
            $classes[] = 'dropdown';
        }

        $class_names = join(' ', array_filter($classes));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id_attr = ' id="menu-item-' . $item->ID . '"';

        $output .= $indent . '<li' . $id_attr . $class_names . '>';

        $attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';

        // Safely check if 'current-menu-item' is in classes array
        $classes_array = is_array($item->classes) ? $item->classes : [];
        $active_class = in_array('current-menu-item', $classes_array) ? ' active' : '';

        $link_class = 'nav-link';

        if ($args->walker->has_children) {
            $link_class .= ' dropdown-toggle';
            $attributes .= ' data-bs-toggle="dropdown" aria-expanded="false"';
        }

        if ($depth > 0) {
            $link_class = 'dropdown-item';
            if ($args->walker->has_children) {
                $link_class .= ' dropdown-toggle';
            }
        }

        $attributes .= ' class="' . $link_class . $active_class . '"';

        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

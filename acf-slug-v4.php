<?php


class acf_field_slug extends acf_field
{

    protected array $existant_slugs = array();

    /*
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since	3.6
    *  @date	23/01/13
    */


    function __construct()
    {
        // vars
        $this->name = 'slug';
        $this->label = __('Slug');
        $this->category = __('Basic', 'acf-slug');
        $this->defaults = array(
            'default_value' => '',
            'maxlength' => '',
            'prepend' => '',
            'append' => '',
            'reference_field_name' => 'title',
        );

        // settings
        $this->settings = array(
            'path' => apply_filters('acf/helpers/get_path', __FILE__),
            'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
            'version' => '1.0.0'
        );

        // do not delete!
        parent::__construct();

    }


    /*
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param	$field - an array holding all the field's data
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function create_field($field)
    {
        $html = '';

        // Prepend text.
        if ($field['prepend'] !== '') {
            $field['class'] .= ' acf-is-prepended';
            $html .= '<div class="acf-input-prepend">' . acf_esc_html($field['prepend']) . '</div>';
        }

        // Append text.
        if ($field['append'] !== '') {
            $field['class'] .= ' acf-is-appended';
            $html .= '<div class="acf-input-append">' . acf_esc_html($field['append']) . '</div>';
        }

        // Input.
        $input_attrs = array();
        foreach (array('type', 'id', 'class', 'name', 'value', 'placeholder', 'maxlength', 'pattern', 'readonly', 'disabled', 'required') as $k) {
            if (isset($field[$k])) {
                $input_attrs[$k] = $field[$k];
            }
        }
        $html .= '<div class="acf-input-wrap">' . acf_get_text_input(acf_filter_attrs($input_attrs)) . '</div>';

        // Display.
        echo $html;
    }


    /*
    *  create_options()
    *
    *  Create extra options for your field. This is rendered when editing a field.
    *  The value of $field['name'] can be used (like bellow) to save extra data to the $field
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field	- an array holding all the field's data
    */

    function create_options($field)
    {
        // vars
        $key = $field['name'];

        ?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Default Value", 'acf-slug'); ?></label>
                <p class="description"><?php _e("Appears when creating a new post",'acf-slug'); ?><br>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'text',
                    'name' => 'fields[' . $key . '][default_value]',
                    'value' => $field['default_value'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Reference Field Name", 'acf-slug'); ?></label>
                <p class="description"><?php _e("Put the field name from where the slug will be generated if the slug is empty",'acf-slug'); ?><br>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'text',
                    'name' => 'fields[' . $key . '][reference_field_name]',
                    'value' => $field['reference_field_name'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Character Limit", 'acf-slug'); ?></label>
                <p class="description"><?php _e("Leave blank for no limit",'acf-slug'); ?><br>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'number',
                    'name' => 'fields[' . $key . '][maxlength]',
                    'value' => $field['maxlength'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Placeholder Text", 'acf-slug'); ?></label>
                <p class="description"><?php _e("Appears within the input",'acf-slug'); ?><br>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'text',
                    'name' => 'fields[' . $key . '][placeholder]',
                    'value' => $field['placeholder'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Prepend", 'acf-slug'); ?></label>
                <p class="description"><?php _e("Appears before the input",'acf-slug'); ?><br>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'text',
                    'name' => 'fields[' . $key . '][prepend]',
                    'value' => $field['prepend'],
                ));

                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Append", 'acf-slug'); ?></label>
                <p class="description"><?php _e("Appears after the input",'acf-slug'); ?><br>
            </td>
            <td>
                <?php

                do_action('acf/create_field', array(
                    'type' => 'text',
                    'name' => 'fields[' . $key . '][append]',
                    'value' => $field['append'],
                ));

                ?>
            </td>
        </tr>
        <?php

    }

    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add css + javascript to assist your create_field() action.
    *
    *  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    function input_admin_enqueue_scripts()
    {
        // scripts
        wp_register_script('acf-input-slug', $this->settings['dir'] . 'js/slug.js', array('acf-input'), $this->settings['version']);
        wp_enqueue_script(array(
            'acf-input-slug',
        ));

        // styles
        wp_register_style('acf-input-slug', $this->settings['dir'] . 'css/slug.css', array('acf-input'), $this->settings['version']);
        wp_enqueue_style(array(
            'acf-input-slug',
        ));
    }


    /*
    *  update_value()
    *
    *  This filter is applied to the $value before it is updated in the db
    *
    *  @type    filter
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   $value - the value which will be saved in the database
    *  @param   $post_id - the $post_id of which the value will be saved
    *  @param   $field - the field array holding all the field options
    *
    *  @return  $value - the modified value
    */

    function update_value( $value, $post_id, $field ) {

        // Bail early if no value.
        if ( empty( $value ) ) {
            $value =  get_field(str_replace($this->name, $field['reference_field_name'], $field['name'] ), $post_id);
        }

        if (function_exists('getSlugFromTitle')) {
            $value =  getSlugFromTitle($value, $this->existant_slugs[$field['parent']] ?? []);
        }else if (function_exists('acf_slugify')) {
            $value =  acf_slugify($value);
        } else {
            $value =  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value), '-'));
        }

        $this->existant_slugs[$field['parent']][] = $value;

        return $value;
    }

}

new acf_field_slug();

?>

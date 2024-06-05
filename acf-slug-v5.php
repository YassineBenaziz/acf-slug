<?php

class acf_field_slug_v5 extends acf_field
{

    protected array $existant_slugs = array();

    /*
    *  __construct
    *
    *  This function will setup the field type data
    *
    *  @type	function
    *  @date	5/03/2014
    *  @since	5.0.0
    *
    *  @param	n/a
    *  @return	n/a
    */

    function __construct()
    {

        /*
        *  name (string) Single word, no spaces. Underscores allowed
        */

        $this->name = 'slug';

        $this->input_type = 'text';


        /*
        *  label (string) Multiple words, can include spaces, visible when selecting a field type
        */

        $this->label = __('Slug', 'acf-slug');


        /*
        *  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
        */

        $this->category = 'basic';


        /*
        *  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
        */

        $this->defaults = array(
            'default_value' => '',
            'maxlength' => '',
            'prepend' => '',
            'append' => '',
            'reference_field_name' => 'title',

        );


        /*
        *  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
        *  var message = acf._e('slug', 'error');
        */

        $this->l10n = array(
            'error' => __('Error! Please enter a higher value', 'acf-slug'),
        );


        // do not delete!
        parent::__construct();

    }


    /*
    *  render_field_settings()
    *
    *  Create extra settings for your field. These are visible when editing a field
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field (array) the $field being edited
    *  @return	n/a
    */

    function render_field_settings($field)
    {
        acf_render_field_setting(
            $field,
            array(
                'label' => __('Default Value', 'acf-slug'),
                'instructions' => __('Appears when creating a new post', 'acf-slug'),
                'type' => 'text',
                'name' => 'default_value',
            )
        );

        acf_render_field_setting( $field, array(
            'label'			=> __('Reference Field Name','acf-slug'),
            'instructions'  => __( 'Put the field name from where the slug will be generated if the slug is empty', 'acf-slug' ),
            'type'			=> 'text',
            'name'			=> 'reference_field_name',
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Character Limit','acf-slug'),
            'instructions'  => __( 'Leave blank for no limit', 'acf-slug' ),
            'type'			=> 'number',
            'name'			=> 'maxlength',
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Placeholder Text','acf-slug'),
            'instructions'  => __( 'Appears within the input', 'acf-slug' ),
            'type'			=> 'text',
            'name'			=> 'placeholder',
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Prepend','acf-slug'),
            'instructions'  => __( 'Appears before the input', 'acf-slug' ),
            'type'			=> 'text',
            'name'			=> 'prepend',
        ));

        acf_render_field_setting( $field, array(
            'label'			=> __('Append','acf-slug'),
            'instructions'  => __( 'Appears after the input', 'acf-slug' ),
            'type'			=> 'text',
            'name'			=> 'append',
        ));
    }


    /*
    *  render_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param	$field (array) the $field being rendered
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field (array) the $field being edited
    *  @return	n/a
    */

    function render_field($field)
    {

        $html = '';
        //var_dump($field);
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
        $input_attrs = array('type' => $this->input_type);
        foreach (array('id', 'class', 'name', 'value', 'placeholder', 'maxlength', 'pattern', 'readonly', 'disabled', 'required') as $k) {
            if (isset($field[$k])) {
                $input_attrs[$k] = $field[$k];
            }
        }
        $html .= '<div class="acf-input-wrap">' . acf_get_text_input(acf_filter_attrs($input_attrs)) . '</div>';

        // Display.
        echo $html;
    }


    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your render_field() action.
    *
    *  @type	action (admin_enqueue_scripts)
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	n/a
    *  @return	n/a
    */


    function input_admin_enqueue_scripts()
    {

        $dir = plugin_dir_url(__FILE__);


        // register & include JS
        wp_register_script('acf-input-slug', "{$dir}js/slug.js");
        wp_enqueue_script('acf-input-slug');


        // register & include CSS
        wp_register_style('acf-input-slug', "{$dir}css/slug.css");
        wp_enqueue_style('acf-input-slug');


    }




    /**
     * validate_value
     *
     * Validates a field's value.
     *
     * @date    29/1/19
     * @param (bool|string) $valid Whether the value is vaid or not.
     * @param mixed $value The field value.
     * @param array $field The field array.
     * @param string $input The HTML input name.
     * @return  (bool|string)
     * @since   5.7.11
     *
     */
    function validate_value($valid, $value, $field, $input)
    {

        // Check maxlength
        if ($field['maxlength'] && (acf_strlen($value) > $field['maxlength'])) {
            return sprintf(__('Value must not exceed %d characters', 'acf-slug'), $field['maxlength']);
        }

        // Return.
        return $valid;
    }


    /**
     * Return the schema array for the REST API.
     *
     * @param array $field
     * @return array
     */
    function get_rest_schema(array $field)
    {
        $schema = parent::get_rest_schema($field);

        if (!empty($field['maxlength'])) {
            $schema['maxLength'] = (int)$field['maxlength'];
        }

        return $schema;
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

?>

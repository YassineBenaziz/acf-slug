<?php

class acf_field_slug_v6 extends acf_field_slug_v5
{


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
    }



    /**
     * Renders the field settings used in the "Validation" tab.
     *
     * @param array $field The field settings array.
     * @return void
     * @since 6.0
     *
     */
    function render_field_validation_settings( $field ) {
        acf_render_field_setting(
            $field,
            array(
                'label'        => __( 'Character Limit', 'acf-slug' ),
                'instructions' => __( 'Leave blank for no limit', 'acf-slug' ),
                'type'         => 'number',
                'name'         => 'maxlength',
            )
        );
    }

    /**
     * Renders the field settings used in the "Presentation" tab.
     *
     * @param array $field The field settings array.
     * @return void
     * @since 6.0
     *
     */
    function render_field_presentation_settings( $field ) {
        acf_render_field_setting(
            $field,
            array(
                'label'        => __( 'Placeholder Text', 'acf-slug' ),
                'instructions' => __( 'Appears within the input', 'acf-slug' ),
                'type'         => 'text',
                'name'         => 'placeholder',
            )
        );

        acf_render_field_setting(
            $field,
            array(
                'label'        => __( 'Prepend', 'acf-slug' ),
                'instructions' => __( 'Appears before the input', 'acf-slug' ),
                'type'         => 'text',
                'name'         => 'prepend',
            )
        );

        acf_render_field_setting(
            $field,
            array(
                'label'        => __( 'Append', 'acf-slug' ),
                'instructions' => __( 'Appears after the input', 'acf-slug' ),
                'type'         => 'text',
                'name'         => 'append',
            )
        );
    }


}


?>

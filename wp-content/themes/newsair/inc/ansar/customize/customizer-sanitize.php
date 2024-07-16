<?php
/**
 * Sanitization functions.
 *
 * @package Newsair
 */

if ( ! function_exists( 'newsair_sanitize_checkbox' ) ) :

    /**
     * Sanitize checkbox.
     *
     * @since 1.0.0
     *
     * @param bool $checked Whether the checkbox is checked.
     * @return bool Whether the checkbox is checked.
     */
    function newsair_sanitize_checkbox( $checked ) {

        return ( ( isset( $checked ) && true === $checked ) ? true : false );

    }

endif;


if ( ! function_exists( 'newsair_sanitize_select' ) ) :

    /**
     * Sanitize select.
     *
     * @since 1.0.0
     *
     * @param mixed                $input The value to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return mixed Sanitized value.
     */
    function newsair_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_text_field( $input );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }

endif;

if ( ! function_exists( 'newsair_sanitize_positive_integer' ) ) :

    /**
     * Sanitize positive integer.
     *
     * @since 1.0.0
     *
     * @param int                  $input Number to sanitize.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return int Sanitized number; otherwise, the setting default.
     */
    function newsair_sanitize_positive_integer( $input, $setting ) {

        $input = absint( $input );

        // If the input is an absolute integer, return it.
        // otherwise, return the default.
        return ( $input ? $input : $setting->default );

    }

endif;

if ( ! function_exists( 'newsair_sanitize_radio' ) ) :
function newsair_sanitize_radio( $val, $setting ) {
        $val = sanitize_key( $val );
        $choices = $setting->manager->get_control( $setting->id )->choices;
        return array_key_exists( $val, $choices ) ? $val : $setting->default;
    }
endif;

if ( ! function_exists( 'newsair_sanitize_alpha_color' ) ) :
    function newsair_sanitize_alpha_color( $value ) {
        // Check if the value is a valid hexadecimal color
        if ( preg_match( '/^#([a-f0-9]{3}){1,2}$/i', $value ) ) {
            return sanitize_hex_color( $value );
        }
        
        // Check if the value is a valid RGB color
        if ( preg_match( '/^rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)$/i', $value, $matches ) ) {
            $red = intval( $matches[1] );
            $green = intval( $matches[2] );
            $blue = intval( $matches[3] );
            
            return "rgb($red, $green, $blue)";
        }
        
        // Check if the value is a valid RGBA color
        if ( preg_match( '/^rgba\((\d{1,3}),(\d{1,3}),(\d{1,3}),([\d\.]+)\)$/i', $value, $matches ) ) {
            $red = intval( $matches[1] );
            $green = intval( $matches[2] );
            $blue = intval( $matches[3] );
            $alpha = floatval( $matches[4] );
            
            // Ensure alpha value is between 0 and 1
            $alpha = max( 0, min( 1, $alpha ) );
            
            return "rgba($red, $green, $blue, $alpha)";
        }
        
        // If none of the above formats match, return a default value
        return '';
    }
endif;
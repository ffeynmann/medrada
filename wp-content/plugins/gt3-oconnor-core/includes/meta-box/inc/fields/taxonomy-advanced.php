<?php
/**
 * Taxonomy advanced field class which saves terms' IDs in the post meta.
 */
class RWMB_Taxonomy_Advanced_Field extends RWMB_Taxonomy_Field {

	/**
	 * Get meta values to save
	 * Save terms in custom field, no more by setting post terms
	 * Save in form of comma-separated IDs
	 *
	 * @param mixed $new
	 * @param mixed $old
	 * @param int   $post_id
	 * @param array $field
	 *
	 * @return string
	 */
	public static function value( $new, $old, $post_id, $field ) {
		return implode( ',', array_unique( (array) $new ) );
	}

	/**
	 * Save meta value
	 *
	 * @param mixed $new
	 * @param mixed $old
	 * @param int   $post_id
	 * @param array $field
	 */
	public static function save( $new, $old, $post_id, $field ) {
		if ( $new ) {
			update_post_meta( $post_id, $field['id'], $new );
		} else { delete_post_meta( $post_id, $field['id'] );
		}
	}

	/**
	 * Get raw meta value
	 *
	 * @param int   $post_id
	 * @param array $field
	 *
	 * @return mixed
	 */
	public static function raw_meta( $post_id, $field ) {
		$meta = get_post_meta( $post_id, $field['id'], true );
		$meta = wp_parse_id_list( $meta );
		return array_filter( $meta );
	}

	/**
	 * Get the field value
	 * Return list of post term objects
	 *
	 * @param  array    $field   Field parameters
	 * @param  array    $args    Additional arguments. Rarely used. See specific fields for details
	 * @param  int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return array List of post term objects
	 */
	public static function get_value( $field, $args = array(), $post_id = null ) {

        if ( ! $post_id ) {
            $post_id = get_the_ID();
        }

		$value = self::meta( $post_id, '', $field );
		if ( empty( $value ) ) {
			return null;
		}

		// Allow to pass more arguments to "get_terms"
		$args  = wp_parse_args( array(
			'include'    => $value,
			'hide_empty' => false,
		), $args );
		$value = get_terms( $field['taxonomy'], $args );

		// Get single value if necessary
		if ( ! $field['clone'] && ! $field['multiple'] ) {
			$value = reset( $value );
		}
		return $value;
	}
}

<?php
/**
 * User Profile.
 *
 * This metabox is used to display the user profile. It gives quick access to basic information about the client.
 *
 * @since 3.3
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $post;

// Get the user object
$user = get_userdata( $post->post_author );

// Get tickets
$open   = wpas_get_tickets( 'open', array( 'posts_per_page' => apply_filters( 'wpas_user_profile_tickets_open_limit', 10 ), 'author' => $post->post_author ) );
$closed = wpas_get_tickets( 'closed', array( 'posts_per_page' => apply_filters( 'wpas_user_profile_tickets_closed_limit', 5 ), 'author' => $post->post_author ) );

// Sort open tickets
$by_status  = array();
$all_status = wpas_get_post_status();

foreach ( $open as $t ) {

	if ( ! is_a( $t, 'WP_Post' ) ) {
		continue;
	}

	if ( ! array_key_exists( $t->post_status, $all_status ) ) {
		continue;
	}

	if ( ! array_key_exists( $t->post_status, $by_status ) ) {
		$by_status[ $t->post_status ] = array();
	}

	$by_status[ $t->post_status ][] = $t;

}

// Add the closed tickets in the list
$by_status['closed'] = $closed;
?>
<div id="wpas-up">

	<?php
	/**
	 * Fires before anything is processed in the user profile metabox
	 *
	 * @since 3.3
	 * @var WP_User $user The user object
	 * @var WP_Post $post Post object of the current ticket
	 */
	do_action( 'wpas_user_profile_metabox_before', $user, $post ); ?>

	<div class="wpas-up-contact-details wpas-cf">
		<a href="<?php echo esc_url( admin_url( 'user-edit.php?user_id=' . $user->ID ) ); ?>">
			<?php echo get_avatar( $user->ID, '80', 'mm', $user->data->display_name, array( 'class' => 'wpas-up-contact-img' ) ); ?>
		</a>
		<?php
		$contact_fields = wpas_user_profile_get_contact_info( $post->ID );

		foreach ( $contact_fields as $contact_field ) {
			printf( '<div class="wpas-up-contact-%1$s">', $contact_field );
			wpas_user_profile_contact_info_contents( $contact_field, $user, $post->ID );
			echo '</div>';
		}
		?>
	</div>

	<?php
	/**
	 * Fires after the contact information fields
	 *
	 * @since 3.3
	 * @var WP_User $user The user object
	 * @var WP_Post $post Post object of the current ticket
	 */
	do_action( 'wpas_user_profile_metabox_after_contact_info', $user, $post ); ?>
	
	<div class="wpas-row wpas-up-stats">
		<div class="wpas-col wpas-up-stats-all">
			<strong><?php echo count( $open ) + count( $closed ); ?></strong>
			<?php echo esc_html__( 'Total', 'awesome-support' ); ?>
		</div>
		<div class="wpas-col wpas-up-stats-open">
			<strong><?php echo count( $open ); ?></strong>
			<?php echo esc_html__( 'Open', 'awesome-support' ); ?>
		</div>
		<div class="wpas-col wpas-up-stats-closed">
			<strong><?php echo count( $closed ); ?></strong>
			<?php echo esc_html__( 'Closed', 'awesome-support' ); ?>
		</div>
	</div>

	<?php
	/**
	 * Fires after the user stats
	 *
	 * @since 3.3
	 * @var WP_User $user The user object
	 * @var WP_Post $post Post object of the current ticket
	 */
	do_action( 'wpas_user_profile_metabox_after_stats', $user, $post ); ?>

	<div class="wpas-up-tickets">
		<?php
		foreach ( $by_status as $status => $tickets ) {

			if ( empty( $tickets ) ) {
				continue;
			}

			$status_label = 'closed' === $status ? esc_html__( 'Closed', 'awesome-support' ) : $all_status[ $status ];
			$lis = sprintf( '<li><span class="wpas-label" style="background-color:%1$s;">%2$s ▾</span></li>', wpas_get_option( "color_$status", '#dd3333' ), $status_label );

			foreach ( $tickets as $t ) {
				$created = sprintf( esc_html_x( 'Created on %s', 'Ticket date creation', 'awesome-support' ), date( get_option( 'date_format' ), strtotime( $t->post_date ) ) );
				$title   = apply_filters( 'the_title', $t->post_title );
				$link    = esc_url( admin_url( "post.php?post=$t->ID&action=edit" ) );

				if ( $t->ID !== (int) $post->ID ) {
					$lis .= sprintf( '<li data-hint="%1$s" class="hint-left hint-anim"><a href="%3$s">%2$s</a></li>', $created, $title, $link );
				} else {
					$lis .= sprintf( '<li data-hint="%1$s" class="hint-left hint-anim">%2$s (%3$s)</li>', $created, $title, esc_html_x( 'current', 'Identifies the ticket in a list as being the ticket displayed on the current screen', 'awesome-support' ) );
				}
			}

			printf( '<ul>%s</ul>', $lis );

		}
		?>

		<!-- @todo <a href="/wp-admin/edit.php?post_type=ticket" class="button">View all tickets</a> -->
	</div>

	<?php
	/**
	 * Fires after everything else is processed in the user profile metabox
	 *
	 * @since 3.3
	 * @var WP_User $user The user object
	 * @var WP_Post $post Post object of the current ticket
	 */
	do_action( 'wpas_user_profile_metabox_after', $user, $post ); ?>

</div>
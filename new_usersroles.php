<?php 
    /*
    Plugin Name: Adding  drop down roles  in registration 
    Plugin URI: http://fancynews.in
    Description: Adding  drop down roles  in registration 
    Author: Madiri Salman Aashish
    Version: 1.0
   
    */

	function new_usersroles_actions() {
 
add_menu_page('ADDING USER ROLES', 'ADDING USER ROLES', 'manage_options', 'ADDING USER ROLES', 'new_usersroles_content');
 
 
 }
 
 function new_usersroles_content()
 {
	
	 
	echo '<br>';
	echo 'Created by Madiri Salman Aashish';
	echo 'madirisalmanaashish@gmail.com';
	
	
	
	

 }
 
 add_action('admin_menu', 'new_usersroles_actions');
 

add_action( 'register_form', 'new_usersroles_register_form' );
function new_usersroles_register_form() {

    global $wp_roles;

    echo '<select name="role" class="input">';
    foreach ( $wp_roles->roles as $key=>$value ):
       echo '<option value="'.$key.'">'.$value['name'].'</option>';
    endforeach;
    echo '</select>';
}

//2. Add validation.
add_filter( 'registration_errors', 'new_usersroles_registration_errors', 10, 3 );
function new_usersroles_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    if ( empty( $_POST['role'] ) || ! empty( $_POST['role'] ) && trim( $_POST['role'] ) == '' ) {
         $errors->add( 'role_error', __( '<strong>ERROR</strong>: You must include a role.', 'mydomain' ) );
    }

    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'new_usersroles_user_register' );
function new_usersroles_user_register( $user_id ) {

   $user_id = wp_update_user( array( 'ID' => $user_id, 'role' => $_POST['role'] ) );
}
	 

	
	?>
<?php

/**
 * Get more information for the user when logging in with the JWT Authentication plugin by Enrique
 *
 * @param array $data
 * @param array $user
 * @return array
 */
function mod_jwt_auth_token_before_dispatch( $data, $user ) {
    $user_info = get_user_by( 'email',  $user->data->user_email );
    $profile = array (
        'id' => $user_info->id,
        'roles' => $user_info->roles,
        'user_first_name' => $user_info->first_name,
        'user_last_name' => $user_info->last_name,
        'user_email' => $user->data->user_email,
        'user_nicename' => $user->data->user_nicename,
        'user_display_name' => $user->data->display_name,
        // 'phone' => get_field( 'phone', "user_$user_info->id" ) // you also can get ACF fields
    );
    $response = array(
        'token' => $data['token'],
        'profile' => $profile
    );
    return $response;
}
add_filter( 'jwt_auth_token_before_dispatch', 'mod_jwt_auth_token_before_dispatch', 10, 2 );
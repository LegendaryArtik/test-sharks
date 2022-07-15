<?php


/**
 * Class CityCreation
 */
class CityCreation extends WP_REST_Controller
{
    /**
     * CityCreation constructor.
     */
    public function __construct()
    {

        $this->register_routes();
    }

    public function register_routes()
    {
        register_rest_route(
            'api', '/cities/new',
            [
                [
                    'methods' => 'POST',
                    'callback' => [$this, 'createCity'],
                    'args' => [],
                ],
            ]
        );

    }

    public function createCity(WP_REST_Request $request)
    {
        $params = $request->get_body_params();

        $required_fields = ["title", "description"];

        foreach ($required_fields as $field) {
            if (empty($params[$field])) {
                return new  WP_REST_Response(([
                    "status" => "Error",
                    "message" => "Field " . $field . " is required",
                ]), 200);
            }
        }
        $title = $params["title"];
        $description = $params["description"];


        //Creating city
        $city_id = wp_insert_post([
            'post_title' => $title,
            'post_content' => $description,
            'post_type' => 'cities',
            'post_status' => 'publish'
        ]);

        if (isset($_FILES["thumbnail"]) && !empty($_FILES["thumbnail"])) {
            if (!empty($_FILES["thumbnail"]['size'])) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');

                $attachment_id = media_handle_upload('thumbnail', 0);

                if (is_wp_error($attachment_id)) {
                    echo "Ошибка загрузки медиафайла.";
                }

                set_post_thumbnail($city_id, $attachment_id);
            }
        }

        return new WP_HTTP_Response([
            "status" => "Ok",
            "message" => "City created",
        ], 200);
    }
}
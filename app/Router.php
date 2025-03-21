<?php
class Router
{
    public function routeRequest()
    {
        // Lấy đường dẫn URL
        $url = isset($_GET['url']) ? $_GET['url'] : 'SinhVien/index';
        $urlParts = explode('/', $url);

        // Lấy Controller và Action từ URL
        $controllerName = ucfirst($urlParts[0]) . 'Controller'; // Ví dụ: DefaultController
        $action = isset($urlParts[1]) ? $urlParts[1] : 'index'; // Mặc định là index()

        // Lấy các tham số từ URL
        $params = array_slice($urlParts, 2);

        // Đường dẫn file Controller
        $controllerFile = "app/controllers/" . $controllerName . ".php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                if (method_exists($controller, $action)) {
                    // Gọi phương thức action với các tham số
                    call_user_func_array([$controller, $action], $params);
                } else {
                    echo "Lỗi: Action `$action` không tồn tại!";
                }
            } else {
                echo "Lỗi: Class `$controllerName` không tồn tại!";
            }
        } else {
            echo "Lỗi: Controller `$controllerName` không tồn tại!";
        }
    }
}

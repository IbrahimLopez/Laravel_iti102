<?php
/*  Developed by: Ibrahim Alexis Lopez Roman
    Año: 19/09/2018,
    Materia: Desarrollo de aplicaciones web,
    Maestro: Noe Cazarez,
    Descripcion: Clase UrlHelper
*/
namespace App\Helpers;


class UrlHelper
{
    public static function base(string $route = ''):string {
        return _BASE_HTTP_ . $route;
    }

    public static function public(string $route = ''):string {
        return _BASE_HTTP_ . 'public/' . $route;
    }
    public static function redirect(string $url = '')
    {
        header(sprintf("Location: %s%s", _BASE_HTTP_, $url));
    }
}
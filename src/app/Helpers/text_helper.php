<?php

if (!function_exists('breadcrumb')) {
    function breadcrumb($title, $list=[]) {
        return view("userpage/partials/breadcrumb", compact("title", "list"));
    }
}

if (!function_exists('base_url')) {
    function base_url($str="") {
        return url($str);
    }
}

if (!function_exists('idr')) {
    function idr($num, $prefix="") {
        $format = number_format($num, 0, ",", ".");
        if($prefix) $format = "{$prefix}. {$format}";
        return $format;
    }
}

if (!function_exists('phoneGen')) {
    function phoneGen()
    {
        $a1 = ["081", "082", "083", "085", "087", "089"];
        $a2 = $a1[rand(0, (count($a1) - 1))];
        $a3 = rand(100000000, 999999999);
        return $a2.$a3;
    }
}

if(!function_exists("isJson")) {
    function isJson($string) {
       json_decode($string);
       return json_last_error() === JSON_ERROR_NONE;
    }
}

if(!function_exists("alphanumeric")) {
    function alphanumeric($string) {
       $clean = preg_replace('/\s+/', '', strtolower($string));
       return  preg_replace('/[^0-9a-z\-]/', '', $clean);
    }
}

if(!function_exists("numeric")) {
    function numeric($string) {
       return  preg_replace('/[^0-9]/', '', $string);
    }
}

if(!function_exists("phoneId")) {
    function phoneId($phone) {
        $phone = preg_replace("/[^0-9]/", "", $phone);
        $front = substr($phone, 0, 2);
        if($front!=='62') {
            $phone='62'.substr($phone, 1);
        }
        return $phone;
    }
}

if(!function_exists("phoneCheck")) {
    function phoneIdCheck($phone) {
        $phone = preg_replace("[^0-9]", "", $phone);
        if(strlen($phone) < 10) throw new Exception("Jumlah nomor minimal 10 digit.");
        
        $regex = preg_match("/(^081)|(^082)|(^083)|(^085)|(^087)|(^088)|(^089)/", $phone);
        if(!$regex) throw new Exception("Format nomor telepon: 085xxxx");
        
        return $phone;
    }
}

if(!function_exists("nospace")) {
    function nospace($string) {
       return preg_replace('/\s+/', '', $string);
    }
}

if(!function_exists("str_contains")) {
    function str_contains(string $haystack, string $needle): bool {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

if(!function_exists("inputUsername")) {
	function inputUsername(string $text) {
		return preg_replace('/[^0-9a-z]/', '', strtolower($text));
	}
}

if(!function_exists("inputEmail")) {
	function inputEmail(string $text) {
		return preg_replace('/[^0-9a-z\.\@\-]/', '', strtolower($text));
	}
}

if(!function_exists("inputDate")) {
	function inputDate(string $text) {
		try {
			return \DateTime::createFromFormat("d/m/Y", $text)->format("Y-m-d");
		} catch (\Throwable $e) {
			return null;
		}
	}
}

if(!function_exists("inputPassword")) {
	function inputPassword(string $text) {
		try {
			return password_hash($text, PASSWORD_DEFAULT);
		} catch (Exception $e) {
			return null;
		}
	}
}

if (!function_exists("inputSlug")) {
    function inputSlug(string $text): string {
        // Mengganti semua karakter non-alfanumerik dengan "-"
        $slug = preg_replace("/[^0-9a-zA-Z]/", "-", strtolower($text));
        // Menghilangkan duplikasi "-" menjadi satu saja
        $slug = preg_replace("/-+/", "-", $slug);
        // Menghapus "-" di awal atau akhir slug
        $slug = trim($slug, "-");
        return $slug;
    }
}

if(!function_exists("notnull")) {
    function notnull(&$string) {
       return $string ?? "";
    }
}

if(!function_exists("is_selected")) {
    function is_selected($b) {
       return $b ? "selected=\"\"" : "" ;
    }
}

if(!function_exists("is_checked")) {
    function is_checked($b) {
       return $b ? "checked=\"\"" : "" ;
    }
}

if(!function_exists("vars")) {
    function vars(&$v, ...$keys) {
        try {
            $data = (object) $v;

            foreach ($keys as $key) {
                $data = $data->{$key};
            }

            return $data;
        } catch (\Throwable $th) {
            return '';
        }
    }
}


if(!function_exists("extract_var")) {
    function extract_var(&$v, ...$keys) {
        $v = (object) $v;
        $data = new \stdClass();
        
        try {
            foreach ($keys as $key) {
                $data->{$key} = $v->{$key};
            }
        } catch (\Throwable $th) {
            // skip
        }

        return $data;
    }
}

if(!function_exists("display_date")) {
    function display_date($dateString) {
        // Set locale to Indonesian
        $locale = 'id_ID';
        
        // Create a DateTime object from the input date string
        $date = new DateTime($dateString);
    
        // Create an IntlDateFormatter object
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG, // Date format style (can be changed to FULL, MEDIUM, SHORT)
            IntlDateFormatter::NONE // Time format style (NONE means no time will be formatted)
        );
    
        // Format the date
        return $formatter->format($date);
    }
}

if(!function_exists("display_datetime")) {
    function display_datetime($dateString) {
        // Set locale to Indonesian
        $locale = 'id_ID';
        
        // Create a DateTime object from the input date string
        $date = new DateTime($dateString);
    
        // Create an IntlDateFormatter object for date and time
        $formatter = new IntlDateFormatter(
            $locale,
            IntlDateFormatter::LONG, // Date format style (can be changed to FULL, MEDIUM, SHORT)
            IntlDateFormatter::LONG // Time format style (can be changed to FULL, MEDIUM, SHORT)
        );
    
        // Format the date and time
        return $formatter->format($date);
    }
}

if(!function_exists("faker")) {
    function faker($str1, ...$str2) {
        if($str1=="phoneId") {
            $phone = "081";
            $phone .= rand(111111111, 999999999);
            return $phone;
        }
       $faker = \Faker\Factory::create('id_ID');
       return $faker->{$str1}($str2);
    }
}

function random_string($type = 'alphanumeric', $length = 32) {
    if ($type == 'crypto') {
        // Menggunakan fungsi openssl_random_pseudo_bytes untuk menghasilkan string acak yang aman secara kriptografis
        $bytes = openssl_random_pseudo_bytes($length);
        return bin2hex($bytes); // Mengubah bytes menjadi string heksadesimal
    }

    // Jika jenis bukan 'crypto', maka buat string alphanumeric biasa
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(!function_exists("sitemaper")) {
    function sitemaper() {
        $sitemap = new class {
            protected $urls = [];

            public function addUrl($loc, $lastmod = null, $changefreq = 'weekly', $priority = '0.8')
            {
                $this->urls[] = [
                    'loc' => $loc,
                    'lastmod' => $lastmod,
                    'changefreq' => $changefreq,
                    'priority' => $priority,
                ];
                return $this;
            }

            public function generate()
            {
                $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
                $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

                foreach ($this->urls as $url) {
                    $sitemap .= '<url>';
                    $sitemap .= '<loc>' . e($url['loc']) . '</loc>';
                    if (!empty($url['lastmod'])) {
                        $sitemap .= '<lastmod>' . e($url['lastmod']) . '</lastmod>';
                    }
                    $sitemap .= '<changefreq>' . e($url['changefreq']) . '</changefreq>';
                    $sitemap .= '<priority>' . e($url['priority']) . '</priority>';
                    $sitemap .= '</url>';
                }

                $sitemap .= '</urlset>';
                return $sitemap;
            }
        };
        return $sitemap;
    }
}
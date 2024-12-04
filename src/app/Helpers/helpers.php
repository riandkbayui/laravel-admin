<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

if (!function_exists('service')) {
	/**
	 * Get the service instance dynamically.
	 *
	 * @param string $name
	 * @param mixed ...$params
	 * @return mixed
	 */
	function service(string $name, ...$params) {
		$class = "\\App\\Services\\" . ucfirst($name) . "\\" . ucfirst($name);

		if (!class_exists($class)) {
			throw new InvalidArgumentException("Service [$name] not found.");
		}

		// Bind singleton instance if not already bound
		if (!App::bound($class)) {
			App::singleton($class, function () use ($class, $params) {
				return $params ? new $class(...$params) : new $class();
			});
		}

		// Resolve the instance
		return App::make($class);
	}
}

if (!function_exists('model')) {
	/**
	 * Get the model instance dynamically.
	 *
	 * @param string $name
	 * @return mixed
	 */
	function model(string $name) {
		$class = "\\App\\Models\\" . $name;

		if (!class_exists($class)) {
			throw new InvalidArgumentException("Model [$name] not found.");
		}

		// Bind singleton instance if not already bound
		if (!App::bound($class)) {
			App::singleton($class, function () use ($class) {
				return new $class();
			});
		}

		// Resolve the instance
		return App::make($class);
	}
}

if (!function_exists('helper')) {
	/**
	 * Dynamically load helper files.
	 *
	 * @param array|string $helpers
	 * @return void
	 */
	function helper(...$helpers) {

		foreach ($helpers as $helper) {
			$helperPath = app_path('Helpers/' . strtolower($helper) . '_helper.php');

			if (file_exists($helperPath)) {
				require_once $helperPath;
			} else {
				throw new InvalidArgumentException("Helper file [$helper] not found at $helperPath.");
			}
		}
	}
}

if (!function_exists('lang')) {
	/**
	 * Helper untuk mengambil teks dari file bahasa dengan dukungan placeholder `{0}`, `{1}`, dsb.
	 *
	 * @param string $key Kunci teks dengan format `file.key`.
	 * @param array $params Parameter untuk mengganti placeholder.
	 * @return string Terjemahan yang diproses.
	 */
	function lang(string $key, array $params = []): string
	{
		// Ambil locale saat ini dari konfigurasi Laravel
		$locale = app()->getLocale();

		// Pecah key menjadi file dan teks kunci
		[$file, $textKey] = explode('.', $key, 2);

		// Tentukan path file bahasa berdasarkan locale
		$path = base_path("resources/lang/{$locale}/{$file}.php");

		if (!file_exists($path)) {
			return $key; // Kembalikan kunci jika file tidak ditemukan
		}

		// Muat file bahasa
		$translations = include $path;

		// Ambil teks berdasarkan kunci
		$text = $translations[$textKey] ?? $key;

		// Ubah `{0}`, `{1}`, dsb. menjadi `%s` untuk kompatibilitas `vsprintf`
		$text = preg_replace('/\{\d+\}/', '%s', $text);

		// Ganti placeholder menggunakan `vsprintf`
		if (!empty($params)) {
			$text = vsprintf($text, $params);
		}

		return $text;
	}
}

if (!function_exists('form_error')) {
	function form_error($data) {
		return array_map(function ($error) {
			[$e] = $error;
			return $e;
		}, $data);
	}
}


if (!function_exists('db_connect')) {
	function db_connect() {
		return new class {
			public function transStart() {
				DB::beginTransaction();
			}

			public function rollBack() {
				DB::rollBack();
			}

			public function transComplete() {
				DB::commit();
			}
		};
	}
}



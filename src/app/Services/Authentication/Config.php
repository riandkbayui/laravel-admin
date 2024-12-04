<?php

namespace App\Services\Authentication;
use App\Services\BaseServices;
use Exception;

class Config  extends BaseServices {

	public $MIN_PASSWORD_LENGTH = "8";
	public $VALID_IDENTITY = ['username'];

    public $JWT_SECRET = '457629247F3EA9275B8F6FAFFE7D6';
    public $JWT_ALGO = 'HS256';

    public $COOKIE_NAME = 'X-LARAVEL-SESSION';
    public $COOKIE_AGE_DEFAULT = 86400;
    public $COOKIE_AGE_REMEMBER = 604800;

    public $TOKEN_VALIDITY = 86400;

}
<?php

declare(strict_types=1);

namespace App\Models\Services;

if (PHP_SAPI === 'cli') {
	require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';
	
	echo (new EncryptDecrypt('sD!t3mZnx@216K1&g'))->encrypt('creditCardNumber') . PHP_EOL;
	//def50200b782121ff069ef9b0c7a5a71f8f584a67693276c25b97059e4c7fcf5366f3dc37ac68e9b67938c613f220b866c2c1f58ea83fed0c079cdc978564005b03ec15536fb353ac29fae6e826f3b7e7bfdc2eddc66c2b93441f9261e1faf3f73f8e418
	echo (new EncryptDecrypt('sD!t3mZnx@216K1&g'))->decrypt('def50200b782121ff069ef9b0c7a5a71f8f584a67693276c25b97059e4c7fcf5366f3dc37ac68e9b67938c613f220b866c2c1f58ea83fed0c079cdc978564005b03ec15536fb353ac29fae6e826f3b7e7bfdc2eddc66c2b93441f9261e1faf3f73f8e418') . PHP_EOL;	
}

use Defuse\Crypto\{
	Crypto,
	Exception\WrongKeyOrModifiedCiphertextException,
	Key,
	KeyProtectedByPassword,
};

/*
| You need a password (Get the password from Chris) in order to unlock the key.
| You need a key in order to decrypt/encrypt
|
| echo (new EncryptDecrypt('sD!t3mZnx@216K1&g'))->encrypt('creditCardNumber');
| https://github.com/defuse/php-encryption/blob/master/docs/Tutorial.md
*/
class EncryptDecrypt
{	
	private $password;
	
	function __construct(string $password)
	{
		$this->password = $password;
	}			
	
	function encrypt(string $param): string
	{
		try {
			return Crypto::encrypt($param, $this->_unlockKey());
		} catch (WrongKeyOrModifiedCiphertextException $e) {
			return $e->getMessage();
		}		
	}
	
	function decrypt(string $param): string
	{
		try {
			return Crypto::decrypt($param, $this->_unlockKey());	
		} catch (WrongKeyOrModifiedCiphertextException $e) {
			return $e->getMessage();
		}
	}
	
	private function _unlockKey(): object
	{		
		return KeyProtectedByPassword::loadFromAsciiSafeString($this->_getKey())
			->unlockKey($this->password);
	}
	
	private function _getKey(): string
	{
		$getKey = file_get_contents('/var/www/open');
		if (!$getKey) {
			throw new \Exception('No file found.');
		}
		return $getKey;
	}
}

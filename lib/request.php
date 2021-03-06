<?php  

/**
 * Habbo API
 *
 * Based upon original code by:
 *
 * Copyright (c) 2014 Kedi Agbogre (me@kediagbogre.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

if(!defined('IN_API')) exit;

class Request {
	public static $_params = array();
	public static function param($s) {
		if(empty(self::$_params))
			self::_populate();

		return self::$_params[$s];
	}

	private static function _populate() {
		foreach($_SERVER as $k => $v) {
			if(strpos($k, 'REQUEST_') !== false) {
				self::$_params[
					strtolower(str_replace('REQUEST_', '', $k))
				] = strtolower($v);
			};
		};
	}

	/*public static function protect($s) {
		if(!isset($_SESSION['lastRequest']))
			$_SESSION['lastRequest'] = time();

		$elapsed = (time() - $_SESSION['lastRequest']);

		if($elapsed <= $s) {
			Response::status(429);
			die(Response::json(array(
				'systemError' => 'Cool down a bit!'
			)));
		};
	}*/

	public static function ip() {
		return getenv('REMOTE_ADDR');
	}
}
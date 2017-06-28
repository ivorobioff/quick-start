<?php
namespace ImmediateSolutions\Support\Core\Interfaces;

/**
 * @author Igor Vorobiov <igor.vorobioff@gmail.com>
 */
interface EmailerInterface
{
	/**
	 * @param object $email
	 */
	public function send($email);
}
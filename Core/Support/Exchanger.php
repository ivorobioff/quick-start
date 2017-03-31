<?php
namespace ImmediateSolutions\Support\Core\Support;
use ImmediateSolutions\Support\Validation\Source\ClearableAwareInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class Exchanger
{
	/**
	 * @param object $source
	 * @param object $target
	 * @param string $property
	 * @param callable $modifier
	 */
	public static function transfer($source, $target, $property, callable $modifier = null)
	{
		$accessor = PropertyAccess::createPropertyAccessor();

		$value = $accessor->getValue($source, $property);

		if ($value !== null
			|| ($source instanceof ClearableAwareInterface && $source->isClearable($property))){

			if ($modifier !== null){
				$value = $modifier($value);
			}

			$accessor->setValue($target, $property, $value);
		}
	}
}
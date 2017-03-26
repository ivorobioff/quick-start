<?php
namespace ImmediateSolutions\Support\Infrastructure\Doctrine\Metadata;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
interface DescriberInterface
{
	/**
	 * @param string $package
	 * @return string
	 */
	public function getEntityNamespace($package);

	/**
	 * @param string $package
	 * @return string
	 */
	public function getMetadataNamespace($package);

	/**
	 * @param string $package
	 * @return string
	 */
	public function getEntityPath($package);
}
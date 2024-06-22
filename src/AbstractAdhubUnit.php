<?php

declare(strict_types=1);

namespace AdhubUnit;
/**
 * AbstractAdhubUnit
 */
abstract class AbstractAdhubUnit
{
	/**
	 * @var int|null
	 */
	protected ?int $unitId = null;
	/**
	 * @var int|null
	 */
	protected ?int $siteId = null;
	/**
	 * @var int|null
	 */
	protected ?int $publisherId = null;
	/**
	 * @var string|null
	 */
	protected ?string $visitorIp = null;
	/**
	 * @var string|null
	 */
	protected ?string $userAgent = null;
	/**
	 * @var string|null
	 */
	protected ?string $httpReferer = null;
	/**
	 * Url of ad rotator.
	 *
	 * @var string
	 */
	protected string $rotatorUrl = 'http://adylalahb.ru';

	/**
	 * @param int $unitId
	 *
	 * @return $this
	 */
	public function setUnitId(int $unitId): self
	{
		$this->unitId = $unitId;

		return $this;
	}

	/**
	 * @param int $publisherId
	 *
	 * @return $this
	 */
	public function setPublisherId(int $publisherId): self
	{
		$this->publisherId = $publisherId;

		return $this;
	}

	/**
	 * @param int $siteId
	 *
	 * @return $this
	 */
	public function setSiteId(int $siteId): self
	{
		$this->siteId = $siteId;

		return $this;
	}

	/**
	 * @param string $rotatorUrl
	 *
	 * @return $this
	 */
	public function setRotatorUrl(string $rotatorUrl): self
	{
		$this->rotatorUrl = $rotatorUrl;

		return $this;
	}

	/**
	 * @param string $ip
	 *
	 * @return $this
	 */
	public function setVisitorIp(string $ip): self
	{
		$this->visitorIp = $ip;

		return $this;
	}

	/**
	 * @param string|null $userAgent
	 *
	 * @return $this
	 */
	public function setVisitorUserAgent(?string $userAgent): self
	{
		$this->userAgent = $userAgent;

		return $this;
	}

	/**
	 * @param string|null $httpReferer
	 *
	 * @return $this
	 */
	public function setVisitorHttpReferer(?string $httpReferer): self
	{
		$this->httpReferer = $httpReferer;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public abstract function getJson(): array;
}
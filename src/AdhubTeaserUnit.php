<?php

declare(strict_types=1);

namespace AdhubUnit;

use Exception;

/**
 * AdhubUnit - AdHub smart code. Get ads through API.
 */
class AdhubTeaserUnit
{
	/**
	 * @var int|null
	 */
	private ?int $unitId = null;
	/**
	 * @var int|null
	 */
	private ?int $siteId = null;
	/**
	 * @var int|null
	 */
	private ?int $publisherId = null;
	/**
	 * @var string|null
	 */
	private ?string $visitorIp = null;
	/**
	 * @var string|null
	 */
	private ?string $userAgent = null;
	/**
	 * @var string|null
	 */
	private ?string $httpReferer = null;

	/**
	 * Url of ad rotator.
	 *
	 * @var string
	 */
	private string $rotatorUrl = 'http://adylalahb.ru';

	/**
	 * @param int $unitId
	 *
	 * @return AdhubUnit
	 */
	public function setUnitId(int $unitId): self
	{
		$this->unitId = $unitId;

		return $this;
	}

	/**
	 * @param int $publisherId
	 *
	 * @return void
	 */
	public function setPublisherId(int $publisherId): self
	{
		$this->publisherId = $publisherId;

		return $this;
	}

	/**
	 * @param int $siteId
	 *
	 * @return void
	 */
	public function setSiteId(int $siteId): self
	{
		$this->siteId = $siteId;

		return $this;
	}

	/**
	 * @param string $ip
	 *
	 * @return void
	 */
	public function setVisitorIp(string $ip): self
	{
		$this->visitorIp = $ip;

		return $this;
	}

	/**
	 * @param string $userAgent
	 *
	 * @return $this
	 */
	public function setVisitorUserAgent(string $userAgent): self
	{
		$this->userAgent = $userAgent;

		return $this;
	}

	/**
	 * @param string $httpReferer
	 *
	 * @return $this
	 */
	public function setVisitorHttpReferer(string $httpReferer): self
	{
		$this->httpReferer = $httpReferer;

		return $this;
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function getJson()
	{
		if (empty($this->unitId) || empty($this->siteId) || empty($this->publisherId) || empty($this->visitorIp)) {
			throw new Exception('Fill unitId, siteId, publisherId and visitorIp');
		}

		$url = $this->rotatorUrl . '/teasers-out/' . $this->unitId . '/' . $this->siteId . '/' . $this->publisherId . '/?mode=json'; // &ip=' . $this->visitorIp

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 3);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-Forwarded-For: ' . $this->visitorIp]);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_REFERER, $this->httpReferer);
		curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent);

		$result = curl_exec($curl);
		curl_close($curl);

		return json_decode($result, true);
	}
}

<?php

declare(strict_types=1);

namespace AdhubUnit;

use Exception;

/**
 * AdhubClickunderUnit
 */
class AdhubClickunderUnit extends AbstractAdhubUnit
{
	/**
	 * @return array
	 * @throws Exception
	 */
	public function getJson(): array
	{
		if (empty($this->unitId) || empty($this->siteId) || empty($this->publisherId) || empty($this->visitorIp)) {
			throw new Exception('Fill unitId, siteId, publisherId and visitorIp');
		}

		$url = $this->rotatorUrl . '/clickunder-out/' . $this->unitId . '/' . $this->siteId . '/' . $this->publisherId . '/?mode=json'; // &ip=' . $this->visitorIp

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_TIMEOUT, 3);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-Forwarded-For: ' . $this->visitorIp]);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		if (!empty($this->httpReferer)) {
			curl_setopt($curl, CURLOPT_REFERER, $this->httpReferer);
		}
		if (!empty($this->userAgent)) {
			curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent);
		}

		$result = curl_exec($curl);
		curl_close($curl);

		return json_decode($result, true);
	}
}
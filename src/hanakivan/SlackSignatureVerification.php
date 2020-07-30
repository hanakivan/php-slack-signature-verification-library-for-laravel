<?php

/*
 * (c) Ivan Hanak <packagist@ivanhanak.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace hanakivan;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SlackSignatureVerification {

    const SLACK_REQUEST_SIGNATURE_HEADER = "X-Slack-Signature";
    const SLACK_REQUEST_TIMESTAMP_HEADER = "X-Slack-Request-Timestamp";

    const VERSION_NUMBER = "v0";

    /**
     * @var string
     */
    private $signingSecret;

    public function __construct(string $signingSecret)
    {
        $this->signingSecret = $signingSecret;
    }

    public function verify(Request $request): void
    {
        $timestamp = (int)$request->header(self::SLACK_REQUEST_TIMESTAMP_HEADER);

        $timestampObject = Carbon::createFromTimestamp($timestamp);

        if($timestampObject->isBefore(Carbon::now()->subMinutes(5))) {
            throw new SlackSignatureVerificationException("This seems kinda like an old request.");
        }

        $signatureToCompare = $request->header(self::SLACK_REQUEST_SIGNATURE_HEADER);

        $body = $request->getContent();

        $string = sprintf("%s:%s:%s", self::VERSION_NUMBER, $timestamp, $body);

        $signature = hash_hmac('sha256', $string, $this->signingSecret);
        $fullSignature = sprintf("%s=%s", self::VERSION_NUMBER, $signature);

        /*Log::info("slack signature verify", [
            "arrived" => $signatureToCompare,
            "generated" => $fullSignature,
            "result" => (int)($signatureToCompare === $fullSignature),
        ]);*/

        if($signatureToCompare !== $fullSignature) {
            throw new SlackSignatureVerificationException("Signing signature mismatch.");
        }
    }
}
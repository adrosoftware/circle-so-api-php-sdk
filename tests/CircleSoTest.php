<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests;

use AdroSoftware\CircleSoSdk\CircleSo;
use GuzzleHttp\Psr7\Response;

class CircleSoTest extends TestCase
{
    public function test_circle_so_sdk_instance(): void
    {
        $this->assertInstanceOf(
            CircleSo::class,
            $this->getSdkWithMockedClient()
        );
    }

    public function test_get_me(): void
    {
        $circleSo = $this->getSdkWithMockedClient([
            new Response(200, [], '{"id":1,"email":"adro@example.com","first_name":"Adro","last_name":"Morelos","bio":"","time_zone":"Central Time (US \u0026 Canada)","accepted_terms_at":null,"accepted_privacy_at":null,"admin":null,"prefs":null,"created_at":"2023-01-01T00:00:00.000Z","updated_at":"2023-01-01T00:00:00.000Z","headline":"","posts_count":0,"comments_count":0,"profile_info":{"website":"","location":"","twitter_url":"","facebook_url":"","linkedin_url":"","instagram_url":"","make_my_email_public":"false"},"public_uid":"","affiliate_code":null,"affiliate_ref":null,"password_confirmed_at":"2023-01-01T00:00:00.000Z","password_confirmation_sent_at":null,"password_set_at":"2023-01-01T00:00:00.000Z","checkout_sessions":null,"is_flagged":false,"utm_source":null,"terms_of_service":null,"attachable_sgid":""}'),
        ]);

        $me = $circleSo->me()->get();

        $this->assertArrayHasKey('id', $me);

        $this->assertSame(1, $me['id']);
        $this->assertSame('Adro', $me['first_name']);
    }
}

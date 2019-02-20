<?php

namespace Tests\App\Controller;

use App\Controller\UserRegistrationController;
use App\Domain\Actions\RegisterUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRegistrationControllerTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();
        RegisterUser::$orm = null;
    }

    /** @test */
    public function should_success_when_everything_is_valid()
    {
        $client = static::createClient();

        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass_123123');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
    
    /** @test */
    public function should_returns_a_user_with_the_email_when_everything_is_valid()
    {
        $client = static::createClient();

        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass_123123');

        $this->assertEquals('my@email.com', json_decode($client->getResponse()->getContent(), true)['email']);
    }


    /** @test */
    public function should_returns_a_user_with_the_name_when_everything_is_valid()
    {
        $client = static::createClient();

        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass_123123');

        $this->assertEquals('Codium', json_decode($client->getResponse()->getContent(), true)['name']);
    }
    

    /** @test */
    public function should_fail_when_password_is_short()
    {
        $client = static::createClient();

        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass_1');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('Password is not valid', $client->getResponse()->getContent());
    }
    /** @test */
    public function should_fail_when_password_does_not_contain_underscore()
    {
        $client = static::createClient();

        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass1234');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('Password is not valid', $client->getResponse()->getContent());
    }
    /** @test */
    public function should_fail_when_email_is_used()
    {
        $client = static::createClient();
        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass_1234');

        $client->request('POST', '/users?name=Codium&email=my@email.com&password=myPass_1234');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('The email is already in use', $client->getResponse()->getContent());
    }

//    @Test
//    public void should_generate_a_random_id_when_everything_is_valid() throws Exception {
//    String arguments = "?name=Codium&email=my@email.com&password=myPass_123123";
//        String url = "http://localhost:" + this.port + "/users" + arguments;
//
//        ResponseEntity<User> entity = this.testRestTemplate.postForEntity(url, null, User.class);
//
//        then(entity.getBody().getId()).isNotEqualTo(1);
//    }
}
<?php

class PublicRoutesTest extends TestCase
{
    use InteractsWithDatabase;

    /**
     * The user model.
     *
     * @var App\Models\User
     */
    private $user;

    /**
     * Create the user model test subject.
     *
     * @before
     * @return void
     */
    public function createUser()
    {
        $this->user = factory(App\Models\User::class)->create();
    }

    /** @test */
    public function it_can_access_the_blog_index_page()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function it_can_access_a_blog_post_page()
    {
        $response = $this->call('GET', '/blog/hello-world');
        $this->assertEquals(200, $response->status());
        $this->see('Hello World');
    }

    /** @test */
    public function it_can_access_a_blog_tag_page()
    {
        $response = $this->call('GET', '/blog?tag=Getting+Started');
        $this->assertEquals(200, $response->status());
        $this->see('GETTING STARTED WITH CANVAS');
    }

    /** @test */
    public function it_can_access_the_login_page()
    {
        $response = $this->call('GET', '/admin');
        $this->assertEquals(200, $response->status());
    }

    /** @test */
    public function it_can_access_the_forgot_password_page()
    {
        $this->visit('admin')->click('Forgot my password')->seePageIs('password/forgot');
    }

    /** @test */
    public function it_will_receive_a_404_error_if_a_page_is_not_found()
    {
        $response = $this->call('GET', '/404ErrorPage');
        $this->assertEquals(404, $response->status());
    }
}

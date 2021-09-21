<?php

namespace Tests\Feature;

use Tests\CreatesUser;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    use CreatesUser;

    public function test_authenticated_user_navigate_to_home_page()
    {
        $this->actingAs($this->user)->get("/")->assertStatus(200);
    }

    public function test_authenticated_user_navigate_to_user_but_doesnt_have_permission()
    {
        $this->actingAs($this->user)->get("/user")->assertStatus(403);
    }

    public function test_authenticated_user_navigate_to_role_but_doesnt_have_permission()
    {
        $this->actingAs($this->user)->get("/role")->assertStatus(403);
    }
    
    public function test_authenticated_user_navigate_to_permission_but_doesnt_have_permission()
    {
        $this->actingAs($this->user)->get('/permission')->assertStatus(403);
    }
    public function test_authenticated_user_navigate_to_log_but_doesnt_have_permission()
    {
        $this->actingAs($this->user)->get('/log')->assertStatus(403);
    }
    public function test_authenticated_user_navigate_to_domain_but_doesnt_have_permission()
    {
        $this->actingAs($this->user)->get('/domain')->assertStatus(403);
    }
}

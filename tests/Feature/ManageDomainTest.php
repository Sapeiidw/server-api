<?php

namespace Tests\Feature;

use App\Models\Domain;
use Tests\CreatesUser;
use Tests\TestCase;

class ManageDomainTest extends TestCase
{
    use CreatesUser;

    public function read_domain($user)
    {
        return $this->actingAs($user)->get(route('domain.index'));
    }
    public function test_can_not_read_domain_as_user()
    {
        $this->read_domain($this->user)->assertStatus(403);
    }
    public function test_can_not_read_domain_as_admin()
    {
        $this->read_domain($this->admin)->assertStatus(403);
    }
    public function test_can_read_domain_as_super_admin()
    {
        $this->read_domain($this->super_admin)->assertStatus(200);
    }
    
    public function create_domain($user)
    {
        return $this->actingAs($user)->post(route('domain.store'), [
            'name' => 'domain.com',
            ]);
    }

    public function test_can_not_create_domain_as_user()
    {
        $this->create_domain($this->user)->assertStatus(403);
    }

    public function test_can_not_create_domain_as_admin()
    {
        $this->create_domain($this->admin)->assertStatus(403);
    }
    
    public function test_can_create_domain_as_super_admin()
    {
        $this->create_domain($this->super_admin)->assertStatus(302);
    }

    public function update_domain($user)
    {
        $domain = Domain::create(['name'=>'role']);
        return $this->actingAs($user)->put(route('domain.update',$domain->id), [
            'name' => 'domain.update.com',
            ]);
    }

    public function test_can_update_domain_as_super_admin()
    {
        $this->update_domain($this->super_admin)->assertStatus(302);
    }

    public function test_can_not_update_domain_because_not_as_a_super_admin()
    {
        $this->update_domain($this->admin)->assertStatus(403);
    }

    public function delete_domain($user) 
    {
        $domain = Domain::create(['name'=>'domain.test']);
        return $this->actingAs($user)->delete(route('domain.destroy',$domain->id));
    }

    public function test_can_delete_domain_as_super_admin()
    {
        $this->delete_domain($this->super_admin)->assertStatus(302);
    }
    
    public function test_can_not_delete_domain_because_not_as_super_admin()
    {
        $this->delete_domain($this->user)->assertStatus(403);
    }
}

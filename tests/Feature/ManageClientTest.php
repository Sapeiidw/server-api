<?php

namespace Tests\Feature;

use App\Models\Client;
use Tests\TestCase;
use Tests\CreatesUser;
use Illuminate\Support\Str;

class ManageClientTest extends TestCase
{
    use CreatesUser;

    public function read_client($user)
    {
        return $this->actingAs($user)->get(route('client.index'));
    }
    public function test_can_not_read_client_as_user()
    {
        $this->read_client($this->user)->assertStatus(403);
    }
    public function test_can_read_client_as_admin()
    {
        $this->read_client($this->admin)->assertStatus(200);
    }
    public function test_can_read_client_as_super_admin()
    {
        $this->read_client($this->super_admin)->assertStatus(200);
    }
    
    public function create_client($user)
    {
        return $this->actingAs($user)->post(route('client.store'), [
            'name' => 'Client',
            'redirect' => 'http://client.test/redirect',
            'url' => 'http://client.test/callback',
            'thumbnail' => '',
            'visibility' => 'public',
            'user_id'=> $user->id,
            ]);
    }

    public function test_can_not_create_client_as_user()
    {
        $this->create_client($this->user)->assertStatus(403);
    }

    public function test_can_create_client_as_admin()
    {
        $this->create_client($this->admin)->assertStatus(302);
    }
    
    public function test_can_create_client_as_super_admin()
    {
        $this->create_client($this->super_admin)->assertStatus(302);
    }

    public function update_client($user)
    {
        $client = Client::create([
            'user_id' => $user->id,
            'name'=> 'Client',
            'secret' => Str::random(50),
            'slug'=> Str::slug('Client'),
            'redirect'=> 'http://client.test/callback',
            'url'=> 'http://client.test/redirect',
            'thumbnail'=> '',
            'visibility' => 'public',
            "provider" => false,
            "personal_access_client" => false,
            "password_client" => false,
            "revoked" => false,
            ]);
        return $this->actingAs($user)->put(route('client.update',$client->id), [
            'name' => 'Client Update',
            'redirect' => 'http://client.update.test/calback',
            'url' => 'http://client.update.test/redirect',
            'thumbnail' => '',
            'visibility' => 'private',
            ]);
    }

    public function test_can_update_client_as_super_admin()
    {
        $this->update_client($this->super_admin)->assertStatus(302);
    }

    public function test_can_update_client_as_admin()
    {
        $this->update_client($this->admin)->assertStatus(302);
    }

    public function test_can_not_update_client_as_user()
    {
        $this->update_client($this->user)->assertStatus(403);
    }

    public function delete_client($user) 
    {
        $client = Client::create([
            'user_id' => $user->id,
            'name'=> 'Client',
            'secret' => Str::random(50),
            'slug'=> Str::slug('Client'),
            'redirect'=> 'http://client.test/callback',
            'url'=> 'http://client.test/redirect',
            'thumbnail'=> '',
            'visibility' => 'public',
            "provider" => false,
            "personal_access_client" => false,
            "password_client" => false,
            "revoked" => false,
            ]);
        return $this->actingAs($user)->delete(route('client.destroy',$client->id));
    }

    public function test_can_delete_client_as_super_admin()
    {
        $this->delete_client($this->super_admin)->assertStatus(302);
    }

    public function test_can_delete_client_as_admin()
    {
        $this->delete_client($this->admin)->assertStatus(302);
    }
    
    public function test_can_not_delete_client_as_user()
    {
        $this->delete_client($this->user)->assertStatus(403);
    }
}

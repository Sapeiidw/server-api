<?php

namespace Tests\Feature;

use Spatie\Activitylog\Models\Activity;
use Tests\CreatesUser;
use Tests\TestCase;

class ManageLogTest extends TestCase
{
    use CreatesUser;

    public function read_log($user)
    {
        return $this->actingAs($user)->get(route('log.index'));
    }
    public function test_can_not_read_log_as_user()
    {
        $this->read_log($this->user)->assertStatus(403);
    }
    public function test_can_read_log_as_admin()
    {
        $this->read_log($this->admin)->assertStatus(200);
    }
    public function test_can_read_log_as_super_admin()
    {
        $this->read_log($this->super_admin)->assertStatus(200);
    }
    
    public function delete_log($user) 
    {
        activity()->log('test log');
        $log = Activity::get()->last();
        return $this->actingAs($user)->delete(route('log.destroy',$log->id));
    }

    public function test_can_delete_log_as_super_admin()
    {
        $this->delete_log($this->super_admin)->assertStatus(302);
    }
    
    public function test_can_not_delete_log_because_not_as_super_admin()
    {
        $this->delete_log($this->user)->assertStatus(403);
    }
}

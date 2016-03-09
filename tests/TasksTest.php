<?php

use App\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TasksTest extends TestCase
{
    use DatabaseMigrations;

    public function test_tasks_page_renders()
    {
        $user = $this->getUser();

        $this->actingAs($user)
            ->visit('/tasks')
            ->seePageIs('/tasks')
            ->see('My Tasks')
            ->see('New Task')
            ->see('Add');
    }

    public function test_user_can_add_a_task()
    {
        $user = $this->getUser();
        $taskText = 'Foo Bar';

        $this->actingAs($user)
            ->visit('/tasks')
            ->type($taskText, 'task')
            ->press('Add');

        $this->seeInDatabase('tasks', [
            'user_id' => $user->id,
            'task' => $taskText,
            'completed_at' => null
        ]);
    }

    public function test_user_can_delete_a_task()
    {
        $user = $this->getUser();
        $taskText = 'Foo Bar';

        $user->tasks()->create([
            'task' => $taskText,
        ]);

        $this->actingAs($user)
            ->visit('tasks')
            ->press('Delete');

        $this->dontSeeInDatabase('tasks', [
            'user_id' => $user->id,
            'task' => $taskText,
        ]);
    }

    public function test_user_can_mark_a_task_as_done()
    {
        $user = $this->getUser();
        $taskText = 'Foo Bar';

        $user->tasks()->create([
            'task' => $taskText,
        ]);

        $this->actingAs($user)
            ->visit('tasks')
            ->see($taskText)
            ->press('Mark as Done');

        $task = $user->tasks()
            ->where('task', $taskText)
            ->whereNotNull('completed_at');

        $this->assertNotNull($task);
    }

    public function test_user_can_unmark_a_task_as_done()
    {
        $user = $this->getUser();
        $taskText = 'Foo Bar';

        $user->tasks()->create([
            'task' => $taskText,
            'completed_at' => Carbon::now(),
        ]);

        $this->actingAs($user)
            ->visit('tasks')
            ->see($taskText)
            ->press('Unmark as Done');

        $this->seeInDatabase('tasks', [
            'user_id' => $user->id,
            'task' => $taskText,
            'completed_at' => null
        ]);
    }
}

# :toilet: From Creecros's Filter Pack

### :nail_care: Task Subtask Assignee Filter

- Use `task_subtask_assignee:name` to filter for both tasks and subtasks assigned to `name`, add `status:open` at the end to exclude closed tasks.
- Use `due_with_null:<today`, or whatever date to filter for tasks corresponding to the search criteria, including tasks which do not have a due date.

### :paperclip: Chainable Subtask Assignee Filter

- Use `subtask_assignee:name` to filter subtasks assigned to `name`, chainable to other filters.

### :japanese_ogre: Subtask Status Filter

- Use `subtask:status:DONE` or `subtask:status:2` to filter for subtasks that are `DONE`
- Use `subtask:status:TODO` or `subtask:status:0` to filter for subtasks that are `TODO`
- Use `subtask:status:INPROGRESS` or `subtask:status:1` to filter for subtasks that are `INPROGRESS`
- Use `subtask:status:RUNNING` to filter for subtasks that are `RUNNING`, regardless of `STATUS`

### :family: Combinable

Example:
- `task_subtask_assignee:name subtask:status:RUNNING status:open`


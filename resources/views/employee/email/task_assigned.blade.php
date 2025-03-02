<!DOCTYPE html>
<html>
<head>
    <title>New Task Assigned</title>
</head>
<body>
    <p>Dear {{ $employee->name }},</p>

    <p>You have been assigned a new task.</p>
    
    <p><strong>Task Details:</strong></p>
    <ul>
        <li><strong>Title:</strong> {{ $task->title }}</li>
        <li><strong>Description:</strong> {{ $task->content }}</li>
        <li><strong>Deadline:</strong> {{ $task->deadline }}</li>
    </ul>

    <p>Please complete the task before the deadline.</p>

    <p>Best Regards,<br>Admin Team</p>
</body>
</html>

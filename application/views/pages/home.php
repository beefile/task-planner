<?php $active = 'home'; // or 'task', 'progress', etc. ?>
<?php include(APPPATH . 'views/templates/sidebar.php'); ?>

<style>
    .dashboard-container {
        padding: 2rem;
        background-color: #F8F8F9;
    }

    .card {
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); 
        margin-bottom: 2rem;
        background-color: #fff;
    }

    .hello-card {
        background-color: #fff;
        padding: 2rem;
    }

    .hello-card h1 {
        color: #333;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .hello-card .username-highlight {
        color: #D4536C;
    }

    .hello-card p {
        color: #777;
        margin-bottom: 0;
    }


    .schedule-card, .progress-card {
        padding: 2rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .card-title i {
        margin-right: 0.75rem;
        color: #D4536C; 
    }

    .calendar-nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .calendar-nav .nav-arrow {
        font-size: 1.5rem;
        color: #555;
        cursor: pointer;
        transition: color 0.2s;
        user-select: none;
    }

    .calendar-nav .nav-arrow:hover {
        color: #D4536C;
    }

    .calendar-days {
        display: flex;
        justify-content: space-around;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .calendar-day {
        text-align: center;
        padding: 0.75rem 0.5rem;
        border-radius: 0.75rem;
        cursor: pointer;
        font-weight: 500;
        min-width: 45px;
        transition: background-color 0.2s, color 0.2s;
    }

    .calendar-day.active {
        background-color: #D4536C;
        color: #fff;
    }

    .calendar-day:not(.active):hover {
        background-color: #FEA4AA;
        color: #D4536C;
    }

    .calendar-day span {
        display: block;
        font-size: 0.85rem;
    }

    .calendar-day strong {
        display: block;
        font-size: 1.2rem;
    }

    .task-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #eee;
    }

    .task-item:last-child {
        border-bottom: none;
    }

    /* Custom Checkbox Container */
    .task-checkbox-container { 
        position: relative;
        margin-right: 1rem;
        flex-shrink: 0;
        cursor: pointer;
        user-select: none;
        padding-top: 4px; 
        display: inline-block; 
    }

    .task-checkbox-container input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #D4536C;
        border-radius: 50%;
        transition: all 0.2s;
    }

    .task-checkbox-container input:checked ~ .checkmark {
        background-color: #D4536C;
        border-color: #D4536C;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .task-checkbox-container input:checked ~ .checkmark:after {
        display: block;
    }

    .task-checkbox-container .checkmark:after {
        left: 6.5px;
        top: 3.5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    /* Clickable Task Link Area */
    .task-link-area {
        flex-grow: 1; /* Takes up remaining space */
        text-decoration: none; /* Remove default underline */
        color: inherit; /* Inherit text color from parent */
        display: block; /* Make it block level to take full width */
        cursor: pointer;
        transition: color 0.2s;
    }

    .task-link-area:hover .task-details h6 {
        color: #D4536C; /* Highlight task title on hover */
    }

    /* Task Details styling (inside task-link-area) */
    .task-details {
        flex-grow: 1;
    }

    .task-item.completed .task-details h6 { /* Style based on parent .task-item.completed class */
        text-decoration: line-through;
        color: #aaa;
    }

    .task-details h6 {
        margin: 0;
        font-size: 1rem;
        color: #333;
        font-weight: 500;
        transition: color 0.2s, text-decoration 0.2s; /* Smooth transition for completion */
    }

    .task-details p {
        margin: 0;
        font-size: 0.85rem;
        color: #777;
    }
    .task-details .category-tag {
        display: inline-block;
        font-size: 0.75rem;
        padding: 0.2em 0.6em;
        border-radius: 0.5em;
        margin-left: 0.5em;
        font-weight: 600;
        color: #fff;
    }
    .category-important { background-color: #D4536C; } /* Primary color */
    .category-work { background-color: #6C63FF; } /* A bluish purple */
    .category-personal { background-color: #28A745; } /* Green */
    .category-n-a { background-color: #999; } /* Fallback for 'Not Applicable' */


    /* Create Task Button */
    .create-task-btn {
        background-color: #D4536C;
        color: #fff;
        border-radius: 1rem; /* More rounded */
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.2s;
        text-decoration: none; /* Remove underline */
        width: 100%; /* Full width */
        margin-top: 1.5rem;
        cursor: pointer;
    }

    .create-task-btn:hover {
        background-color: #FEA4AA; /* Lighter hover */
        color: #D4536C;
    }

    /* New Task Input Form */
    .new-task-form {
        margin-top: 1rem;
        display: none; /* Hidden by default */
        padding: 1rem;
        border-radius: 1rem;
        background-color: #f8f8f9; /* Lighter background for the form */
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
    }

    .new-task-form.show {
        display: block;
    }

    .new-task-form .form-group {
        margin-bottom: 0.75rem;
    }
    .new-task-form .form-group label {
        display: block;
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 0.25rem;
    }

    .new-task-form input[type="text"],
    .new-task-form input[type="date"],
    .new-task-form select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        background-color: #fff;
        -webkit-appearance: none; /* Remove default arrow for select */
        -moz-appearance: none;
        appearance: none;
    }
    .new-task-form select {
        padding-right: 2.5rem; /* Space for custom arrow */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23777777' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
    }


    .new-task-form .form-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    .new-task-form .form-actions button {
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        font-weight: 500;
        border: 1px solid #ddd; /* Default border for all buttons */
        transition: background-color 0.2s, color 0.2s, border-color 0.2s;
    }

    .new-task-form .form-actions .btn-cancel {
        background-color: #eee;
        color: #555;
    }
    .new-task-form .form-actions .btn-cancel:hover {
        background-color: #ddd;
    }

    .new-task-form .form-actions .btn-add {
        background-color: #D4536C;
        color: #fff;
        border-color: #D4536C;
    }
    .new-task-form .form-actions .btn-add:hover {
        background-color: #FEA4AA;
        color: #D4536C;
        border-color: #FEA4AA;
    }

    /* Task Summary Boxes - Now side-by-side */
    .task-summary-boxes {
        display: flex;
        gap: 1.5rem; /* Space between the boxes */
        margin-bottom: 2rem;
        flex-wrap: wrap; /* Allow wrapping on smaller screens */
    }

    .task-summary-box {
        flex: 1; /* Allow boxes to grow and shrink */
        min-width: 150px; /* Minimum width to prevent crushing */
        background-color: #D4536C; /* Theme color background */
        color: #fff;
        text-align: center;
        padding: 1.2rem 1rem; /* Slightly reduced padding */
        border-radius: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 120px;
    }
    .task-summary-box.overall-tasks {
        background-color: #FEA4AA; /* Lighter theme color for overall tasks */
        color: #D4536C; /* Darker text for contrast */
    }
    .task-summary-box h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
        line-height: 1;
    }
    .task-summary-box p {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
        font-weight: 500;
    }

    /* Welcome message / "Search Bar" replacement */
    .welcome-message-box {
        background-color: #fff; /* Card background */
        border-radius: 1.5rem; /* Match card radius */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); /* Match card shadow */
        padding: 1rem 2rem; /* Reduced vertical padding */
        margin-bottom: 2rem; /* Space below it */
        text-align: center; /* Center content */
        display: flex; /* Use flexbox for vertical alignment */
        align-items: center; /* Center content vertically */
        justify-content: center; /* Center content horizontally */
        min-height: 70px; /* Set a minimum height to make it more compact */
    }

    .welcome-message-box p {
        color: #777;
        margin: 0; /* Remove default margins to ensure single line */
        font-size: 1rem; /* Slightly larger font for single line */
        font-weight: 500;
    }

    /* Progress Chart */
    .progress-card {
        margin-top: 0; /* Adjust spacing since summary boxes are now separate */
    }

    .progress-chart-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px; /* Fixed height for the chart area */
        position: relative;
        margin-bottom: 1.5rem;
    }

    .progress-chart-circle {
        width: 150px; /* Size of the donut chart placeholder */
        height: 150px;
        border-radius: 50%;
        background: conic-gradient(
            #D4536C 0% 40%, /* Pending */
            #6C63FF 40% 72%, /* In Progress - using a new color for contrast, you can adjust */
            #28A745 72% 100% /* Completed - using a new color for contrast, you can adjust */
        );
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .progress-chart-inner-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #fff;
    }
    .progress-legend {
        display: flex;
        justify-content: center;
        flex-wrap: wrap; /* Allow wrapping on smaller screens */
        gap: 1.5rem;
        margin-top: 1rem;
    }
    .legend-item {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        color: #555;
    }
    .legend-color {
        width: 15px;
        height: 15px;
        border-radius: 3px;
        margin-right: 0.5rem;
    }
    .legend-color.pending { background-color: #D4536C; }
    .legend-color.in-progress { background-color: #6C63FF; } /* Matches chart */
    .legend-color.completed { background-color: #28A745; } /* Matches chart */

    .view-tasks-btn {
        background-color: #F8F8F9; /* Light background */
        color: #D4536C; /* Theme color text */
        border: 1px solid #D4536C; /* Border with theme color */
        border-radius: 0.75rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
    }
    .view-tasks-btn:hover {
        background-color: #D4536C;
        color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) { /* Medium devices and below */
        .calendar-days {
            flex-wrap: wrap; /* Allow days to wrap */
            justify-content: space-around;
        }
        .calendar-day {
            min-width: unset;
            flex: 1 0 12%; /* Roughly 7 days per row on small screens */
            margin: 0.2rem;
        }
        .task-summary-box {
            min-height: 100px; /* Adjust height for smaller screens */
        }
        .task-summary-box h3 {
            font-size: 2rem;
        }
        .task-summary-box p {
            font-size: 0.9rem;
        }
        .task-summary-boxes {
            flex-direction: column; /* Stack on smaller screens if needed, or keep wrap */
            gap: 1rem;
        }
        .welcome-message-box {
            min-height: 60px; /* Even smaller on medium screens */
            padding: 0.8rem 1.5rem;
        }
    }

    @media (max-width: 767.98px) { /* Small devices and below */
        .dashboard-container {
            padding: 1rem;
        }
        .card {
            margin-bottom: 1.5rem;
            border-radius: 1rem;
        }
        .hello-card {
            padding: 1.5rem;
        }
        .hello-card h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .hello-card p {
            font-size: 0.9rem;
        }

        .card-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }
        .calendar-days {
            gap: 0.25rem;
        }
        .calendar-day {
            padding: 0.5rem 0.2rem;
            flex: 1 0 13%; /* Adjust for 7 days */
        }
        .calendar-day strong {
            font-size: 1rem;
        }
        .task-item {
            margin-bottom: 0.75rem;
        }
        .create-task-btn {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
        .progress-chart-wrapper {
            height: 150px;
        }
        .progress-chart-circle {
            width: 120px;
            height: 120px;
        }
        .progress-chart-inner-circle {
            width: 80px;
            height: 80px;
        }
        .progress-legend {
            gap: 0.75rem;
            font-size: 0.8rem;
        }
        .task-summary-boxes .col-6 {
            padding-left: 0.5rem; /* Reduce gutter */
            padding-right: 0.5rem; /* Reduce gutter */
        }
        .task-summary-box {
            padding: 1rem 0.8rem; /* Further adjust padding */
            min-height: 90px;
        }
        .task-summary-box h3 {
            font-size: 1.8rem;
        }
        .task-summary-box p {
            font-size: 0.8rem;
        }
        .welcome-message-box {
            min-height: 50px; /* Even smaller on small screens */
            padding: 0.5rem 1rem;
        }
    }
    canvas#taskStatusBarChart {
    display: block !important;
    width: 100% !important;
    height: auto !important;
}

</style>

<div class="content-wrapper dashboard-container">
    <div class="row">
        <div class="col-lg-7">
            <div class="card hello-card">
                <div class="text-left">
                    <h1>Hello, <span class="username-highlight"><?= isset($user->first_name) ? htmlspecialchars($user->first_name) : 'User' ?></span>!</h1>
                    <p>What are your plans for today?</p>
                </div>
            </div>

            <div class="card schedule-card">
                <h2 class="card-title"><i class="bi bi-calendar2-event"></i> Today's Schedule</h2>

                <div class="calendar-nav">
                    <span class="nav-arrow" id="prevWeekBtn"><i class="bi bi-chevron-left"></i></span>
                    <div class="calendar-days" id="calendarDaysContainer"></div>
                    <span class="nav-arrow" id="nextWeekBtn"><i class="bi bi-chevron-right"></i></span>
                </div>

                <div class="daily-tasks-list" id="dailyTasksList">
                    <?php if (!empty($today_tasks)) : ?>
                        <?php foreach ($today_tasks as $task) : ?>
                            <?php
                                // PHP category map - no 'Other' here
                                $categoryMap = [
                                    1 => ['label' => 'Important', 'class' => 'important'],
                                    2 => ['label' => 'Work', 'class' => 'work'],
                                    3 => ['label' => 'Personal', 'class' => 'personal'],
                                ];
                                // Fallback to 'N/A' if category_id is not 1, 2, or 3
                                $category = $categoryMap[$task['category_id']] ?? ['label' => 'N/A', 'class' => 'n-a'];
                                $completed = ($task['status'] === 'completed');
                                $formattedDate = date("F j, Y", strtotime($task['due_date']));
                            ?>
                            <div class="task-item <?= $completed ? 'completed' : '' ?>" data-task-id="<?= $task['id'] ?>">
                                <label class="task-checkbox-container">
                                    <input type="checkbox" <?= $completed ? 'checked' : '' ?>>
                                    <span class="checkmark"></span>
                                </label>
                                <div class="task-details">
                                    <h6><?= htmlspecialchars($task['title']) ?>
                                        <?php if ($category): ?>
                                            <span class="category-tag category-<?= $category['class'] ?>"><?= $category['label'] ?></span>
                                        <?php endif; ?>
                                    </h6>
                                    <p>Due: <?= $formattedDate ?></p>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No tasks due today.</p>
                    <?php endif; ?>
                </div>

                <button class="create-task-btn" id="toggleNewTaskForm">
                    <i class="bi bi-plus-circle"></i> Create New Task
                </button>

            <div class="new-task-form" id="newTaskForm">
                <div class="form-group">
                    <label for="newTaskInput">Task Description</label>
                    <input type="text" id="newTaskInput" placeholder="e.g., Finish project report" required>
                </div>
                <div class="form-group">
                    <label for="newDueDate">Due Date</label>
                    <input type="date" id="newDueDate" min="<?= date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="newCategory">Category</label>
                    <select id="newCategory">
                        <option value="">Select Category</option>
                        <option value="important">Important</option>
                        <option value="work">Work</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" id="cancelNewTask">Cancel</button>
                    <button type="button" class="btn btn-add" id="addNewTask">Add Task</button>
                </div>
            </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="welcome-message-box">
                <p>Stay organized and conquer your day!</p>
            </div>

            <div class="task-summary-boxes">
                <div class="task-summary-box">
                    <h3 id="tasksDoneCount"><?= $completed_tasks_count ?? 0 ?></h3>
                    <p>Tasks Done</p>
                </div>
                <div class="task-summary-box overall-tasks">
                    <h3 id="tasksOverallCount"><?= $overall_tasks_count ?? 0 ?></h3>
                    <p>Overall Tasks</p>
                </div>
            </div>

 <div class="card progress-card">
    <h2 class="card-title"><i class="bi bi-bar-chart-line"></i> Your Progress</h2>
    <p class="text-muted mb-3">Showing task stats as of <?= date('F j, Y') ?></p>

    <div class="progress-chart-wrapper">
        <canvas id="taskStatusBarChart" width="400" height="250"></canvas>
    </div>

    <div class="progress-legend">
        <div class="legend-item">
            <div class="legend-color pending"></div> Pending
            <span class="ms-1"><?= $percent_pending ?>%</span>
        </div>
        <div class="legend-item">
            <div class="legend-color in-progress"></div> In Progress
            <span class="ms-1"><?= $percent_in_progress ?>%</span>
        </div>
        <div class="legend-item">
            <div class="legend-color completed"></div> Completed
            <span class="ms-1"><?= $percent_completed ?>%</span>
        </div>
    </div>

    <div class="text-end mt-4">
        <a href="<?= base_url('progress') ?>" class="view-tasks-btn">View Tasks</a>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Live Calendar Functionality ---
        const calendarDaysContainer = document.getElementById('calendarDaysContainer');
        const prevWeekBtn = document.getElementById('prevWeekBtn');
        const nextWeekBtn = document.getElementById('nextWeekBtn');

        let currentDate = new Date(); // Start with today's date
        const todayGlobal = new Date(); // Store today's date for persistent highlighting

        function renderCalendarDays(date) {
            calendarDaysContainer.innerHTML = ''; // Clear existing days

            const startOfWeek = new Date(date);
            startOfWeek.setDate(date.getDate() - date.getDay()); // Go to Sunday of the current week

            const dayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

            for (let i = 0; i < 7; i++) {
                const day = new Date(startOfWeek);
                day.setDate(startOfWeek.getDate() + i);

                const dayElement = document.createElement('div');
                dayElement.classList.add('calendar-day');

                // Check if this day is the globally 'today'
                if (day.toDateString() === todayGlobal.toDateString()) {
                    dayElement.classList.add('active'); // Add active class for today
                }

                dayElement.innerHTML = `<span>${dayNames[day.getDay()]}</span><strong>${day.getDate()}</strong>`;
                dayElement.dataset.date = day.toISOString().split('T')[0]; // Store full date for later use

                // Add click listener to each day (for future task loading)
                dayElement.addEventListener('click', function() {
                    document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('active'));
                    this.classList.add('active');
                    // In a real app, you'd fetch and display tasks for this.dataset.date
                    console.log('Clicked date:', this.dataset.date);
                });

                calendarDaysContainer.appendChild(dayElement);
            }
        }

        // Event listeners for calendar navigation
        prevWeekBtn.addEventListener('click', function() {
            currentDate.setDate(currentDate.getDate() - 7);
            renderCalendarDays(currentDate);
        });

        nextWeekBtn.addEventListener('click', function() {
            currentDate.setDate(currentDate.getDate() + 7);
            renderCalendarDays(currentDate);
        });

        // Initial render of calendar
        renderCalendarDays(currentDate);

        // --- Task Checkbox and Clickable Task Functionality ---
        const dailyTasksList = document.getElementById('dailyTasksList');
        const tasksDoneCountElement = document.getElementById('tasksDoneCount');
        const tasksOverallCountElement = document.getElementById('tasksOverallCount');

        // This function updates the counts displayed on the dashboard
        // It relies on the *initial* PHP-rendered counts for global numbers
        // and updates the local daily list counts dynamically.
        // For truly real-time global counts, an additional AJAX call on task status change would be needed.
        function updateTaskCounts() {
            let completedToday = 0;
            let totalToday = 0;

            document.querySelectorAll('#dailyTasksList .task-item').forEach(item => {
                totalToday++;
                const checkbox = item.querySelector('.task-checkbox-container input[type="checkbox"]');
                if (checkbox && checkbox.checked) {
                    completedToday++;
                }
            });
            // These elements are meant to show GLOBAL counts, which are initially populated by PHP.
            // If you want them to update when a *daily* task is marked complete/incomplete,
            // you'd need an AJAX call to refresh the global counts from the backend,
            // or perform a simple increment/decrement if you're certain it's a global task.
            // For now, these summary boxes will remain as initially loaded from PHP for global counts,
            // and the `updateTaskCounts` function primarily ensures correct display for *daily* tasks.
        }


        dailyTasksList.addEventListener('change', function(event) {
            if (event.target.matches('.task-checkbox-container input[type="checkbox"]')) {
                event.stopPropagation(); // Stop propagation to prevent the parent <a> from being clicked

                const taskItem = event.target.closest('.task-item');
                const taskId = taskItem.dataset.taskId;
                const isCompleted = event.target.checked;
                const newStatus = isCompleted ? 'completed' : 'pending';

                fetch(`<?= base_url('task/update_status/') ?>${taskId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest' // Important for CodeIgniter's is_ajax_request()
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        if (isCompleted) {
                            taskItem.classList.add('completed');
                        } else {
                            taskItem.classList.remove('completed');
                        }
                        // Optionally, if you want to update global counts here, make another fetch:
                        // fetch('<?= base_url('task/get_global_counts') ?>')
                        // .then(res => res.json())
                        // .then(counts => {
                        //     tasksDoneCountElement.textContent = counts.completed;
                        //     tasksOverallCountElement.textContent = counts.total;
                        // });
                        // For now, only local display change and local updateTaskCounts is sufficient for "Today's Schedule"
                        updateTaskCounts(); // Update local counts based on today's tasks
                    } else {
                        console.error('Failed to update task status:', data.message);
                        alert('Failed to update task status: ' + data.message);
                        // Revert checkbox state if update fails
                        event.target.checked = !isCompleted;
                    }
                })
                .catch(error => {
                    console.error('Error updating task status:', error);
                    alert('Error updating task status. Please try again.');
                    // Revert checkbox state if network error
                    event.target.checked = !isCompleted;
                });
            }
        });

        // Initial count of currently displayed tasks (though the summary boxes are PHP-driven for global counts)
        updateTaskCounts();

 // --- Create New Task Inline Form ---
    const toggleNewTaskFormBtn = document.getElementById('toggleNewTaskForm');
    const newTaskForm = document.getElementById('newTaskForm');
    const newTaskInput = document.getElementById('newTaskInput');
    const newDueDateInput = document.getElementById('newDueDate'); // Get reference to the date input
    const newCategorySelect = document.getElementById('newCategory');
    const addNewTaskBtn = document.getElementById('addNewTask');
    const cancelNewTaskBtn = document.getElementById('cancelNewTask');

    toggleNewTaskFormBtn.addEventListener('click', function() {
        newTaskForm.classList.toggle('show');
        if (newTaskForm.classList.contains('show')) {
            newTaskInput.focus(); // Focus on the input when shown

            // Set the minimum date for the date picker to today's date
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
            const day = String(today.getDate()).padStart(2, '0');
            const todayFormatted = `${year}-${month}-${day}`;

            newDueDateInput.value = todayFormatted; // Set default due date to today
            newDueDateInput.setAttribute('min', todayFormatted); // *** THIS IS THE CRUCIAL LINE ***
        }
    });

    cancelNewTaskBtn.addEventListener('click', function() {
        newTaskForm.classList.remove('show');
        newTaskInput.value = ''; // Clear input on cancel
        newDueDateInput.value = ''; // Clear due date
        newCategorySelect.value = ''; // Reset category
        // Optionally, reset the min attribute if you hide the form
        newDueDateInput.removeAttribute('min'); // Or set it back to the PHP value if you want
    });

        addNewTaskBtn.addEventListener('click', function () {
            const taskText = newTaskInput.value.trim();
            const dueDate = newDueDateInput.value;
            const categoryValue = newCategorySelect.value;

            if (!taskText) {
                alert('Please enter a task title.');
                return; // Stop execution if title is empty
            }

            // Category map for JS (no 'other')
            const categoryMap = {
                'important': 1,
                'work': 2,
                'personal': 3
            };

            // Get categoryId, default to null if not found (e.g., 'Select Category' is chosen)
            const categoryId = categoryMap[categoryValue] ?? null;

            fetch('<?= base_url('task/save') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest' // Indicate AJAX for CI controller
                },
                body: `title=${encodeURIComponent(taskText)}&due_date=${dueDate}&category_id=${categoryId}`
            })
            .then(response => {
                if (!response.ok) {
                    // If response is not OK (e.g., 400, 500 status), try to parse error as JSON
                    return response.json().then(errorData => { throw new Error(errorData.message || 'Server error'); });
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    // Category class map for JS (no 'other')
                    const categoryClassMap = {
                        1: { label: 'Important', class: 'important' },
                        2: { label: 'Work', class: 'work' },
                        3: { label: 'Personal', class: 'personal' }
                    };

                    // Use a fallback for the display if categoryId is null or unexpected
                    const category = categoryClassMap[categoryId] ?? { label: 'N/A', class: 'n-a' };
                    const formattedDate = new Date(dueDate).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    const taskItem = document.createElement('div');
                    taskItem.classList.add('task-item');
                    taskItem.dataset.taskId = data.task_id;

                    taskItem.innerHTML = `
                        <label class="task-checkbox-container">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <a href="<?= base_url('task/view_details/') ?>${data.task_id}" class="task-link-area">
                            <div class="task-details">
                                <h6>${taskText}
                                    <span class="category-tag category-${category.class}">${category.label}</span>
                                </h6>
                                <p>Due: ${formattedDate}</p>
                            </div>
                        </a>
                    `;

                    document.getElementById('dailyTasksList').appendChild(taskItem);

                    // Reset and hide the form
                    newTaskForm.classList.remove('show');
                    newTaskInput.value = '';
                    newDueDateInput.value = '';
                    newCategorySelect.value = '';

                    updateTaskCounts(); // Refresh counters (for daily tasks in this context)
                    alert('Task added successfully!'); // Provide user feedback
                } else {
                    // Display specific error message from backend if available
                    alert('Failed to add task: ' + (data.message || 'Unknown error.'));
                }
            })
            .catch(error => {
                console.error('Error saving task:', error);
                alert('Error saving task. Please try again. ' + error.message);
            });
        });
    });

    // --- Bar Chart for Task Progress ---
const ctx = document.getElementById('taskStatusBarChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'In Progress', 'Completed'],
        datasets: [{
            label: 'Task Status',
            data: [
                <?= isset($percent_pending) ? $percent_pending : 0 ?>,
                <?= isset($percent_in_progress) ? $percent_in_progress : 0 ?>,
                <?= isset($percent_completed) ? $percent_completed : 0 ?>
            ],
            backgroundColor: [
                '#D4536C',
                '#6C63FF',
                '#28A745'
            ],
            borderRadius: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

</script>
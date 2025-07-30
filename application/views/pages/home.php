<?php $active = 'home'; ?>
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

    .task-link-area {
        flex-grow: 1; 
        text-decoration: none;
        color: inherit; 
        display: block;
        cursor: pointer;
        transition: color 0.2s;
    }

    .task-link-area:hover .task-details h6 {
        color: #D4536C;
    }

    .task-details {
        flex-grow: 1;
    }

    .task-item.completed .task-details h6 { 
        text-decoration: line-through;
        color: #aaa;
    }

    .task-details h6 {
        margin: 0;
        font-size: 1rem;
        color: #333;
        font-weight: 500;
        transition: color 0.2s, text-decoration 0.2s;
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
    .category-important { background-color: #D4536C; } 
    .category-work { background-color: #6C63FF; } 
    .category-personal { background-color: #28A745; } 
    .category-n-a { background-color: #999; }

    .create-task-btn {
        background-color: #D4536C;
        color: #fff;
        border-radius: 1rem; 
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.2s;
        text-decoration: none; 
        width: 100%;
        margin-top: 1.5rem;
        cursor: pointer;
    }

    .create-task-btn:hover {
        background-color: #FEA4AA; 
        color: #D4536C;
    }

    .new-task-form {
        margin-top: 1rem;
        display: none;
        padding: 1rem;
        border-radius: 1rem;
        background-color: #f8f8f9;
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
        -webkit-appearance: none; 
        -moz-appearance: none;
        appearance: none;
    }
    .new-task-form select {
        padding-right: 2.5rem;
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
        border: 1px solid #ddd; 
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

    .task-summary-boxes {
        display: flex;
        gap: 1.5rem; 
        margin-bottom: 2rem;
        flex-wrap: wrap; 
    }

    .task-summary-box {
        flex: 1; 
        min-width: 150px;
        background-color: #D4536C;
        color: #fff;
        text-align: center;
        padding: 1.2rem 1rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 120px;
    }
    .task-summary-box.overall-tasks {
        background-color: #FEA4AA;
        color: #D4536C;
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
    .welcome-message-box {
        background-color: #fff; 
        border-radius: 1.5rem; 
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); 
        padding: 1rem 2rem;
        margin-bottom: 2rem; 
        text-align: center;
        display: flex;
        align-items: center; 
        justify-content: center; 
        min-height: 70px; 
    }

    .welcome-message-box p {
        color: #777;
        margin: 0;
        font-size: 1rem;
        font-weight: 500;
    }

    .progress-card {
        margin-top: 0;
    }

    .progress-chart-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        position: relative;
        margin-bottom: 1.5rem;
    }

    .progress-chart-circle {
        width: 150px; 
        height: 150px;
        border-radius: 50%;
        background: conic-gradient(
            #D4536C 0% 40%, 
            #6C63FF 40% 72%, 
            #28A745 72% 100%
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
        flex-wrap: wrap; 
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
    .legend-color.in-progress { background-color: #6C63FF; } 
    .legend-color.completed { background-color: #28A745; }

    .view-tasks-btn {
        background-color: #F8F8F9; 
        color: #D4536C;
        border: 1px solid #D4536C;
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

    @media (max-width: 991.98px) { 
        .calendar-days {
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .calendar-day {
            min-width: unset;
            flex: 1 0 12%; 
            margin: 0.2rem;
        }
        .task-summary-box {
            min-height: 100px; 
        }
        .task-summary-box h3 {
            font-size: 2rem;
        }
        .task-summary-box p {
            font-size: 0.9rem;
        }
        .task-summary-boxes {
            flex-direction: column; 
            gap: 1rem;
        }
        .welcome-message-box {
            min-height: 60px;
            padding: 0.8rem 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
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
            flex: 1 0 13%;
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
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
        .task-summary-box {
            padding: 1rem 0.8rem;
            min-height: 90px;
        }
        .task-summary-box h3 {
            font-size: 1.8rem;
        }
        .task-summary-box p {
            font-size: 0.8rem;
        }
        .welcome-message-box {
            min-height: 50px;
            padding: 0.5rem 1rem;
        }
    }
    canvas#taskStatusBarChart {
        display: block !important;
        width: 100% !important;
        height: auto !important;
    }
    .btn-calculator {
        background-color: #D4536C;
        color: #fff;
        border-radius: 1rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        border: 2px solid black;
        transition: background-color 0.2s;
    }
    .btn-calculator:hover {
        background-color: #FEA4AA;
        color: #D4536C;
    }
    #calculatorModal .modal-content { 
        border-radius: 24px; 
        border: 2px solid black; 
    }
    #calculatorModal .modal-header { 
        border-bottom: 1px solid #eee; 
    }   
    #calculatorModal .modal-title { 
        color: #333; font-size: 24px; 
        font-weight: 600; 
    }
    #calculatorModal #calc-display {
        width: 100%; height: 80px; 
        text-align: right; 
        font-size: 40px; 
        padding: 12px;
        margin-bottom: 16px; 
        border-radius: 12px; 
        border: 1px solid #eee; 
        outline: none;
    }
    #calculatorModal .calc-buttons { 
        display: grid; 
        grid-template-columns: repeat(4, 1fr); 
        gap: 6px; 
    }
    #calculatorModal .num-btn, #calculatorModal .operator-btn {
        padding: 15px 0; 
        border-radius: 8px; 
        font-size: 24px; 
        border: none; 
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); 
        transition: all 0.2s ease-in-out;
    }
    #calculatorModal .num-btn:active, #calculatorModal .operator-btn:active {
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1); 
        transform: translateY(1px);
    }
    #calculatorModal .operator-btn { 
        background-color: #C2185B; 
        color: #fff; 
    }
    #calculatorModal .operator-btn:hover { 
        background-color: #E91E63; 
    }
    #calculatorModal .num-btn, #calculatorModal .operator-btn[value="+/-"] {
        background-color: #F8F8F9; 
        color: #333; 
        border: 1px solid #e0e0e0;
    }
    #calculatorModal .num-btn:hover, #calculatorModal .operator-btn[value="+/-"]:hover { 
        background-color: #f0f0f0; 
    }
    #calculatorModal .modal-title {
    color: #C2185B; 
    }
    #viewTaskModal {
        display: none; 
        position: fixed; 
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        justify-content: center; 
        align-items: center; 
        z-index: 1050;
        opacity: 0; 
        visibility: hidden; 
        transition: opacity 0.3s ease, visibility 0.3s ease; 
    }

    #viewTaskModal.show {
        opacity: 1;
        visibility: visible;
        display: flex; 
    }

    #viewTaskModal .modal-content {
        background-color: #fff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
        max-width: 500px;
        width: 90%;
        transform: translateY(-20px); 
        transition: transform 0.3s ease;
    }

    #viewTaskModal.show .modal-content {
        transform: translateY(0);
    }

    #viewTaskModal .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 1.5rem;
        border: none;
        background: transparent;
        cursor: pointer;
        color: #555;
    }

    #viewTaskModal .modal-close-btn:hover {
        color: #D4536C;
    }

    #viewTaskModal .modal-title {
        color: #333;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    #viewTaskModal .modal-body p {
        margin-bottom: 0.75rem;
        color: #555;
    }

    #viewTaskModal .modal-body p strong {
        color: #333;
        min-width: 100px; 
        display: inline-block;
    }

    #viewTaskModal .modal-body h4 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #333;
        font-size: 1.2rem;
    }

    #viewTaskModal .modal-body ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #viewTaskModal .modal-body ul li {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        color: #555;
    }

    #viewTaskModal .modal-body ul li input[type="checkbox"] {
        margin-right: 0.75rem;
        transform: scale(1.2);
    }

    #viewTaskModal .modal-body .status-badge {
        padding: 0.2em 0.6em;
        border-radius: 0.5em;
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        display: inline-block;
        margin-left: 5px;
    }

    #viewTaskModal .modal-body .status-badge.pending { 
        background-color: #ffc107; 
        color: #333;
    }
    #viewTaskModal .modal-body .status-badge.in-progress { 
        background-color: #0d6efd; 
    }
    #viewTaskModal .modal-body .status-badge.completed { 
        background-color: #28a745; 
        }

        #notification-container {
        position: fixed;
        top: 20px; 
        right: 20px; 
        z-index: 1100; 
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 350px;
        pointer-events: none;
    }

    .notification-toast {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #eee;
        color: #333;
        font-size: 0.95em;
        opacity: 0; 
        transform: translateX(100%); 
        animation: slideInFromRight 0.5s forwards, fadeOut 0.5s forwards 4.5s; 
        pointer-events: auto; 
        position: relative;
        overflow: hidden;
        min-width: 250px; 
    }

    .notification-toast.slide-out {
        animation: slideOutToRight 0.5s forwards; 
    }

    .notification-toast.info { border-left: 5px solid #0d6efd; } 
    .notification-toast.warning { border-left: 5px solid #ffc107; }
    .notification-toast.danger { border-left: 5px solid #dc3545; }
    .notification-toast.success { border-left: 5px solid #28a745; }

    .notification-toast .icon {
        font-size: 1.5em;
        flex-shrink: 0;
    }
    .notification-toast .content {
        flex-grow: 1;
    }
    .notification-toast .content strong {
        display: block;
        font-weight: 700;
        margin-bottom: 3px;
        color: #333;
    }
    .notification-toast .content p {
        margin: 0;
        font-size: 0.9em;
        color: #555;
    }

    .notification-toast .close-btn {
        background: none;
        border: none;
        font-size: 1.2em;
        color: #aaa;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        margin-left: auto;
        flex-shrink: 0;
        transition: color 0.2s;
    }
    .notification-toast .close-btn:hover {
        color: #555;
    }

    @keyframes slideInFromRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOutToRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
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
                                $categoryMap = [
                                    1 => ['label' => 'Important', 'class' => 'important'],
                                    2 => ['label' => 'Work', 'class' => 'work'],
                                    3 => ['label' => 'Personal', 'class' => 'personal'],
                                ];
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
                        <option value="personal">Other</option>
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
            <div class="d-grid gap-2 mb-3">
                <button type="button" class="btn-calculator" data-bs-toggle="modal" data-bs-target="#calculatorModal">
                    <i class="bi bi-calculator"></i>CALCULATOR
                </button>
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

<div class="modal fade" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calculatorModalLabel">Calculator</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="calc-display" placeholder="0" autocomplete="off" maxlength="16"/>
        <div class="calc-buttons">
          <button class="operator-btn" value="percentage_op">%</button>
          <button class="operator-btn" value="CE">CE</button>
          <button class="operator-btn" value="C">C</button>
          <button class="operator-btn" value="÷">÷</button>
          <button class="num-btn" value="7">7</button>
          <button class="num-btn" value="8">8</button>
          <button class="num-btn" value="9">9</button>
          <button class="operator-btn" value="*">x</button>
          <button class="num-btn" value="4">4</button>
          <button class="num-btn" value="5">5</button>
          <button class="num-btn" value="6">6</button>
          <button class="operator-btn" value="-">-</button>
          <button class="num-btn" value="1">1</button>
          <button class="num-btn" value="2">2</button>
          <button class="num-btn" value="3">3</button>
          <button class="operator-btn" value="+">+</button>
          <button class="num-btn" value="+/-">+/-</button>
          <button class="num-btn" value="0">0</button>
          <button class="num-btn" value=".">.</button>
          <button class="operator-btn" value="=">=</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="viewTaskModal" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-btn" onclick="closeModal('viewTaskModal')">&times;</button>
        <h3 class="modal-title" id="viewTaskTitle">Task Details</h3>
        <div class="modal-body">
            <p><strong>Title:</strong> <span id="viewTaskDetailTitle"></span></p>
            <p><strong>Description:</strong> <span id="viewTaskDescription"></span></p>
            <p><strong>Due Date:</strong> <span id="viewTaskDueDate"></span></p>
            <p><strong>Due Time:</strong> <span id="viewTaskDueTime"></span></p>
            <p><strong>Repeat:</strong> <span id="viewRepeatType"></span></p>
            <p><strong>Category:</strong> <span id="viewTaskCategory"></span></p>
            <p><strong>Status:</b> <span id="viewTaskStatus"></span></p>
            <p><strong>Created At:</strong> <span id="viewTaskCreatedAt"></span></p>
            <p><strong>Last Updated:</strong> <span id="viewTaskUpdatedAt"></span></p>
            <h4>Checklist:</h4>
            <ul id="viewTaskChecklist"></ul>
        </div>
    </div>
</div>

<div id="notification-container"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function htmlspecialchars(str) {
            var map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(str).replace(/[&<>"']/g, function (m) { return map[m]; });
        }

        function capitalizeFirstLetter(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }


        const phpCategories = <?php echo json_encode(isset($categories) ? $categories : []); ?>;
        const categoryMap = {}; 
        phpCategories.forEach(cat => {
            categoryMap[cat.id] = cat.category;
        });

        if (Object.keys(categoryMap).length === 0) {
            Object.assign(categoryMap, {
                1: 'Work',
                2: 'Personal',
                3: 'Important',
                4: 'Other', 
            });
        }

        const OTHER_CATEGORY_ID = '4'; 

        function getCategoryName(categoryId) {
            return categoryMap[categoryId] || 'Unknown Category';
        }

        function showNotification(type, title, message, duration = 5000) {
            const notificationContainer = document.getElementById('notification-container');
            if (!notificationContainer) {
                console.warn("Notification container not found. Cannot show notification.");
                return;
            }

            const toast = document.createElement('div');
            toast.classList.add('notification-toast', type);

            let iconClass = '';
            switch (type) {
                case 'info':    iconClass = 'bi bi-info-circle-fill'; break;
                case 'success': iconClass = 'bi bi-check-circle-fill'; break;
                case 'warning': iconClass = 'bi bi-exclamation-triangle-fill'; break;
                case 'danger':  iconClass = 'bi bi-exclamation-circle-fill'; break;
                default:        iconClass = 'bi bi-bell-fill'; break;
            }

            toast.innerHTML = `
                <i class="icon ${iconClass}"></i>
                <div class="content">
                    <strong>${htmlspecialchars(title)}</strong>
                    <p>${htmlspecialchars(message)}</p>
                </div>
                <button class="close-btn">&times;</button>
            `;

            toast.querySelector('.close-btn').addEventListener('click', () => {
                toast.classList.add('slide-out');
                toast.addEventListener('animationend', () => toast.remove(), { once: true });
            });

            notificationContainer.appendChild(toast);

            setTimeout(() => {
                if (toast.parentNode) {
                    toast.classList.add('slide-out');
                    toast.addEventListener('animationend', () => toast.remove(), { once: true });
                }
            }, duration);
        }

        const alertTasks = <?php echo json_encode(isset($alert_tasks) ? $alert_tasks : []); ?>;

        if (alertTasks && alertTasks.length > 0) {
            let overdueCount = 0;
            let dueSoonCount = 0;

            alertTasks.forEach(task => {
                const taskDueDate = new Date(task.due_date);
                const today = new Date();
                today.setHours(0,0,0,0);

                const diffTime = taskDueDate.getTime() - today.getTime();
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                let notificationType = 'info';
                let notificationTitle = htmlspecialchars(task.title);
                let notificationMessage = '';

                let categoryNameForDisplay = getCategoryName(task.category_id);
                if (task.category_id == OTHER_CATEGORY_ID && task.custom_category_name) {
                    categoryNameForDisplay = htmlspecialchars(task.custom_category_name) + ' (Other)';
                }

                if (diffDays < 0) {
                    notificationType = 'danger';
                    notificationTitle = `Overdue: ${notificationTitle}`;
                    notificationMessage = `Due ${Math.abs(diffDays)} day${Math.abs(diffDays) !== 1 ? 's' : ''} ago! Category: ${categoryNameForDisplay}`;
                    overdueCount++;
                } else if (diffDays === 0) { 
                    notificationType = 'warning';
                    notificationTitle = `Due Today: ${notificationTitle}`;
                    notificationMessage = `Due ${task.due_time ? 'at ' + task.due_time : 'today'}! Category: ${categoryNameForDisplay}`;
                    dueSoonCount++; 
                } else if (diffDays > 0 && diffDays <= 3) { 
                    notificationType = 'info';
                    notificationTitle = `Due Soon: ${notificationTitle}`;
                    notificationMessage = `Due in ${diffDays} day${diffDays !== 1 ? 's' : ''}! Category: ${categoryNameForDisplay}`;
                    dueSoonCount++; 
                }

                if (diffDays < 0 || (diffDays > 0 && diffDays <= 3)) {
                    showNotification(notificationType, notificationTitle, notificationMessage, 8000);
                }
            });

            if (overdueCount > 0 || dueSoonCount > 0) {
                let summaryParts = [];
                if (overdueCount > 0) summaryParts.push(`${overdueCount} task${overoverdueCount !== 1 ? 's' : ''} overdue`);
                if (dueSoonCount > 0) summaryParts.push(`${dueSoonCount} task${dueSoonCount !== 1 ? 's' : ''} due soon`);
                
                showNotification('info', 'Task Reminders', summaryParts.join(' and ') + '. Check your task list!', 10000); 
            }

        } else {
            showNotification('success', 'No Alerts!', 'All caught up, no tasks needing immediate attention. Keep up the good work!', 5000);
        }

        window.homeViewTask = function (task) {
        const viewTaskModal = document.getElementById('viewTaskModal');
            if (document.getElementById('viewTaskDetailTitle')) document.getElementById('viewTaskDetailTitle').textContent = task.title || 'N/A';
            if (document.getElementById('viewTaskDescription')) document.getElementById('viewTaskDescription').textContent = task.description || 'No description provided.';
            if (document.getElementById('viewTaskDueDate')) document.getElementById('viewTaskDueDate').textContent = task.due_date || 'N/A';
            if (document.getElementById('viewTaskDueTime')) document.getElementById('viewTaskDueTime').textContent = task.due_time || 'N/A';
            if (document.getElementById('viewRepeatType')) document.getElementById('viewRepeatType').textContent = task.repeat_type ? capitalizeFirstLetter(task.repeat_type) : 'None';
            if (document.getElementById('viewTaskCategory')) {
                let displayCategory = '';
                if (task.category_id == OTHER_CATEGORY_ID && task.custom_category_name) {
                    displayCategory = htmlspecialchars(task.custom_category_name) + ' (Other)';
                } else {
                    displayCategory = getCategoryName(task.category_id);
                }
                document.getElementById('viewTaskCategory').textContent = displayCategory;
            }

            const viewTaskStatusSpan = document.getElementById('viewTaskStatus');
            if (viewTaskStatusSpan) {
                viewTaskStatusSpan.textContent = task.status ? capitalizeFirstLetter(task.status) : 'N/A';
                viewTaskStatusSpan.className = 'status-badge ' + (task.status ? task.status.toLowerCase().replace(' ', '-') : '');
            }

            if (document.getElementById('viewTaskCreatedAt')) document.getElementById('viewTaskCreatedAt').textContent = task.created_at || 'N/A';
            if (document.getElementById('viewTaskUpdatedAt')) document.getElementById('viewTaskUpdatedAt').textContent = task.updated_at || 'N/A';

            const checklistUl = document.getElementById('viewTaskChecklist');
            if (checklistUl) {
                checklistUl.innerHTML = '';

                if (task.checklist_items) {
                    try {
                        const checklist = JSON.parse(task.checklist_items);
                        if (Array.isArray(checklist) && checklist.length > 0) {
                            checklist.forEach(item => {
                                const li = document.createElement('li');
                                const isCompleted = item.completed === true || item.completed === 'true';
                                li.innerHTML = `<input type="checkbox" ${isCompleted ? 'checked' : ''} disabled><span>${htmlspecialchars(item.item || '')}</span>`;
                                checklistUl.appendChild(li);
                            });
                        } else {
                            checklistUl.innerHTML = '<li>No checklist items.</li>';
                        }
                    } catch (e) {
                        console.error("Error parsing checklist_items:", e);
                        checklistUl.innerHTML = '<li>Error loading checklist.</li>';
                    }
                } else {
                    checklistUl.innerHTML = '<li>No checklist items.</li>';
                }
            }

             if (viewTaskModal) {
                viewTaskModal.style.display = 'flex'; 
                setTimeout(() => viewTaskModal.classList.add('show'), 10); 
            }
        };
        window.closeModal = function (modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                setTimeout(() => { modal.style.display = 'none'; }, 300); 
            }
        };

        // logic for calendar
        const calendarDaysContainer = document.getElementById('calendarDaysContainer');
        const dailyTasksList = document.getElementById('dailyTasksList');
        const prevWeekBtn = document.getElementById('prevWeekBtn');
        const nextWeekBtn = document.getElementById('nextWeekBtn');

        let currentDate = new Date();
        let selectedDate = new Date();

        function renderTasks(tasks) {
            dailyTasksList.innerHTML = '';
            if (!tasks || tasks.length === 0) {
                dailyTasksList.innerHTML = '<p class="text-center text-muted mt-3">No tasks scheduled for this day.</p>';
                return;
            }

            tasks.forEach(task => {
                let category_label_for_display = '';
                let category_class_for_display = 'n-a';

                if (task.category_id == OTHER_CATEGORY_ID && task.custom_category_name) {
                    category_label_for_display = htmlspecialchars(task.custom_category_name) + ' (Other)';
                    category_class_for_display = 'n-a';
                } else if (categoryMap[task.category_id]) {
                    category_label_for_display = getCategoryName(task.category_id);
                    if (task.category_id == 1) category_class_for_display = 'important';
                    else if (task.category_id == 2) category_class_for_display = 'work';
                    else if (task.category_id == 3) category_class_for_display = 'personal';
                    else category_class_for_display = 'n-a';
                } else {
                    category_label_for_display = 'Uncategorized';
                    category_class_for_display = 'n-a';
                }

                const isCompleted = (task.status === 'completed');
                const formattedDate = new Date(task.due_date + 'T00:00:00').toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                const taskElement = document.createElement('div');
                taskElement.className = `task-item ${isCompleted ? 'completed' : ''}`;
                taskElement.dataset.taskId = task.id;

                taskElement.innerHTML = `
                    <label class="task-checkbox-container">
                        <input type="checkbox" data-task-id="${task.id}" ${isCompleted ? 'checked' : ''}>
                        <span class="checkmark"></span>
                    </label>
                    <div class="task-details"> <h6>${htmlspecialchars(task.title)}
                            <span class="category-tag category-${category_class_for_display}">${category_label_for_display}</span>
                        </h6>
                        <p>Due: ${formattedDate}</p>
                    </div>`;

                taskElement.addEventListener('click', function(event) {
                    if (!event.target.closest('.task-checkbox-container')) {
                        window.homeViewTask(task); 
                    }
                });

                dailyTasksList.appendChild(taskElement);
            });
        }


        async function fetchTasksForDate(dateString) {
            try {
                dailyTasksList.innerHTML = '<p class="text-center text-muted mt-3">Loading tasks...</p>';
                const response = await fetch(`<?= base_url('planner/get_tasks_for_date/') ?>${dateString}`);
                if (!response.ok) throw new Error('Network error');
                const tasks = await response.json();
                renderTasks(tasks);
            } catch (error) {
                console.error('Failed to fetch tasks:', error);
                dailyTasksList.innerHTML = '<p class="text-center text-danger mt-3">Could not load tasks. Please try again.</p>';
            }
        }

        function renderCalendarDays(dateToDisplay) {
            calendarDaysContainer.innerHTML = '';
            const startOfWeek = new Date(dateToDisplay);
            startOfWeek.setDate(dateToDisplay.getDate() - startOfWeek.getDay());
            const dayNames = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            for (let i = 0; i < 7; i++) {
                const day = new Date(startOfWeek);
                day.setDate(startOfWeek.getDate() + i);
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                if (day.toDateString() === selectedDate.toDateString()) {
                    dayElement.classList.add('active');
                }

                const year = day.getFullYear();
                const month = String(day.getMonth() + 1).padStart(2, '0');
                const date = String(day.getDate()).padStart(2, '0');
                const dateString = `${year}-${month}-${date}`;

                dayElement.dataset.date = dateString;
                dayElement.innerHTML = `<span>${dayNames[day.getDay()]}</span><strong>${day.getDate()}</strong>`;
                dayElement.addEventListener('click', function() {
                    selectedDate = new Date(this.dataset.date + 'T00:00:00');
                    renderCalendarDays(currentDate);
                    fetchTasksForDate(this.dataset.date);
                });
                calendarDaysContainer.appendChild(dayElement);
            }
        }

        prevWeekBtn.addEventListener('click', function() {
            currentDate.setDate(currentDate.getDate() - 7);
            renderCalendarDays(currentDate);
        });

        nextWeekBtn.addEventListener('click', function() {
            currentDate.setDate(currentDate.getDate() + 7);
            renderCalendarDays(currentDate);
        });

        renderCalendarDays(currentDate);
        fetchTasksForDate(selectedDate.toISOString().split('T')[0]);

        dailyTasksList.addEventListener('change', function(event) {
            if (event.target.matches('.task-checkbox-container input[type="checkbox"]')) {
                event.stopPropagation();

                const taskItem = event.target.closest('.task-item');
                const taskId = event.target.dataset.taskId; 
                const isCompleted = event.target.checked;
                const newStatus = isCompleted ? 'completed' : 'pending';

                fetch(`<?= base_url('task/update_status/') ?>${taskId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `status=${encodeURIComponent(newStatus)}`
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        taskItem.classList.toggle('completed', isCompleted);
                    } else {
                        event.target.checked = !isCompleted;
                        alert('Failed to update task: ' + (data.message || 'Unknown error.'));
                    }
                })
                .catch(error => {
                    console.error('Error updating task status:', error);
                    event.target.checked = !isCompleted;
                    alert('A network error occurred while updating the task.');
                });
            }
        });


        const toggleNewTaskFormBtn = document.getElementById('toggleNewTaskForm');
        const newTaskForm = document.getElementById('newTaskForm');
        const newTaskInput = document.getElementById('newTaskInput');
        const newDueDateInput = document.getElementById('newDueDate');
        const newCategorySelect = document.getElementById('newCategory');
        const addNewTaskBtn = document.getElementById('addNewTask');
        const cancelNewTaskBtn = document.getElementById('cancelNewTask');

        if (toggleNewTaskFormBtn && newTaskForm && newTaskInput && newDueDateInput && newCategorySelect && addNewTaskBtn && cancelNewTaskBtn) {
            toggleNewTaskFormBtn.addEventListener('click', function() {
                newTaskForm.classList.toggle('show');
                if (newTaskForm.classList.contains('show')) {
                    newTaskInput.focus();
                    const today = new Date();
                    const todayFormatted = today.toISOString().split('T')[0];
                    newDueDateInput.value = todayFormatted;
                    newDueDateInput.setAttribute('min', todayFormatted);
                }
            });

            cancelNewTaskBtn.addEventListener('click', function() {
                newTaskForm.classList.remove('show');
                newTaskInput.value = '';
                newDueDateInput.value = '';
                newCategorySelect.value = '';
            });

            addNewTaskBtn.addEventListener('click', function() {
                const taskText = newTaskInput.value.trim();
                const dueDate = newDueDateInput.value;
                const categoryValue = newCategorySelect.value;
                if (!taskText) {
                    alert('Please enter a task title.');
                    return;
                }
                const categoryMap = { 'important': 1, 'work': 2, 'personal': 3 }; // This is a local categoryMap for new task form
                const categoryId = categoryMap[categoryValue] ?? null;
                fetch('<?= base_url('task/save') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                    body: `title=${encodeURIComponent(taskText)}&due_date=${dueDate}&category_id=${categoryId}`
                }).then(response => response.json()).then(data => {
                    if (data.status === 'success') {
                        alert('Task added successfully!');
                        newTaskForm.classList.remove('show');
                        newTaskInput.value = '';
                        newDueDateInput.value = '';
                        newCategorySelect.value = '';
                        const activeDay = document.querySelector('.calendar-day.active');
                        if(activeDay && activeDay.dataset.date === dueDate) {
                            fetchTasksForDate(dueDate);
                        }
                    } else {
                        alert('Failed to add task: ' + (data.message || 'Unknown error.'));
                    }
                }).catch(error => {
                    console.error('Error saving task:', error);
                    alert('Error saving task.');
                });
            });
        }


        // logic for calculator
        function initModernCalculator(displaySelector, buttonSelector) {
            const display = document.querySelector(displaySelector);
            const buttons = document.querySelectorAll(buttonSelector);
            if (!display || buttons.length === 0) return;

            function formatNumberWithCommas(numberString) {
                if (!numberString || typeof numberString.toString !== 'function') return '';
                let stringValue = numberString.toString();
                if (stringValue.endsWith('.') || stringValue === '-') return stringValue;
                let parts = stringValue.split('.');
                parts[0] = parts[0].replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                return parts.join('.');
            }

            function safeEval(str) {
                try {
                    let calculationStr = str.replace(/,/g, '');
                    let evalStr = calculationStr.replace(/x/g, '*').replace(/÷/g, '/');
                    if (!/^[\d\s\.\+\-\*\/\(\)%]*$/.test(evalStr)) return 'Error';
                    evalStr = evalStr.replace(/(\d+(\.\d+)?)%/g, '($1/100)');
                    const result = Function('"use strict"; return (' + evalStr + ')')();
                    return (typeof result === 'number' && isFinite(result)) ? result : 'Error';
                } catch { return 'Error'; }
            }

            function calculateExpression(el) {
                if (el.value.trim() === '') { el.value = '0'; return; }
                const rawResult = safeEval(el.value);
                el.value = formatNumberWithCommas(rawResult);
            }

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const val = button.value;
                    let currentDisplay = display.value;
                    if (val === 'C') { display.value = ''; }
                    else if (val === 'CE') {
                        let unformatted = currentDisplay.replace(/,/g, '');
                        let cleared = unformatted.slice(0, -1) || '';
                        display.value = formatNumberWithCommas(cleared);
                    } else if (val === '=') { calculateExpression(display); }
                    else if (val === 'percentage_op') {
                        let result = safeEval(currentDisplay);
                        display.value = formatNumberWithCommas(!isNaN(result) ? result / 100 : 'Error');
                    } else if (val === '+/-') {
                        let result = safeEval(currentDisplay);
                        display.value = formatNumberWithCommas(!isNaN(result) ? result * -1 : 'Error');
                    } else {
                        let unformatted = currentDisplay.replace(/,/g, '');
                        if (unformatted.length < 16) {
                            let newValue = (unformatted === '0' && val !== '.') ? val : unformatted + val;
                            display.value = formatNumberWithCommas(newValue);
                        }
                    }
                });
            });

            display.addEventListener('input', function(e) {
                let cursorPosition = display.selectionStart;
                let originalLength = display.value.length;
                let rawValue = display.value.replace(/,/g, '');
                let formattedValue = formatNumberWithCommas(rawValue);
                display.value = formattedValue;
                let newLength = display.value.length;
                cursorPosition = cursorPosition + (newLength - originalLength);
                display.setSelectionRange(cursorPosition, cursorPosition);
            });

            display.addEventListener('keydown', function(e) {
                const allowedKeys = '0123456789+-*/.()%x÷';
                if (e.key === 'Enter') { e.preventDefault(); calculateExpression(display); }
                else if (e.key === 'Escape') { e.preventDefault(); display.value = ''; }
                else if (!allowedKeys.includes(e.key) && !['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(e.key)) {
                    e.preventDefault();
                }
            });
        }
        initModernCalculator('#calc-display', '#calculatorModal .num-btn, #calculatorModal .operator-btn');


        // logic for the chart
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
                    backgroundColor: ['#D4536C', '#6C63FF', '#28A745'],
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, max: 100 } }
            }
        });
    });
</script>
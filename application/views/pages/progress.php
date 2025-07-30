<?php $active = 'progress'; ?>
<?php include(APPPATH . 'views/templates/sidebar.php'); ?>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #F8F8F9;
    margin: 0;
    min-height: 100vh;
}

.content-wrapper {
    margin-left: 270px; 
    padding: 40px 30px;
    transition: margin-left 0.3s ease; 
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.page-header h1 {
    margin-right: 20px;
    color: #D4536C;
    font-weight: bold;
    letter-spacing: 0.5px;
    font-size: 2.2em;
}

.summary-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.summary-card {
    background-color: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    text-align: center;
    transition: transform 0.2s ease;
}

.summary-card:hover {
    transform: translateY(-5px);
}

.summary-card h3 {
    font-size: 2.5em;
    font-weight: 700;
    color: #D4536C;
    margin-bottom: 5px;
    line-height: 1;
}

.summary-card p {
    font-size: 1.1em;
    color: #777;
    margin-bottom: 0;
}

.summary-card.total h3 { color: #555; }
.summary-card.completed h3 { color: #28a745; }
.summary-card.pending h3 { color: #D4536C; } 
.summary-card.in-progress h3 { color: #ffc107; } 


.progress-chart-section {
    background: #fff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin-bottom: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.progress-chart-section h2 {
    color: #D4536C;
    font-weight: bold;
    margin-bottom: 25px;
    font-size: 1.8em;
    text-align: center;
}

.progress-chart-canvas-wrapper {
    width: 250px;
    height: 250px;
    margin-bottom: 20px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.progress-chart-donut {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: conic-gradient(
        #D4536C 0% 40%,
        #ffc107 40% 72%, 
        #28a745 72% 100% 
    );
    display: flex;
    justify-content: center;
    align-items: center;
}
.progress-chart-donut-inner {
    width: 60%;
    height: 60%;
    border-radius: 50%;
    background-color: #F8F8F9;
}

.progress-legend {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 25px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    font-size: 1em;
    color: #555;
}

.legend-color {
    width: 20px;
    height: 20px;
    border-radius: 5px;
    margin-right: 10px;
}
.legend-color.pending { background-color: #D4536C; }
.legend-color.in-progress { background-color: #ffc107; }
.legend-color.completed { background-color: #28a745; }


.tasks-by-status-section {
    margin-top: 40px;
}

.tasks-by-status-section h2 {
    color: #D4536C;
    font-weight: bold;
    margin-bottom: 25px;
    font-size: 1.8em;
}

.status-group {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    margin-bottom: 30px;
}

.status-group-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.status-group-header h3 {
    font-size: 1.5em;
    font-weight: bold;
    margin-right: 15px;
    margin-bottom: 0;
}

.status-group-header .status-badge {
    font-size: 1em;
    padding: 8px 15px;
}

.task-item-card {
    background-color: #f8f8f9;
    border-radius: 12px;
    padding: 15px 20px;
    margin-bottom: 15px;
    box-shadow: inset 0 1px 5px rgba(0,0,0,0.03);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.task-item-card:last-child {
    margin-bottom: 0;
}

.task-item-card .task-info {
    flex-grow: 1;
    margin-right: 20px;
}

.task-item-card .task-info h4 {
    font-size: 1.2em;
    color: #333;
    margin-bottom: 5px;
}

.task-item-card .task-info p {
    font-size: 0.9em;
    color: #777;
    margin-bottom: 0;
}

.task-item-card .task-actions button {
    background: none;
    border: none;
    color: #D4536C;
    font-size: 1.1em;
    cursor: pointer;
    margin-left: 10px;
    transition: color 0.2s ease;
}

.task-item-card .task-actions button:hover {
    color: #FEA4AA;
}

.no-tasks-message {
    margin-top: 40px;
    color: #888;
    text-align: center;
    font-size: 1.1em;
    padding: 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.modal-overlay {
    display: none; 
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); 
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background: #fff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 600px;
    position: relative;
    transform: translateY(20px); 
    transition: transform 0.3s ease-out;
}

.modal-overlay.show .modal-content {
    transform: translateY(0);
}

.modal-close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 1.8em;
    color: #888;
    cursor: pointer;
    transition: color 0.2s;
}

.modal-close-btn:hover {
    color: #D4536C;
}

.modal-title {
    color: #D4536C;
    font-size: 1.8em;
    margin-bottom: 20px;
    font-weight: bold;
}

.modal-body p {
    margin-bottom: 10px;
    color: #555;
    font-size: 1.05em;
}
.modal-body strong {
    color: #333;
}
.modal-body ul {
    list-style: none;
    padding: 0;
    margin-top: 10px;
}
.modal-body ul li {
    background: #f8f8f9;
    padding: 8px 12px;
    border-radius: 8px;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}
.modal-body ul li input[type="checkbox"] {
    margin-right: 10px;
    transform: scale(1.2);
}


@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 0;
        padding: 20px 15px;
    }
    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .page-header h1 {
        margin-bottom: 15px;
        font-size: 1.8em;
    }
    .summary-cards-grid {
        grid-template-columns: 1fr;
    }
    .summary-card h3 {
        font-size: 2em;
    }
    .summary-card p {
        font-size: 1em;
    }
    .progress-chart-canvas-wrapper {
        width: 200px;
        height: 200px;
    }
    .progress-legend {
        gap: 15px;
    }
    .status-group {
        padding: 15px;
    }
    .status-group-header {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    .status-group-header h3 {
        margin-bottom: 10px;
    }
    .task-item-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
    }
    .task-item-card .task-info {
        margin-right: 0;
        margin-bottom: 10px;
        width: 100%;
    }
    .task-item-card .task-actions {
        width: 100%;
        text-align: right;
    }
    .task-item-card .task-actions button {
        margin-left: 0;
        margin-right: 10px;
    }
}
</style>

<div class="content-wrapper">
    <div class="page-header">
        <h1>Your Progress Overview</h1>
    </div>

    <div class="summary-cards-grid">
        <div class="summary-card total">
            <h3 id="totalTasksCount">0</h3>
            <p>Total Tasks</p>
        </div>
        <div class="summary-card completed">
            <h3 id="completedTasksCount">0</h3>
            <p>Completed</p>
        </div>
        <div class="summary-card pending">
            <h3 id="pendingTasksCount">0</h3>
            <p>Pending</p>
        </div>
        <div class="summary-card in-progress">
            <h3 id="inProgressTasksCount">0</h3>
            <p>In Progress</p>
        </div>
    </div>

    <div class="progress-chart-section">
        <h2>Task Distribution</h2>
        <div class="progress-chart-canvas-wrapper">
            <div class="progress-chart-donut">
                <div class="progress-chart-donut-inner"></div>
            </div>
        </div>
        <div class="progress-legend">
    <div class="legend-item">
        <div class="legend-color pending"></div>
        <span>Pending</span>
        <span id="legendPendingPercent" style="margin-left: 6px;"></span>
    </div>
    <div class="legend-item">
        <div class="legend-color in-progress"></div>
        <span>In Progress</span>
        <span id="legendInProgressPercent" style="margin-left: 6px;"></span>
    </div>
    <div class="legend-item">
        <div class="legend-color completed"></div>
        <span>Completed</span>
        <span id="legendCompletedPercent" style="margin-left: 6px;"></span>
    </div>
</div>

    </div>

    <div class="tasks-by-status-section">
        <h2>Detailed Task Breakdown</h2>

        <?php
        $tasksByStatus = [
            'pending' => [],
            'in-progress' => [],
            'completed' => [],
        ];

        if (isset($tasks) && is_array($tasks)) {
            foreach ($tasks as $task) {
                $status = strtolower($task->status);
                if (array_key_exists($status, $tasksByStatus)) {
                    $tasksByStatus[$status][] = $task;
                }
            }
        }
        ?>

        <?php foreach ($tasksByStatus as $statusKey => $taskList): ?>
            <div class="status-group">
                <div class="status-group-header">
                    <h3><?= htmlspecialchars(ucfirst(str_replace('-', ' ', $statusKey))) ?> Tasks</h3>
                    <span class="status-badge <?= htmlspecialchars($statusKey) ?>"><?= count($taskList) ?></span>
                </div>
                <?php if (!empty($taskList)): ?>
                    <?php foreach ($taskList as $task): ?>
                        <div class="task-item-card">
                            <div class="task-info">
                                <h4><?= htmlspecialchars($task->title) ?></h4>
                                <p>Due: <?= htmlspecialchars($task->due_date) ?></p>
                            </div>
                            <div class="task-actions">
                                <button onclick="viewTask(<?= htmlspecialchars(json_encode($task)) ?>)">
                                    <i class="bi bi-eye"></i> View Details
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No <?= htmlspecialchars(strtolower(str_replace('-', ' ', $statusKey))) ?> tasks.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <?php if (empty($tasks)): ?>
            <p class="no-tasks-message">No tasks found in your planner. Start by adding some tasks!</p>
        <?php endif; ?>
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
            <p><strong>Category:</strong> <span id="viewTaskCategory"></span></p>
            <p><strong>Status:</strong> <span id="viewTaskStatus"></span></p>
            <p><strong>Created At:</strong> <span id="viewTaskCreatedAt"></span></p>
            <p><strong>Last Updated:</strong> <span id="viewTaskUpdatedAt"></span></p>
            <h4>Checklist:</h4>
            <ul id="viewTaskChecklist" style="margin-top: 5px;">
            </ul>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tasks = <?php echo json_encode(isset($tasks) ? $tasks : []); ?>;
        const categories = <?php echo json_encode(isset($categories) ? $categories : []); ?>;

        const categoryMap = {};
        categories.forEach(cat => {
            categoryMap[cat.id] = cat.category;
        });

        let totalTasks = tasks.length;
        let completedTasks = 0;
        let pendingTasks = 0;
        let inProgressTasks = 0;

        tasks.forEach(task => {
            switch (task.status.toLowerCase()) {
                case 'completed':
                    completedTasks++;
                    break;
                case 'pending':
                    pendingTasks++;
                    break;
                case 'in-progress':
                    inProgressTasks++;
                    break;
            }
        });

        document.getElementById('totalTasksCount').textContent = totalTasks;
        document.getElementById('completedTasksCount').textContent = completedTasks;
        document.getElementById('pendingTasksCount').textContent = pendingTasks;
        document.getElementById('inProgressTasksCount').textContent = inProgressTasks;

        const updateChartPercentages = () => {
            if (totalTasks === 0) {
                document.getElementById('legendPendingPercent').textContent = '0%';
                document.getElementById('legendInProgressPercent').textContent = '0%';
                document.getElementById('legendCompletedPercent').textContent = '0%';
                const donut = document.querySelector('.progress-chart-donut');
                if (donut) donut.style.background = '#e0e0e0'; 
                return;
            }

            const pendingPercent = ((pendingTasks / totalTasks) * 100).toFixed(0);
            const inProgressPercent = ((inProgressTasks / totalTasks) * 100).toFixed(0);
            const completedPercent = ((completedTasks / totalTasks) * 100).toFixed(0);

            document.getElementById('legendPendingPercent').textContent = `${pendingPercent}%`;
            document.getElementById('legendInProgressPercent').textContent = `${inProgressPercent}%`;
            document.getElementById('legendCompletedPercent').textContent = `${completedPercent}%`;

            const donut = document.querySelector('.progress-chart-donut');
            if (donut) {
                let currentAngle = 0;
                let gradientString = [];

                if (pendingTasks > 0) {
                    let endAngle = currentAngle + (pendingTasks / totalTasks) * 360;
                    gradientString.push(`#D4536C ${currentAngle}deg ${endAngle}deg`);
                    currentAngle = endAngle;
                }
                if (inProgressTasks > 0) {
                    let endAngle = currentAngle + (inProgressTasks / totalTasks) * 360;
                    gradientString.push(`#ffc107 ${currentAngle}deg ${endAngle}deg`);
                    currentAngle = endAngle;
                }
                if (completedTasks > 0) {
                    let endAngle = currentAngle + (completedTasks / totalTasks) * 360;
                    gradientString.push(`#28a745 ${currentAngle}deg ${endAngle}deg`);
                    currentAngle = endAngle;
                }
                donut.style.background = `conic-gradient(${gradientString.join(', ')})`;
            }
        };

        updateChartPercentages(); 

        window.viewTask = function(task) {
            document.getElementById('viewTaskDetailTitle').textContent = task.title;
            document.getElementById('viewTaskDescription').textContent = task.description || 'N/A';
            document.getElementById('viewTaskDueDate').textContent = task.due_date || 'N/A';
            document.getElementById('viewTaskDueTime').textContent = task.due_time || 'N/A';
            document.getElementById('viewTaskCategory').textContent = getCategoryName(task.category_id);
            document.getElementById('viewTaskStatus').textContent = task.status ? capitalizeFirstLetter(task.status) : 'N/A';
            document.getElementById('viewTaskCreatedAt').textContent = task.created_at || 'N/A';
            document.getElementById('viewTaskUpdatedAt').textContent = task.updated_at || 'N/A';

            const checklistUl = document.getElementById('viewTaskChecklist');
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

            document.getElementById('viewTaskModal').style.display = 'flex'; 
        };

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none';
        };

        function capitalizeFirstLetter(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function getCategoryName(categoryId) {
            return categoryMap[categoryId] || 'Unknown Category';
        }

        function htmlspecialchars(str) {
            var map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(str).replace(/[&<>"']/g, function(m) { return map[m]; });
        }
    });
</script>
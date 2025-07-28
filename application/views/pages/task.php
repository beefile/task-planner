<?php $active = 'task'; ?>
<?php include(APPPATH . 'views/templates/sidebar.php'); ?>

<style>
body {
    font-family: 'Inter', sans-serif;
    background: #F0F2F5; 
    margin: 0;
    min-height: 100vh;
    color: #333;
}

.content-wrapper {
    margin-left: 270px; 
    padding: 30px;
    transition: margin-left 0.3s ease, padding 0.3s ease;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 15px; 
}

h1, h2, h3, h4, h5, h6 {
    color: #D4536C; 
}

.page-header h1 {
    margin: 0; 
    font-weight: 700;
    font-size: 2.2em;
}

.flash-message {
    padding: 8px 15px;
    border-radius: 8px;
    font-size: 0.88em; 
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 1px 5px rgba(0,0,0,0.04);
    white-space: nowrap;
    flex-shrink: 0; 
}

.flash-message.success {
    background-color: #e6ffed; 
    color: #28a745;
    border: 1px solid #c3e6cb;
}

.flash-message.error {
    background-color: #ffebe6;
    color: #dc3545;
    border: 1px solid #f5c6cb;
}

.btn-primary-custom {
    font-size: 1.05em;
    padding: 12px 28px;
    border-radius: 12px;
    border: none;
    background-color: #D4536C; 
    color: #FFFFFF;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    box-shadow: 0 6px 20px rgba(212,83,108,0.2); 
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary-custom:hover {
    background-color: #C04A62; 
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(212,83,108,0.3);
}

.btn-primary-custom:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(212,83,108,0.15);
}

.btn-secondary-custom {
    background-color: #E0E0E0;
    color: #555;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.btn-secondary-custom:hover {
    background-color: #CCC;
    color: #444;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}

.action-buttons button {
    background: none;
    border: none;
    color: #666; 
    font-size: 1.15em;
    cursor: pointer;
    margin-right: 8px;
    transition: color 0.2s ease, transform 0.2s ease;
    padding: 5px;
    border-radius: 6px;
}

.action-buttons button:hover {
    color: #D4536C;
    transform: translateY(-1px);
}


#taskFormContainer {
    display: none; 
    margin-top: 25px; 
    border-radius: 20px;
    background: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    padding: 30px 40px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
    animation: fadeIn 0.4s ease-out; 
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

#taskFormContainer .modal-title {
    color: #D4536C;
    font-size: 2em;
    margin-bottom: 25px;
    font-weight: 700;
    text-align: center;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px; 
}

.form-group {
    margin-bottom: 0; 
}

#taskFormContainer label {
    color: #555;
    font-weight: 600;
    margin-bottom: 6px; 
    display: block;
    font-size: 0.95em;
}

#taskFormContainer input[type="text"],
#taskFormContainer input[type="date"],
#taskFormContainer input[type="time"],
#taskFormContainer select,
#taskFormContainer textarea {
    width: 100%;
    padding: 0.85rem; 
    border-radius: 10px;
    border: 1px solid #e0e0e0;
    font-size: 1rem;
    background: #fff;
    transition: border-color 0.2s, box-shadow 0.2s;
    -webkit-appearance: none; 
    -moz-appearance: none;
    appearance: none;
}

#taskFormContainer input:focus,
#taskFormContainer textarea:focus,
#taskFormContainer select:focus {
    border-color: #D4536C;
    box-shadow: 0 0 0 3px rgba(212, 83, 108, 0.15); 
    outline: none;
}

.form-full {
    grid-column: 1 / -1; 
}

.checklist-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px; 
    gap: 8px; 
}

.checklist-item input[type="text"] {
    flex-grow: 1;
    margin-top: 0;
    padding: 0.75rem; 
}

.checklist-item .remove-checklist-item {
    background: none;
    border: none;
    color: #D4536C;
    font-size: 1.5em;
    cursor: pointer;
    padding: 0 5px;
    opacity: 0.7;
    transition: opacity 0.2s, transform 0.2s;
    line-height: 1; 
}

.checklist-item .remove-checklist-item:hover {
    opacity: 1;
    transform: scale(1.1);
}

.checklist-add-btn {
    background-color: #ffe6f0; 
    color: #D4536C;
    border: 1px solid #fbc9dd;
    border-radius: 8px;
    padding: 4px 10px;
    font-size: 1em;
    cursor: pointer;
    margin-left: 10px;
    transition: background-color 0.2s, color 0.2s;
}

.checklist-add-btn:hover {
    background-color: #fbc9dd;
    color: #B03E55;
}

.task-list-section { 
    margin-top: 30px; 
}

.task-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    overflow: hidden;
}

.task-table th, .task-table td {
    padding: 15px 20px; 
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.95em;
    vertical-align: middle;
}

.task-table th:first-child,
.task-table td:first-child {
    width: 40px; 
    padding-left: 15px;
    padding-right: 0;
}

.task-table td:nth-child(2) { 
    padding-left: 10px; 
}

.task-table .task-completion-checkbox {
    transform: scale(1.2);
    cursor: pointer;
    accent-color: #D4536C; 
    margin: 0;
    border-radius: 70%; 
}

.task-table thead {
    background: #F8F9FA;
    color: #666; 
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 0.5px;
}

.task-table tbody tr:last-child td {
    border-bottom: none;
}

.task-table tbody tr:hover {
    background-color: #fcfdff; 
}

.status-badge {
    padding: 6px 14px;
    border-radius: 20px; 
    font-size: 0.8em;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-block;
    min-width: 90px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.status-badge.pending { background-color: #fff3e0; color: #ff9800; } 
.status-badge.in-progress { background-color: #e3f2fd; color: #2196f3; }
.status-badge.completed { background-color: #e8f5e9; color: #4caf50; }

.category-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: 600;
    display: inline-block;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.category-badge-1 { background-color: #ffe6f0; color: #D4536C; } 
.category-badge-2 { background-color: #fce4ec; color: #e91e63; } 
.category-badge-3 { background-color: #f8bbd0; color: #c2185b; } 
.category-badge-4 { background-color: #f06292; color: #ffffff; }
.category-badge-5 { background-color: #e04070; color: #ffffff; } 
.category-badge-6 { background-color: #c51162; color: #ffffff; }
.category-badge-7 { background-color: #880e4f; color: #ffffff; } 


.no-tasks-message {
    margin-top: 40px; 
    color: #888;
    text-align: center;
    font-size: 1.1em;
    padding: 40px;
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
    background-color: rgba(0, 0, 0, 0.5); 
    justify-content: center;
    align-items: center;
    z-index: 1000;
    animation: fadeInOverlay 0.3s ease-out;
}

@keyframes fadeInOverlay {
    from { background-color: rgba(0, 0, 0, 0); }
    to { background-color: rgba(0, 0, 0, 0.5); }
}

.modal-content {
    background: #fff;
    padding: 30px 40px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 650px; 
    position: relative;
    transform: translateY(20px);
    opacity: 0;
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
}

.modal-overlay.show .modal-content {
    transform: translateY(0);
    opacity: 1;
}

.modal-close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 2em; 
    color: #AAA;
    cursor: pointer;
    transition: color 0.2s, transform 0.2s;
}

.modal-close-btn:hover {
    color: #D4536C;
    transform: rotate(90deg);
}

.modal-title {
    color: #D4536C;
    font-size: 2em;
    margin-bottom: 20px;
    font-weight: 700;
    border-bottom: 1px solid #eee; 
    padding-bottom: 15px;
}

.modal-body p {
    margin-bottom: 10px;
    color: #555;
    font-size: 1em;
    line-height: 1.5;
}

.modal-body strong {
    color: #333;
    min-width: 120px;
    display: inline-block;
}

.modal-body ul {
    list-style: none;
    padding: 0;
    margin-top: 15px;
    border-top: 1px solid #eee;
    padding-top: 15px;
}

.modal-body ul li {
    background: #fdfdfd;
    padding: 8px 12px; 
    border-radius: 10px;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    border: 1px solid #eee;
    font-size: 0.95em;
}

.modal-body ul li input[type="checkbox"] {
    margin-right: 10px; 
    transform: scale(1.1); 
    accent-color: #D4536C;
}

@media (max-width: 992px) {
    .content-wrapper {
        margin-left: 0;
        padding: 25px 20px;
    }
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .page-header h1 {
        font-size: 1.8em;
        margin-bottom: 15px;
    }
    .flash-message {
        margin-left: 0;
        width: 100%;
        text-align: center;
        justify-content: center;
        font-size: 0.8em; 
        padding: 6px 10px;
        order: 3; 
    }
    .form-grid {
        grid-template-columns: 1fr;
    }
    .task-table th, .task-table td {
        padding: 10px 15px; 
        font-size: 0.9em;
    }
    .task-table thead {
        display: none;
    }
    .task-table tbody, .task-table tr, .task-table td {
        display: block;
        width: 100%;
    }
    .task-table tr {
        margin-bottom: 20px;
        border: 1px solid #f0f0f0;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        background: #fff;
        padding: 15px;
    }
    .task-table td {
        text-align: right;
        padding-left: 45%;
        position: relative;
        border-bottom: 1px dashed #f0f0f0; 
    }
    .task-table td:last-child {
        border-bottom: none;
        padding-bottom: 0; 
    }
    .task-table td:first-child {
        text-align: left;
        padding-right: 15px;
        padding-left: 15px; 
    }
    .task-table td:first-child::before {
        display: none; 
    }
    .task-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: calc(45% - 20px); 
        white-space: nowrap;
        text-align: left;
        font-weight: bold;
        color: #D4536C;
        font-size: 0.9em;
    }
    .action-buttons {
        text-align: center;
        margin-top: 15px;
        padding-top: 10px;
        border-top: 1px dashed #f0f0f0;
    }
}

@media (max-width: 480px) {
    .content-wrapper {
        padding: 15px;
    }
    .page-header h1 {
        font-size: 1.6em;
    }
    #taskFormContainer {
        padding: 25px;
    }
    .modal-content {
        padding: 25px;
    }
    .modal-title {
        font-size: 1.6em;
    }
    .btn-primary-custom {
        padding: 10px 20px;
        font-size: 1em;
    }
}
</style>
<div class="content-wrapper">
    <div class="page-header">
        <h1>
            <span>Your Tasks</span>
        </h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="flash-message success">
                <i class="bi bi-check-circle-fill"></i>
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="flash-message error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <button id="showTaskFormBtn" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Create New Task
        </button>
    </div>

    <div id="taskFormContainer">
        <form id="taskForm" action="<?= base_url('task/save') ?>" method="post">
            <input type="hidden" id="taskId" name="id">
            <h3 class="modal-title" id="formTitle">Create Task</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label for="taskTitle">Title</label>
                    <input type="text" id="taskTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="taskDate">Due Date</label>
                    <input type="date" id="taskDate" name="due_date" required min="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label for="due_time">Due Time</label>
                    <input type="time" id="due_time" name="due_time">
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        <?php if (isset($categories) && !empty($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category->id) ?>"><?= htmlspecialchars($category->category) ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="1">Work</option>
                            <option value="2">Personal</option>
                            <option value="3">Important</option>
                            <option value="4">Shopping</option>
                            <option value="5">Health</option>
                            <option value="6">Finance</option>
                            <option value="7">Study</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="form-group form-full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group form-full">
                    <label>Checklist <button type="button" class="checklist-add-btn" onclick="addChecklistItem()">+</button></label>
                    <div id="checklistItems">
                        <div class="checklist-item">
                            <input type="text" name="checklist_items[]" placeholder="Checklist item">
                            <button type="button" class="remove-checklist-item" onclick="removeChecklistItem(this)">x</button>
                        </div>
                    </div>
                </div>
                <div class="form-group form-full d-flex justify-content-end gap-3">
                    <button type="submit" class="btn-primary-custom">Save Task</button>
                    <button type="button" id="cancelFormBtn" class="btn-primary-custom btn-secondary-custom">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <?php
        $categoryMap = [];
        if (isset($categories)) {
            foreach ($categories as $cat) {
                $categoryMap[$cat->id] = $cat->category;
            }
        } else {
            $categoryMap = [
                1 => 'Work',
                2 => 'Personal',
                3 => 'Important',
            ];
        }
    ?>

    <?php if (isset($tasks) && count($tasks) > 0): ?>
        <div class="task-list-section">
            <div class="table-container">
                <table class="task-table">
                    <thead>
                        <tr>
                            <th></th> <th>Title</th>
                            <th>Due Date</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tasks)): ?>
                            <?php foreach ($tasks as $task):
                                $category_id = $task->category_id;
                                $categoryClass = 'category-badge-' . htmlspecialchars($category_id);
                            ?>
                                <tr>
                                    <td data-label="Complete">
                                        <input type="checkbox" class="task-completion-checkbox"
                                            data-task-id="<?= $task->id ?>"
                                            <?= ($task->status == 'completed') ? 'checked' : '' ?>>
                                    </td>
                                    <td data-label="Title"><?= htmlspecialchars($task->title) ?></td>
                                    <td data-label="Due Date"><?= htmlspecialchars($task->due_date ?? 'N/A') ?></td>
                                    <td data-label="Category">
                                        <span class="category-badge <?= $categoryClass ?>">
                                            <?= isset($categoryMap[$task->category_id]) ? htmlspecialchars($categoryMap[$task->category_id]) : 'Uncategorized' ?>
                                        </span>
                                    </td>
                                    <td data-label="Status">
                                        <span class="status-badge <?= strtolower(str_replace(' ', '-', $task->status)) ?>">
                                            <?= htmlspecialchars(ucfirst($task->status)) ?>
                                        </span>
                                    </td>
                                    <td data-label="Actions">
                                        <div class="action-buttons">
                                            <button onclick='viewTask(<?= json_encode($task) ?>)' title="View">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button onclick='editTask(<?= json_encode($task) ?>)' title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button onclick='deleteTask(<?= $task->id ?>, "<?= htmlspecialchars($task->title, ENT_QUOTES, 'UTF-8') ?>")' title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No tasks found.</td> </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <p class="no-tasks-message">You have no tasks yet! Click "Create New Task" to add one.</p>
    <?php endif; ?>
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
            <p><strong>Status:</b> <span id="viewTaskStatus"></span></p>
            <p><strong>Created At:</strong> <span id="viewTaskCreatedAt"></span></p>
            <p><strong>Last Updated:</strong> <span id="viewTaskUpdatedAt"></span></p>
            <h4>Checklist:</h4>
            <ul id="viewTaskChecklist"></ul>
        </div>
    </div>
</div>

<div id="deleteConfirmModal" class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close-btn" onclick="closeModal('deleteConfirmModal')">&times;</button>
        <h3 class="modal-title">Confirm Deletion</h3>
        <div class="modal-body">
            <p>Are you sure you want to delete the task: <strong id="taskToDeleteTitle"></strong>?</p>
            <p>This action cannot be undone.</p>
            <div style="text-align: right; margin-top: 25px;">
                <button class="btn-primary-custom btn-secondary-custom" onclick="closeModal('deleteConfirmModal')">Cancel</button>
                <button class="btn-primary-custom" id="confirmDeleteBtn">Delete Task</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const showTaskFormBtn = document.getElementById('showTaskFormBtn');
    const taskFormContainer = document.getElementById('taskFormContainer');
    const taskForm = document.getElementById('taskForm');
    const cancelFormBtn = document.getElementById('cancelFormBtn');
    const formTitle = document.getElementById('formTitle');
    const viewTaskModal = document.getElementById('viewTaskModal');
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    const taskToDeleteTitleSpan = document.getElementById('taskToDeleteTitle');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    let currentTaskIdToDelete = null; // Variable to store the ID of the task being deleted

    const phpCategories = <?php echo json_encode(isset($categories) ? $categories : []); ?>;
    const categoryMap = {};
    // Populate categoryMap from PHP data
    phpCategories.forEach(cat => {
        categoryMap[cat.id] = cat.category;
    });

    // Fallback if categories are not loaded from DB
    if (Object.keys(categoryMap).length === 0) {
        Object.assign(categoryMap, {
            1: 'Work',
            2: 'Personal',
            3: 'Important',
            4: 'Shopping',
            5: 'Health',
            6: 'Finance',
            7: 'Study',
        });
    }

    // Show/hide task form
    showTaskFormBtn.addEventListener('click', function () {
        if (taskFormContainer.style.display === 'none' || taskFormContainer.style.display === '') {
            resetTaskForm();
            formTitle.textContent = 'Create Task';
            taskForm.action = '<?= base_url('task/save') ?>';
            taskFormContainer.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' }); // Scroll to top
        } else {
            taskFormContainer.style.display = 'none';
        }
    });

    cancelFormBtn.addEventListener('click', function () {
        taskFormContainer.style.display = 'none';
        resetTaskForm();
    });

    function resetTaskForm() {
        taskForm.reset();
        document.getElementById('taskId').value = '';
        document.getElementById('checklistItems').innerHTML = `
            <div class="checklist-item">
                <input type="text" name="checklist_items[]" placeholder="Checklist item">
                <button type="button" class="remove-checklist-item" onclick="removeChecklistItem(this)">x</button>
            </div>
        `;
    }

    window.addChecklistItem = function () {
        const checklistItemsDiv = document.getElementById('checklistItems');
        const newItemDiv = document.createElement('div');
        newItemDiv.classList.add('checklist-item');
        newItemDiv.innerHTML = `
            <input type="text" name="checklist_items[]" placeholder="Checklist item">
            <button type="button" class="remove-checklist-item" onclick="removeChecklistItem(this)">x</button>
        `;
        checklistItemsDiv.appendChild(newItemDiv);
    };

    window.removeChecklistItem = function (buttonElement) {
        buttonElement.closest('.checklist-item').remove();
    };

    window.viewTask = function (task) {
        document.getElementById('viewTaskDetailTitle').textContent = task.title;
        document.getElementById('viewTaskDescription').textContent = task.description || 'N/A';
        document.getElementById('viewTaskDueDate').textContent = task.due_date || 'N/A';
        document.getElementById('viewTaskDueTime').textContent = task.due_time || 'N/A';
        document.getElementById('viewTaskCategory').textContent = getCategoryName(task.category_id);
        
        const viewTaskStatusSpan = document.getElementById('viewTaskStatus');
        viewTaskStatusSpan.textContent = task.status ? capitalizeFirstLetter(task.status) : 'N/A';
        viewTaskStatusSpan.className = 'status-badge ' + (task.status ? task.status.toLowerCase().replace(' ', '-') : '');

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

        viewTaskModal.style.display = 'flex';
        // Add a class to trigger the modal-content animation
        setTimeout(() => viewTaskModal.classList.add('show'), 10);
    };

    window.editTask = function (task) {
        formTitle.textContent = 'Edit Task';
        taskForm.action = '<?= base_url('task/save') ?>'; // Action remains save, backend handles update based on ID
        document.getElementById('taskId').value = task.id;
        document.getElementById('taskTitle').value = task.title;
        document.getElementById('taskDate').value = task.due_date;
        document.getElementById('due_time').value = task.due_time;
        document.getElementById('category_id').value = task.category_id;
        document.getElementById('status').value = task.status;
        document.getElementById('description').value = task.description;

        const checklistItemsDiv = document.getElementById('checklistItems');
        checklistItemsDiv.innerHTML = '';

        if (task.checklist_items) {
            try {
                const checklist = JSON.parse(task.checklist_items);
                if (Array.isArray(checklist) && checklist.length > 0) {
                    checklist.forEach(item => {
                        const newItemDiv = document.createElement('div');
                        newItemDiv.classList.add('checklist-item');
                        newItemDiv.innerHTML = `
                            <input type="text" name="checklist_items[]" placeholder="Checklist item" value="${htmlspecialchars(item.item || '')}">
                            <button type="button" class="remove-checklist-item" onclick="removeChecklistItem(this)">x</button>
                        `;
                        checklistItemsDiv.appendChild(newItemDiv);
                    });
                }
            } catch (e) {
                console.error("Error parsing checklist_items for edit:", e);
            }
        }

        if (checklistItemsDiv.children.length === 0) {
            addChecklistItem(); // Ensure at least one empty checklist item input exists
        }

        taskFormContainer.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Updated deleteTask to show custom modal
    window.deleteTask = function (taskId, taskTitle) {
        currentTaskIdToDelete = taskId;
        taskToDeleteTitleSpan.textContent = `"${taskTitle.trim()}"`;
        deleteConfirmModal.style.display = 'flex';
        setTimeout(() => deleteConfirmModal.classList.add('show'), 10);
    };

    // Event listener for the confirm delete button inside the modal
    confirmDeleteBtn.addEventListener('click', function() {
        if (currentTaskIdToDelete) {
            window.location.href = '<?= base_url('task/delete/') ?>' + currentTaskIdToDelete;
        }
        closeModal('deleteConfirmModal'); // Close the modal after action
    });

    window.closeModal = function (modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('show'); // Remove class to trigger animation reverse
        modal.style.display = 'none'; // Hide after animation (or immediately if no animation)
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
        return String(str).replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    // --- Task Completion Toggle ---
    document.querySelectorAll('.task-completion-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const taskId = this.dataset.taskId;
            const newStatus = this.checked ? 'completed' : 'pending'; // Toggle between completed and pending
            
            // Optimistically update UI
            const statusBadge = this.closest('tr').querySelector('.status-badge');
            if (statusBadge) {
                statusBadge.textContent = capitalizeFirstLetter(newStatus);
                statusBadge.className = 'status-badge ' + newStatus.toLowerCase().replace(' ', '-');
            }

            // Send AJAX request to update status in backend
            fetch('<?= base_url('task/update_status/') ?>' + taskId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest' // Identify as AJAX request
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (!response.ok) {
                    // If HTTP status is not 2xx, throw an error
                    return response.text().then(text => { throw new Error(text) });
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    console.log('Task status updated successfully to:', newStatus);
                } else {
                    console.error('Failed to update task status:', data.message);
                    this.checked = !this.checked; 
                    if (statusBadge) {
                        const originalStatus = newStatus === 'completed' ? 'pending' : 'completed';
                        statusBadge.textContent = capitalizeFirstLetter(originalStatus);
                        statusBadge.className = 'status-badge ' + originalStatus.toLowerCase().replace(' ', '-');
                    }
                    alert('Failed to update task status: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error sending update request:', error);
                // Revert UI on network error
                this.checked = !this.checked;
                 if (statusBadge) {
                    const originalStatus = newStatus === 'completed' ? 'pending' : 'completed';
                    statusBadge.textContent = capitalizeFirstLetter(originalStatus);
                    statusBadge.className = 'status-badge ' + originalStatus.toLowerCase().replace(' ', '-');
                }
                alert('Network error while updating task status. Check console for details.');
            });
        });
    });
});
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EBE Board</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
        }
        .header {
            width: calc(100% - 250px);
            margin-left: 250px;
            position: fixed;
            top: 0;
            height: 60px;
            background-color: transparent;
        }
        .main-content {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin-left: 250px;
            margin-top: 90px;
            padding: 1rem;
        }
        .kanban-board {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            overflow-x: auto;
        }
        .kanban-column {
            flex: 1 1 200px;
            max-width: 300px;
            border-radius: 8px;
            padding: 1rem;
            background-color: #f9fafb;
            min-width: 200px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }
        .kanban-column h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .kanban-item {
            background-color: #ffffff;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .kanban-item:hover {
            background-color: #f1f5f9;
        }
        .kanban-column.todo {
            background-color: #e0e0e0;
        }
        .kanban-column.in-progress {
            background-color: #fff9c4;
        }
        .kanban-column.done {
            background-color: #c8e6c9;
        }
        .new-task-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .new-task-input {
            flex: 1;
            margin-bottom: 0;
            padding: 0.5rem;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #4b5563;
        }
        .new-task-button {
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .new-task-button:hover {
            background-color: #0056b3;
        }
        .board-creation-form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .board-creation-input {
            flex: 1;
            margin-bottom: 0;
            padding: 0.5rem;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #4b5563;
        }
        .board-creation-button {
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .board-creation-button:hover {
            background-color: #0056b3;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    @include('admin.css')

    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
        @include('admin.sidebar')
    </div>
    <div class="header">
        @include('admin.header')
    </div>
    <div class="main-content">
        <h1 class="text-2xl font-bold mb-4">Board</h1>
        <div class="board-creation-form">
            <input type="text" class="board-creation-input" id="board-name" placeholder="New Board Name">
            <button type="button" class="board-creation-button" id="create-board">Create Board</button>
        </div>
        <div class="kanban-board" id="kanban-board">
            <div class="kanban-column todo" id="todo">
                <h2>To Do</h2>
                <form class="new-task-form">
                    <input type="text" class="new-task-input" placeholder="New Task">
                    <button type="submit" class="new-task-button">Add</button>
                </form>
                <div class="kanban-item" draggable="true">
                    <div class="font-medium">Task 1</div>
                </div>
                <div class="kanban-item" draggable="true">
                    <div class="font-medium">Task 2</div>
                </div>
            </div>
            <div class="kanban-column in-progress" id="in-progress">
                <h2>In Progress</h2>
                <form class="new-task-form">
                    <input type="text" class="new-task-input" placeholder="New Task">
                    <button type="submit" class="new-task-button">Add</button>
                </form>
                <div class="kanban-item" draggable="true">
                    <div class="font-medium">Task 3</div>
                </div>
                <div class="kanban-item" draggable="true">
                    <div class="font-medium">Task 4</div>
                </div>
            </div>
            <div class="kanban-column done" id="done">
                <h2>Done</h2>
                <form class="new-task-form">
                    <input type="text" class="new-task-input" placeholder="New Task">
                    <button type="submit" class="new-task-button">Add</button>
                </form>
                <div class="kanban-item" draggable="true">
                    <div class="font-medium">Task 5</div>
                </div>
                <div class="kanban-item" draggable="true">
                    <div class="font-medium">Task 6</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        @include('admin.script')
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const draggables = document.querySelectorAll('.kanban-item');
            const columns = document.querySelectorAll('.kanban-column');
    
            function addDragAndDrop() {
                const draggables = document.querySelectorAll('.kanban-item');
                const columns = document.querySelectorAll('.kanban-column');
    
                draggables.forEach(draggable => {
                    draggable.addEventListener('dragstart', () => {
                        draggable.classList.add('dragging');
                    });
    
                    draggable.addEventListener('dragend', () => {
                        draggable.classList.remove('dragging');
                    });
    
                    draggable.addEventListener('dblclick', () => {
                        if (!draggable.classList.contains('editable')) {
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.value = draggable.textContent.trim();
                            draggable.innerHTML = '';
                            draggable.appendChild(input);
                            input.focus();
    
                            input.addEventListener('blur', () => {
                                saveTask(draggable, input);
                            });
    
                            input.addEventListener('keydown', (e) => {
                                if (e.key === 'Enter') {
                                    saveTask(draggable, input);
                                }
                            });
    
                            draggable.classList.add('editable');
                        }
                    });
                });
    
                columns.forEach(column => {
                    column.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        const afterElement = getDragAfterElement(column, e.clientY);
                        const draggable = document.querySelector('.dragging');
                        if (afterElement == null) {
                            column.appendChild(draggable);
                        } else {
                            column.insertBefore(draggable, afterElement);
                        }
                    });
                });
            }
    
            function getDragAfterElement(column, y) {
                const draggableElements = [...column.querySelectorAll('.kanban-item:not(.dragging)')];
    
                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return { offset: offset, element: child };
                    } else {
                        return closest;
                    }
                }, { offset: Number.NEGATIVE_INFINITY }).element;
            }
    
            function saveTask(draggable, input) {
                const newValue = input.value.trim();
                if (newValue !== '') {
                    draggable.innerHTML = `<div class="font-medium">${newValue}</div>`;
                } else {
                    draggable.innerHTML = '<div class="font-medium">Untitled Task</div>';
                }
                draggable.classList.remove('editable');
            }
    
            function addNewTask(event, column) {
                event.preventDefault();
                const input = column.querySelector('.new-task-input');
                const taskText = input.value.trim();
                if (taskText !== '') {
                    const newTask = document.createElement('div');
                    newTask.classList.add('kanban-item');
                    newTask.setAttribute('draggable', 'true');
                    newTask.innerHTML = `<div class="font-medium">${taskText}</div>`;
                    column.appendChild(newTask);
                    input.value = '';
                    addDragAndDrop();
                }
            }
    
            document.querySelectorAll('.new-task-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    const column = event.target.closest('.kanban-column');
                    addNewTask(event, column);
                });
            });
    
            addDragAndDrop();
        });
    
        document.getElementById('create-board').addEventListener('click', function() {
            const boardName = document.getElementById('board-name').value.trim();
            if (boardName !== '') {
                const boardContainer = document.createElement('div');
                boardContainer.classList.add('kanban-column');
    
                boardContainer.innerHTML = `
                    <h2>${boardName}</h2>
                    <form class="new-task-form">
                        <input type="text" class="new-task-input" placeholder="New Task">
                        <button type="submit" class="new-task-button">Add</button>
                    </form>
                `;
    
                document.getElementById('kanban-board').appendChild(boardContainer);
    
                boardContainer.querySelector('.new-task-form').addEventListener('submit', function(event) {
                    addNewTask(event, boardContainer);
                });
    
                addDragAndDrop();
                document.getElementById('board-name').value = '';
            }
        });
        document.getElementById('dropdownButton').addEventListener('click', function () {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const button = document.getElementById('dropdownButton');
            const menu = document.getElementById('dropdownMenu');
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
        dropdownButton.addEventListener('click', function () {
    if (activeBtn === dropdownButton) {
        closeAllDropdowns();
    } else {
        closeAllDropdowns();
        dropdownMenu.classList.add('show');
        dropdownButton.classList.add('active');
        activeBtn = dropdownButton;
    }
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@latest/dist/flowbite.min.js"></script>
</body>
</html>

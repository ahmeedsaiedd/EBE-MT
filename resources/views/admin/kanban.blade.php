<!DOCTYPE html>
<html lang="en">
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<html lang="en" x-data="{ dark: false, isSideMenuOpen: false, showTable: false }" :class="{ 'theme-dark': dark }">


<head>
    <title>EBE Board</title>

    {{-- <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon"> --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('admin.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .kanban-board {
            background-color: #f0f4f8;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .kanban-card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .kanban-card:hover {
            transform: translateY(-3px);
        }

        .kanban-task {
            background-color: #fff;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            padding: 0.75rem;
            transition: transform 0.2s;
            cursor: move;
            position: relative;
        }

        .kanban-task:hover {
            transform: scale(1.02);
        }

        .add-task-btn,
        .add-card-btn {
            background-color: #1d4ed8;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .add-task-btn:hover,
        .add-card-btn:hover {
            background-color: #2563eb;
        }

        .kanban-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .color-picker {
            margin-left: 0.5rem;
            cursor: pointer;
        }

        .task-icons {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            display: flex;
            gap: 0.5rem;
        }

        .task-icons button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .task-icons .fa {
            color: #999;
        }

        .task-icons .fa:hover {
            color: #333;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal.show {
            visibility: visible;
            opacity: 1;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        .modal-header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 1rem;
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
        }

        .modal-footer button {
            margin-left: 0.5rem;
        }

        .modal-body {
            max-height: 300px;
            overflow-y: auto;
        }
        .add-card-btn {
    margin-top: 1rem;
    padding-top: 0.5rem;
    padding-right: 1rem;
    padding-bottom: 0.5rem;
    padding-left: 1rem;
    background-color: #3490dc; /* Example color */
    color: white;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
}
    </style>
</head>

<body>
   
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
        @include('admin.sidebar')
        @include('admin.header')
        
        <div class="container mx-auto kanban-board">
             <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol id="breadcrumb" class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <!-- Breadcrumb links will be populated by JavaScript -->
        </ol>
    </nav>
            <div class="kanban-container" id="kanbanContainer">


                @foreach ($cards as $card)
                    <!-- To Do Card -->
                    <div class="bg-gray-200 p-4 rounded kanban-card" id="card-todo">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold" contenteditable="true">{{ $card->name }}</h3>
                            <div class="flex gap-2 items-center">
                                <button class="text-gray-500 hover:text-gray-700" onclick="deleteCard('{{ $card->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                
                                <button class="text-gray-500 hover:text-gray-700" onclick="toggleCard($card->id)">
                                    <i id="collapse-todo" class="fas fa-chevron-down"></i>
                                </button>
                                <button class="add-task-btn" onclick="addTask('{{ $card->id }}')">Add Task</button>
                            </div>
                        </div>
                        <div id="tasks-{{ $card->id }}" class="space-y-2">
                            @foreach ($tasks as $task)
                                @if ($card->id == $task->card_id)
                                    <div class="kanban-task" data-task-id="{{ $task->id }}">
                                        <form action="{{ route('kanban.updateTask', $task->id) }}" method="POST"
                                            class="task-form">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="name" class="task-content"
                                                value="{{ $task->name }}" />
                                            <div class="task-icons">
                                                <button type="button" onclick="editTask(this)"><i
                                                        class="fas fa-edit"></i></button>
                                                <button type="button" onclick="deleteTask(this)"><i
                                                        class="fas fa-trash-alt"></i></button>
                                                <button type="button" onclick="moveTask(this)"><i
                                                        class="fas fa-arrows-alt"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>
                @endforeach

            </div>
            <button class="add-card-btn" onclick="addCard()" >Add new board</button>
        </div>
    </div>

    <!-- Move Task Modal -->
    <div id="moveTaskModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-lg font-semibold">Move Task</h2>
            </div>
            <div class="modal-body">
                <label for="moveTaskColumnSelect" class="block text-sm font-medium text-gray-700 mb-2">Select
                    Column:</label>
                <select id="moveTaskColumnSelect" class="block w-full border-gray-300 rounded-md shadow-sm">
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <div class="modal-footer">
                <button id="confirmMoveTaskBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Move</button>
                <button id="cancelMoveTaskBtn" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let colorIndex = 0;
        const cardColors = ['bg-gray-200', 'bg-yellow-200', 'bg-green-200', 'bg-blue-200', 'bg-red-200'];
        let taskToMove = null;
        let editingTask = null; // Track the task currently being edited

        function initializeSortables() {
            const containers = document.querySelectorAll('.kanban-card');
            containers.forEach(container => {
                Sortable.create(container.querySelector('div'), {
                    group: 'tasks',
                    animation: 150,
                    onStart: function(evt) {
                        evt.item.classList.add('dragging');
                    },
                    onEnd: function(evt) {
                        evt.item.classList.remove('dragging');
                    }
                });
            });
        }

        function addTask(cardId) {
            // Make sure cardId is used correctly
            const taskList = document.getElementById(`tasks-${cardId}`);

            if (!taskList) {
                console.error(`No element found with id tasks-${cardId}`);
                return;
            }

            const task = document.createElement('div');
            task.className = 'kanban-task';

            // Construct the form action URL
            const formActionUrl = `/kanban/cards/${cardId}/tasks`;

            task.innerHTML = `
        <form action="${formActionUrl}" method="POST" class="task-form">
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}" />
            <input type="hidden" name="card_id" value="${cardId}" />
            <input type="text" name="name" class="task-content" value="New Task" />
            <div class="task-icons">
                <button type="button" onclick="editTask(this)"><i class="fas fa-edit"></i></button>
                <button type="button" onclick="deleteTask(this)"><i class="fas fa-trash-alt"></i></button>
                <button type="button" onclick="moveTask(this)"><i class="fas fa-arrows-alt"></i></button>
            </div>
        </form>
    `;

            taskList.appendChild(task);

            // Add event listener to submit form on blur
            task.querySelector('.task-content').addEventListener('blur', function() {
                this.closest('form').submit();
            });

            // Initialize sortables again to include the new task
            initializeSortables();
        }





        function showToast(message, type = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                icon: type,
                title: message
            });
        }

        function deleteTask(btn) {
            const taskId = btn.closest('.kanban-task').dataset.taskId;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/kanban/tasks/${taskId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                        }
                    }).then(response => {
                        if (response.ok) {
                            showToast('Task deleted successfully.');
                            btn.closest('.kanban-task').remove();
                        } else {
                            showToast('Failed to delete the task.', 'error');
                        }
                    }).catch(error => {
                        console.error('Error:', error);
                        showToast('An error occurred while deleting the task.', 'error');
                    });
                }
            });
        }

        function moveTask(btn) {
            taskToMove = btn.closest('.kanban-task');
            const columnSelect = document.getElementById('moveTaskColumnSelect');
            const columns = document.querySelectorAll('.kanban-card');
            columnSelect.innerHTML = '';
            columns.forEach(column => {
                const option = document.createElement('option');
                option.value = column.id;
                option.textContent = column.querySelector('h3').textContent;
                columnSelect.appendChild(option);
            });
            document.getElementById('moveTaskModal').classList.add('show');
        }

        document.getElementById('confirmMoveTaskBtn').addEventListener('click', () => {
            const columnId = document.getElementById('moveTaskColumnSelect').value;
            if (taskToMove && columnId) {
                document.getElementById(columnId.replace('card-', '')).appendChild(taskToMove);
                document.getElementById('moveTaskModal').classList.remove('show');

                fetch(`/kanban/tasks/${taskToMove.dataset.taskId}/move`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        card_id: columnId.replace('card-', '')
                    })
                }).then(response => {
                    if (!response.ok) {
                        showToast('Failed to update task.', 'error');
                    }
                }).catch(error => {
                    console.error('Error:', error);
                    showToast('An error occurred while updating the task.', 'error');
                });
            }
        });

        function addCard() {
            colorIndex++;
            const cardId = `card-${colorIndex}`;
            const newCard = document.createElement('div');
            newCard.className = `p-4 rounded kanban-card ${cardColors[colorIndex % cardColors.length]}`;
            newCard.id = cardId;
            newCard.innerHTML = `
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" contenteditable="true">New Column</h3>
            <div class="flex gap-2 items-center">
                <button class="text-gray-500 hover:text-gray-700" onclick="deleteCard('${cardId}')"><i class="fas fa-trash-alt"></i></button>
                <button class="text-gray-500 hover:text-gray-700" onclick="toggleCard('${cardId}')"><i id="collapse-${cardId}" class="fas fa-chevron-down"></i></button>
                <button class="add-task-btn" onclick="addTask('${cardId}')">Add Task</button>
            </div>
        </div>
        <div id="${cardId.replace('card-', '')}" class="space-y-2">
            <!-- Tasks will be added here -->
        </div>
    `;
            document.getElementById('kanbanContainer').appendChild(newCard);
            initializeSortables();
            showToast('Card added successfully.');

            // Send card data to the server
            fetch('{{ route('kanban.storeCard') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        board_id: "1",
                        name: 'New Column',
                        color: cardColors[colorIndex % cardColors.length]
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Error saving card:', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function deleteCard(cardId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This card and all tasks will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/kanban/cards/${cardId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cardElement = document.getElementById(cardId);
                    if (cardElement) {
                        cardElement.remove();
                        showToast('Card deleted successfully.');
                    } else {
                        showToast('Failed to delete card: Card not found.');
                    }
                } else {
                    showToast(`Failed to delete card: ${data.message}`);
                }
            })
            .catch(error => {
                showToast('An error occurred while deleting the card.');
                console.error('Error:', error);
            });
        }
    });
}






        function toggleCard(cardId) {
            const card = document.getElementById(cardId);
            const tasks = card.querySelector('div[id]');
            tasks.classList.toggle('hidden');
            const icon = document.getElementById(`collapse-${cardId}`);
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }

        document.addEventListener('DOMContentLoaded', () => {
            initializeSortables();
        });
        const breadcrumb = document.getElementById('breadcrumb');
 // Function to build breadcrumbs
 function buildBreadcrumbs() {
                const path = window.location.pathname.split('/').filter(p => p);
                let breadcrumbHTML = '<li class="inline-flex items-center"><a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"><svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/></svg>Home</a></li>';

                path.forEach((segment, index) => {
                    const isLast = index === path.length - 1;
                    const segmentTitle = segment.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    breadcrumbHTML += `<li class="inline-flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <a href="${path.slice(0, index + 1).join('/')}">${segmentTitle}</a>
                    </li>`;
                });

                breadcrumb.innerHTML = breadcrumbHTML;
            }

            // Build breadcrumbs on page load
            buildBreadcrumbs();
        
    </script>
</body>

</html>

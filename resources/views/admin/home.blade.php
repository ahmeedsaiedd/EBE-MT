<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
@include('admin.css-script')

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        @include('admin.sidebar')


        </aside>
        <!-- Mobile sidebar -->
        @include('admin.header')
        @include('admin.body')
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('userStoryForm');
            const addButtons = form.querySelectorAll('.add-section');
            const removeButtons = form.querySelectorAll('.remove-section');

            // Function to clone user story section
            function cloneUserStorySection(button) {
                const template = form.querySelector('.user-story-section-template').cloneNode(true);
                template.classList.remove('hidden');
                template.querySelector('input[name="userStoryName[]"]').value = ''; // Clear user story name input
                template.querySelector('input[name="asField[]"]').value = ''; // Clear As input
                template.querySelector('input[name="iWantField[]"]').value = ''; // Clear I Want input
                template.querySelector('input[name="soThatField[]"]').value = ''; // Clear So That input

                // Add event listener for Add button in cloned section
                template.querySelector('.add-section').addEventListener('click', function() {
                    cloneUserStorySection(this);
                });

                // Add event listener for Remove button in cloned section
                template.querySelector('.remove-section').addEventListener('click', function() {
                    template.remove();
                });

                form.insertBefore(template, form.querySelector('.user-story-section-template'));
            }

            // Add button event listeners
            addButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    cloneUserStorySection(button);
                });
            });

            // Remove button event listeners
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    button.closest('.user-story-section-template').remove();
                });
            });
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
        
        document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('modal').classList.remove('hidden');
    });

    document.querySelectorAll('#closeModalButton').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    });
        
        
    </script>
</body>

</html>

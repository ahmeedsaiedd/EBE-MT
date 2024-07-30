<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
<script src="admin/assets/js/charts-lines.js" defer></script>
<script src="admin/assets/js/charts-pie.js" defer></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="admin/assets/js/init-alpine.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('modalManager', () => ({
            openModalId: null,
            openModal(id) {
                if (this.openModalId === id) {
                    this.openModalId = null;
                } else {
                    this.openModalId = id;
                }
            },
            isModalOpen(id) {
                return this.openModalId === id;
            },
        }));
        
    });
    document.addEventListener('DOMContentLoaded', function () {
          const createProjectBtn = document.getElementById('create-project-btn');
          const createProjectModal = document.getElementById('create-project-modal');
          const cancelBtn = document.getElementById('cancel-btn');
          const submitFormBtn = document.getElementById('submit-form-btn');
          const dropdownBtn = document.getElementById('dropdown-btn');
          const dropdownMenu = document.getElementById('dropdown-menu');
  
          let activeBtn = null;
  
          function openModal() {
              // Ensure only one modal is open
              document.querySelectorAll('.modal').forEach(modal => {
                  if (modal !== createProjectModal) {
                      modal.style.display = 'none';
                  }
              });
              createProjectModal.style.display = 'flex';
          }
  
          function closeModal() {
              createProjectModal.style.display = 'none';
          }
  
          function closeAllDropdowns() {
              if (activeBtn) {
                  activeBtn.classList.remove('active');
                  const menu = document.querySelector('.dropdown-menu.show');
                  if (menu) {
                      menu.classList.remove('show');
                  }
                  activeBtn = null;
              }
          }
  
          // Open the modal
          createProjectBtn.addEventListener('click', function () {
              openModal();
          });
  
          // Close the modal
          cancelBtn.addEventListener('click', closeModal);
          submitFormBtn.addEventListener('click', closeModal);
  
          // Toggle dropdown menu visibility
          dropdownBtn.addEventListener('click', function () {
              if (activeBtn === dropdownBtn) {
                  closeAllDropdowns();
              } else {
                  closeAllDropdowns();
                  dropdownMenu.classList.add('show');
                  dropdownBtn.classList.add('active');
                  activeBtn = dropdownBtn;
              }
          });
  
          // Close modal or dropdown when clicking outside
          document.addEventListener('click', function (e) {
              // Close modal if clicking outside of it
              if (createProjectModal.style.display === 'flex' && !createProjectModal.contains(e.target) && !createProjectBtn.contains(e.target)) {
                  closeModal();
              }
              
              // Close dropdown if clicking outside of it
              if (activeBtn && !activeBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                  closeAllDropdowns();
              }
          });
  
          // Ensure dropdown closes when clicking anywhere on the page
          document.addEventListener('click', function (e) {
              if (activeBtn && !activeBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                  closeAllDropdowns();
              }
          });
      });
      // Function to create breadcrumb items based on the URL path
      function updateBreadcrumb() {
        const breadcrumb = document.getElementById('breadcrumb');
        const pathSegments = window.location.pathname.split('/').filter(segment => segment);

        breadcrumb.innerHTML = ''; // Clear existing breadcrumb items

        if (pathSegments.length === 0) {
          // Home breadcrumb
          breadcrumb.innerHTML = `
            <li class="inline-flex items-center">
              <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Home
              </a>
            </li>
          `;
        } else {
          // Home breadcrumb
          breadcrumb.innerHTML = `
            <li class="inline-flex items-center">
              <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Home
              </a>
            </li>
          `;
          // Additional breadcrumbs
          pathSegments.forEach((segment, index) => {
            const isLastSegment = index === pathSegments.length - 1;
            breadcrumb.innerHTML += `
              <li class="inline-flex items-center">
                ${index > 0 ? '<svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>' : ''}
                <a href="#" class="text-sm font-medium ${isLastSegment ? 'text-gray-500 dark:text-gray-400' : 'text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white'}">
                  ${isLastSegment ? `<span class="ms-1">${decodeURIComponent(segment)}</span>` : `<span class="ms-1">${decodeURIComponent(segment)}</span>`}
                </a>
              </li>
            `;
          });
        }
      }

      // Initial call to update breadcrumbs on page load
      updateBreadcrumb();

      function toggleIssueInput(containerId, buttonId, inputId) {
        document.getElementById(buttonId).addEventListener('click', function() {
          document.getElementById(containerId).classList.remove('hidden');
        });

        document.getElementById(`saveIssueBtn${inputId}`).addEventListener('click', function() {
          const issueDetails = document.getElementById(`issueInput${inputId}`).value;
          if (issueDetails) {
            const box = document.getElementById(`box${inputId}`);
            const issueElement = document.createElement('p');
            issueElement.textContent = issueDetails;
            issueElement.classList.add('mt-2', 'text-gray-800');
            box.appendChild(issueElement);

            document.getElementById(`issueInput${inputId}`).value = '';
            document.getElementById(containerId).classList.add('hidden');
          } else {
            alert('Please enter issue details.');
          }
        });
      }

      function setupEditableTitles() {
        document.querySelectorAll('.editable-title').forEach(title => {
          title.addEventListener('blur', function() {
            if (this.textContent.trim() === '') {
              alert('Box name cannot be empty.');
              this.textContent = 'Untitled'; // Set default name if empty
            }
          });

          title.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
              event.preventDefault(); // Prevent newline in the contenteditable element
              this.blur(); // Trigger blur event
            }
          });
        });
      }

      toggleIssueInput('issueInputContainerToDo', 'createIssueBtnToDo', 'ToDo');
      toggleIssueInput('issueInputContainerInProgress', 'createIssueBtnInProgress', 'InProgress');
      toggleIssueInput('issueInputContainerDone', 'createIssueBtnDone', 'Done');

      setupEditableTitles();

      document.getElementById('addNewBoxBtn').addEventListener('click', function() {
        const boxContainer = document.querySelector('.box-container');
        const existingBoxes = Array.from(boxContainer.children).filter(child => child.classList.contains('box'));

        if (existingBoxes.length > 0) {
          const boxName = prompt('Enter a name for the new box:');
          if (boxName) {
            const boxToDuplicate = existingBoxes[0]; // Duplicate the first existing box
            const newBoxIndex = boxContainer.children.length - 1; // Exclude the "Add New Box" button

            const newBox = document.createElement('div');
            newBox.className = 'box bg-gray-200 border border-gray-300 rounded-md relative flex flex-col overflow-y-auto';
            newBox.id = `boxNew${newBoxIndex + 1}`;
            newBox.innerHTML = `
              <h2 id="titleNew${newBoxIndex + 1}" class="editable-title text-lg font-semibold text-gray-800" contenteditable="true">${boxName}</h2>
              <button id="createIssueBtnNew${newBoxIndex + 1}" class="mt-4 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">+ Create Issue</button>
              <div id="issueInputContainerNew${newBoxIndex + 1}" class="mt-4 hidden flex-1">
                <textarea id="issueInputNew${newBoxIndex + 1}" class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter issue details..."></textarea>
                <button id="saveIssueBtnNew${newBoxIndex + 1}" class="mt-2 px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Save Issue</button>
              </div>
            `;
            boxContainer.insertBefore(newBox, document.getElementById('addNewBoxBtn'));

            toggleIssueInput(`issueInputContainerNew${newBoxIndex + 1}`, `createIssueBtnNew${newBoxIndex + 1}`, `New${newBoxIndex + 1}`);
            setupEditableTitles();
          } else {
            alert('Box name is required.');
          }
        } else {
          alert('No existing boxes to duplicate.');
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
    import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

});
function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}



</script>

<x-app-layout>
    <!DOCTYPE html>
    <html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
      @include('admin.css')
      <body>
        <div
          class="flex h-screen bg-gray-50 dark:bg-gray-900"
          :class="{ 'overflow-hidden': isSideMenuOpen }"
        >
    
          
          </aside>
          <!-- Mobile sidebar -->
          </div>
        </div>
      </body>
    </html>
</x-app-layout>

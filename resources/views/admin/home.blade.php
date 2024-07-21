<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  @include('admin.css-script')
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      @include('admin.sidebar')
      </aside>
      <!-- Mobile sidebar -->
     @include('admin.header')
        @include('admin.body')
      </div>
    </div>
  </body>
</html>
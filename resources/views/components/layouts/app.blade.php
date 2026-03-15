<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          theme: localStorage.getItem('theme') === 'dark' ? 'dark' : 'light',
          init() {
              document.documentElement.classList.toggle('dark', this.theme === 'dark');
              this.$watch('theme', (newTheme) => {
                  localStorage.setItem('theme', newTheme);
                  document.documentElement.classList.toggle('dark', newTheme === 'dark');
              });
          }
      }"
      x-bind:class="{ 'dark': theme === 'dark' }">
<head>
    @include('partials.head')
</head>
<body class="font-sans antialiased bg-background text-foreground">
<x-header />
    {{ $slot }}

    @fluxScripts
</body>
</html>

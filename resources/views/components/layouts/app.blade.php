<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark"
      x-data="{
          theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
          init() {
              if (this.theme === 'dark') {
                  document.documentElement.classList.add('dark');
              }
              this.$watch('theme', (newTheme) => {
                  localStorage.setItem('theme', newTheme);
                  if (newTheme === 'dark') {
                      document.documentElement.classList.add('dark');
                  } else {
                      document.documentElement.classList.remove('dark');
                  }
              });
          }
      }">
<head>
    @include('partials.head')
</head>
<body class="font-sans antialiased bg-background text-foreground">
<x-header />
    {{ $slot }}

    @fluxScripts
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @livewireStyles


        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>
            const setInputFilter = (textbox, inputFilter) => {
                    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                    textbox.addEventListener(event, function() {
                        if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        } else {
                        this.value = "";
                        }
                    });
                });
            }
            setInputFilter(document.getElementById("hargajual"), function(value) {
                return /^\d*$/.test(value); });
            setInputFilter(document.getElementById("hargabeli"), function(value) {
                return /^\d*$/.test(value); });
            setInputFilter(document.getElementById("stok"), function(value) {
                return /^\d*$/.test(value); });

                const SwalConfirm = (icon, title, html, confirmButtonText, method, kode) => {
                    Swal.fire({
                        icon,
                        title,
                        html,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText,
                        reverseButtons: true,
                    }).then(result => {
                        
                        if (result.value) {
                            return livewire.emit('destroy', kode);
                        }
                    })
                }

            document.addEventListener('DOMContentLoaded', () => { 
                this.livewire.on('swal:confirm', data => {
                    SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.kode)
                })
            })
        </script>
        <script type="text/javascript">
        "use strict";
            window.livewire.on('barangStore', () => {
                $('#exampleModal').modal('hide');
            });
            window.livewire.on('barangUpdate', () => {
                $('#updateModal').modal('hide');
            });
        </script>
    </body>
</html>

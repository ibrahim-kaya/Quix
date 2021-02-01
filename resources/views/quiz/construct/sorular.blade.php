<x-app-layout>
    <x-slot name="header">Quiz Soruları</x-slot>

    @livewire('sorular', ['quiz' => $quiz, 'kategori' => $kategori])

    <script>

        window.addEventListener('oEditModal', event => {
            $('#edit_modal_bg').css('visibility', 'visible');
            $('#edit_modal').css('visibility', 'visible');
            $('#edit_modal_body').css('transform', 'scaleY(1)');
            $('#edit_modal_bg').css('opacity', '.5');
            $('#edit_modal').css('opacity', '1');
            document.body.style.overflow = 'hidden';
        })
    </script>

</x-app-layout>

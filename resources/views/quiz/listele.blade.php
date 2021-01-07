<x-app-layout>
    <x-slot name="header">Anasayfa</x-slot>

    <div>
        <button
            type="button"
            class="btn btn--primary">
            <i class="fa fa-plus"></i> Yeni Oluştur
        </button>

        <table class="min-w-full leading-normal quiz-table mb-5 mt-5">
            <thead class="hidden sm:table-header-group">
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Quiz
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Oluşturan
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Oluşturma Tarihi
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Durum
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($quizzes as $quiz)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 text-sm quiz-table-baslik cursor-pointer">
                    <p class="text-gray-900 whitespace-no-wrap text-lg">{{ $quiz->baslik }}</p>
                    <div class="quiz-table-info"><p class="text-xs">test</p></div>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm cursor-pointer">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10">
                            <img class="w-full h-full rounded-full"
                                 src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                 alt="" />
                        </div>
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Vera Carpenter
                            </p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        Jan 21, 2020
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                              class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Activo</span>
                                    </span>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="px-5 pb-5">{{$quizzes->links()}}</div>
    </div>

</x-app-layout>

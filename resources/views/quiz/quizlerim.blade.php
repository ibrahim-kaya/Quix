<x-app-layout>
    <x-slot name="header">Quizlerim</x-slot>
    <div>
        <table class="min-w-full leading-normal quiz-table mb-5 mt-0.5">
            <thead class="hidden sm:table-header-group">
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Quiz
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Oluşturma Tarihi
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Durum
                </th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    İşlemler
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['quizzes'] as $quiz)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm quiz-table-baslik cursor-pointer">
                        <p class="text-gray-900 whitespace-no-wrap text-lg">{{ $quiz->baslik }}</p>
                        <div class="quiz-table-info flex items-center mt-1">
                            <span class="relative inline-block px-3 py-0.5 font-semibold text-green-900 leading-tight mx-1.5">
                                <span aria-hidden class="absolute inset-0 bg-yellow-500 opacity-50 rounded-full"></span>
                                <span class="relative text-xs"><i class="fas fa-pencil-ruler"></i> Taslak</span>
                            </span> ·
                            <a href="{{ route('quizler.edit', $quiz->id) }}"><button class="rounded-md px-2 py-1 ml-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-green-500 bg-green-500 text-white hover:bg-green-600;"><i class="fa fa-edit" title="Düzenle"></i></button></a>
                            <button class="rounded-md px-2 py-1 ml-1.5 transition duration-300 ease-linear select-none focus:outline-none focus:shadow border border-red-500 bg-red-500 text-white hover:bg-red-600"><i class="fas fa-trash-alt" title="Sil"></i></button>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            Jan 21, 2020
                        </p>
                    </td>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                        <span aria-hidden class="absolute inset-0 bg-{{ ($quiz->durum ? 'green' : 'yellow') }}-500 opacity-50 rounded-full"></span>
                        <span class="relative"><i class="fas {{ ($quiz->durum ? 'fa-check' : 'fa-pencil-ruler') }}"></i> {{ $data['durumtxt'][$quiz->durum] }}</span>
                    </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <button class="btn btn--red"><i class="fas fa-trash-alt" title="Sil"></i></button>
                        <a href="{{ route('quizler.edit', $quiz->id) }}" class="{{ ($quiz->durum ? 'hidden' : '') }}"><button class="btn btn--primary"><i class="fa fa-edit" title="Düzenle"></i></button></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="px-5 mb-5">{{$data['quizzes']->links()}}</div>
        <div class="quiz-table-info text-center pb-5">
            <span class="text-xs text-gray-500">Sayfa: {{ $data['quizzes']->currentPage().'/'.$data['quizzes']->lastPage() }}</span>
        </div>
    </div>

</x-app-layout>
